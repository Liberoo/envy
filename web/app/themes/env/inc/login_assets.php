<?php

namespace Env\Inc;

/**
 * load custom css for login page
 *
 * @throws \Exception
 */
function login_assets(): void
{
    if (file_exists(dirname(__FILE__).'/../admin/assets/css/custom-login.css')
        && class_exists('PressWind\PWAsset')
    ) {
        \PressWind\PWAsset::add(
            handle: 'custom-login-assets',
            src: get_stylesheet_directory_uri().'/admin/assets/css/custom-login.css'
        )->dependencies(['login'])->toLogin();
    }
}
add_action('init', __NAMESPACE__.'\login_assets');

function login_header_url(): string
{
    return home_url('/');
}
add_filter('login_headerurl', __NAMESPACE__ . '\login_header_url');

function login_header_text(): string
{
    return get_bloginfo('name');
}
add_filter('login_headertext', __NAMESPACE__ . '\login_header_text');
