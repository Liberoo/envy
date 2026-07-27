<?php

namespace Env\Inc\Deaktiver;

/**
 * Disable WP features flagged true in config/deaktiver.php.
 */
function boot(): void
{
    $config = require dirname(__DIR__) . '/config/deaktiver.php';

    $map = [
        'emoji' => __NAMESPACE__ . '\disable_emoji',
        'embed' => __NAMESPACE__ . '\disable_embed',
        'feed' => __NAMESPACE__ . '\disable_feed',
        'xmlrpc' => __NAMESPACE__ . '\disable_xmlrpc',
        'jquery' => __NAMESPACE__ . '\disable_jquery',
        'jquery-migrate' => __NAMESPACE__ . '\disable_jquery_migrate',
        'version' => __NAMESPACE__ . '\disable_version',
        'powered-by' => __NAMESPACE__ . '\disable_powered_by',
        'wlwmanifest' => __NAMESPACE__ . '\disable_wlwmanifest',
        'rsd_link' => __NAMESPACE__ . '\disable_rsd_link',
        'short_link' => __NAMESPACE__ . '\disable_short_link',
        'rest_link' => __NAMESPACE__ . '\disable_rest_link',
        'comments' => __NAMESPACE__ . '\disable_comments',
        'rest_user' => __NAMESPACE__ . '\disable_rest_user',
        'login_lang_selector' => __NAMESPACE__ . '\disable_login_lang_selector',
    ];

    foreach ($map as $key => $callback) {
        if (! empty($config[$key])) {
            $callback();
        }
    }
}

add_action('after_setup_theme', __NAMESPACE__ . '\boot');

function disable_emoji(): void
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', fn ($plugins) => is_array($plugins) ? array_diff($plugins, ['wpemoji']) : []);
    add_filter('emoji_svg_url', '__return_false');
}

function disable_embed(): void
{
    add_action('init', function () {
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        remove_action('rest_api_init', 'wp_oembed_register_route');
        wp_deregister_script('wp-embed');
    }, 9999);
}

function disable_feed(): void
{
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);

    $feeds = ['do_feed', 'do_feed_rdf', 'do_feed_rss', 'do_feed_rss2', 'do_feed_atom', 'do_feed_rss2_comments', 'do_feed_atom_comments'];
    foreach ($feeds as $feed) {
        add_action($feed, __NAMESPACE__ . '\kill_feed', 1);
    }
}

function kill_feed(): void
{
    wp_die(__('Feed disabled.', 'press-wind'));
}

function disable_xmlrpc(): void
{
    add_filter('xmlrpc_enabled', '__return_false');
    add_filter('wp_headers', function ($headers) {
        unset($headers['X-Pingback']);
        return $headers;
    });
}

function disable_jquery(): void
{
    add_action('wp_enqueue_scripts', function () {
        if (! is_admin()) {
            wp_deregister_script('jquery');
        }
    }, 100);
}

function disable_jquery_migrate(): void
{
    add_action('wp_default_scripts', function ($scripts) {
        if (is_admin() || empty($scripts->registered['jquery'])) {
            return;
        }
        $jquery = $scripts->registered['jquery'];
        if (! empty($jquery->deps)) {
            $jquery->deps = array_diff($jquery->deps, ['jquery-migrate']);
        }
    });
}

function disable_version(): void
{
    remove_action('wp_head', 'wp_generator');
    add_filter('the_generator', '__return_empty_string');
}

function disable_powered_by(): void
{
    add_action('send_headers', function () {
        if (! headers_sent()) {
            header_remove('X-Powered-By');
        }
    });
}

function disable_wlwmanifest(): void
{
    remove_action('wp_head', 'wlwmanifest_link');
}

function disable_rsd_link(): void
{
    remove_action('wp_head', 'rsd_link');
}

function disable_short_link(): void
{
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    remove_action('template_redirect', 'wp_shortlink_header', 11);
}

function disable_rest_link(): void
{
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('template_redirect', 'rest_output_link_header', 11);
    remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
}

function disable_comments(): void
{
    add_action('init', function () {
        foreach (get_post_types() as $type) {
            if (post_type_supports($type, 'comments')) {
                remove_post_type_support($type, 'comments');
                remove_post_type_support($type, 'trackbacks');
            }
        }
    });
    add_filter('comments_open', '__return_false', 20);
    add_filter('pings_open', '__return_false', 20);
    add_filter('comments_array', '__return_empty_array', 20);
    add_action('admin_menu', fn () => remove_menu_page('edit-comments.php'));
}

function disable_rest_user(): void
{
    add_filter('rest_endpoints', function ($endpoints) {
        if (is_user_logged_in()) {
            return $endpoints;
        }
        unset($endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)']);
        return $endpoints;
    });
}

function disable_login_lang_selector(): void
{
    add_filter('login_display_language_dropdown', '__return_false');
}
