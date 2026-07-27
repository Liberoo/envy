<?php

namespace Env\Inc\Newsletter;

/**
 * Newsletter REST endpoint that forwards sign-ups to MailerLite.
 *
 * POST /wp-json/env/v1/subscribe  { name, email, consent }
 * Requires a wp_rest nonce (X-WP-Nonce header) exposed to the front via
 * window.ENV_NL (functions.php). The subscriber is created without an
 * "active" status so MailerLite sends its own confirmation mail (double opt-in).
 *
 * Config in .env: MAILERLITE_API_KEY, MAILERLITE_GROUP_ID.
 */

function get_api_key(): string
{
    if (defined('MAILERLITE_API_KEY') && MAILERLITE_API_KEY) {
        return (string) MAILERLITE_API_KEY;
    }

    return (string) (function_exists('env') ? env('MAILERLITE_API_KEY') : '');
}

function get_group_id(): string
{
    if (defined('MAILERLITE_GROUP_ID') && MAILERLITE_GROUP_ID) {
        return (string) MAILERLITE_GROUP_ID;
    }

    return (string) (function_exists('env') ? env('MAILERLITE_GROUP_ID') : '');
}

function register_routes(): void
{
    register_rest_route('env/v1', '/subscribe', [
        'methods' => 'POST',
        'callback' => __NAMESPACE__ . '\handle_subscribe',
        'permission_callback' => '__return_true',
        'args' => [
            'email' => [
                'required' => true,
                'type' => 'string',
                'sanitize_callback' => 'sanitize_email',
            ],
            'name' => [
                'required' => false,
                'type' => 'string',
                'sanitize_callback' => 'sanitize_text_field',
            ],
            'consent' => [
                'required' => true,
            ],
        ],
    ]);
}

add_action('rest_api_init', __NAMESPACE__ . '\register_routes');

function handle_subscribe(\WP_REST_Request $request)
{
    // WP verifies the wp_rest nonce automatically only for logged-in users;
    // enforce it explicitly for anonymous requests.
    $nonce = $request->get_header('X-WP-Nonce');
    if (! $nonce || ! wp_verify_nonce($nonce, 'wp_rest')) {
        return new \WP_Error('env_nl_nonce', __('Sesja wygasła — odśwież stronę i spróbuj ponownie.', 'press-wind'), ['status' => 403]);
    }

    $email = $request->get_param('email');
    if (! is_email($email)) {
        return new \WP_Error('env_nl_email', __('Podaj poprawny adres e-mail.', 'press-wind'), ['status' => 400]);
    }

    if (! rest_sanitize_boolean($request->get_param('consent'))) {
        return new \WP_Error('env_nl_consent', __('Zaznacz zgodę na przetwarzanie danych.', 'press-wind'), ['status' => 400]);
    }

    $api_key = get_api_key();
    $group_id = get_group_id();

    if (! $api_key) {
        return new \WP_Error('env_nl_config', __('Newsletter jest chwilowo niedostępny.', 'press-wind'), ['status' => 500]);
    }

    $body = [
        'email' => $email,
    ];

    $name = trim((string) $request->get_param('name'));
    if ($name !== '') {
        $body['fields'] = ['name' => $name];
    }

    if ($group_id) {
        $body['groups'] = [$group_id];
    }

    $response = wp_remote_post('https://connect.mailerlite.com/api/subscribers', [
        'timeout' => 15,
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'body' => wp_json_encode($body),
    ]);

    if (is_wp_error($response)) {
        return new \WP_Error('env_nl_remote', __('Nie udało się połączyć z usługą newslettera. Spróbuj ponownie później.', 'press-wind'), ['status' => 502]);
    }

    $code = wp_remote_retrieve_response_code($response);

    // 200 = existing/updated subscriber, 201 = created
    if ($code === 200 || $code === 201) {
        return rest_ensure_response([
            'success' => true,
            'message' => __('Dzięki! Sprawdź skrzynkę i potwierdź zapis klikając link w mailu.', 'press-wind'),
        ]);
    }

    if ($code === 422) {
        return new \WP_Error('env_nl_invalid', __('Podane dane wyglądają na niepoprawne — sprawdź adres e-mail.', 'press-wind'), ['status' => 422]);
    }

    // 401 and others: do not leak configuration details to the front
    return new \WP_Error('env_nl_failed', __('Zapis nie powiódł się. Spróbuj ponownie później.', 'press-wind'), ['status' => 502]);
}

/**
 * Front config: endpoint + nonce for the fetch() in
 * assets/js/dynamic/newsletter.js.
 */
function print_front_config(): void
{
    if (is_admin()) {
        return;
    }

    $config = [
        'endpoint' => esc_url_raw(rest_url('env/v1/subscribe')),
        'nonce' => wp_create_nonce('wp_rest'),
    ];

    printf('<script>window.ENV_NL = %s;</script>', wp_json_encode($config));
}

add_action('wp_footer', __NAMESPACE__ . '\print_front_config');
