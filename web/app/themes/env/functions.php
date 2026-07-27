<?php

namespace Env;

require_once __DIR__ . '/inc/gutenberg.php';
require_once __DIR__ . '/inc/login_assets.php';
require_once __DIR__ . '/inc/sortable.php';
require_once __DIR__ . '/inc/binding-meta.php';
require_once __DIR__ . '/inc/newsletter.php';
require_once __DIR__ . '/inc/deaktiver.php';
require_once __DIR__ . '/post-type/portfolio.php';
require_once __DIR__ . '/post-type/training.php';

/**
 * Theme setup.
 */
function setup()
{
  add_theme_support('automatic-feed-links');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  load_theme_textdomain('press-wind', get_template_directory() . '/languages');
}

add_action('after_setup_theme', __NAMESPACE__ . '\setup');

/**
 * Front assets via PressWind Vite.
 */
if (class_exists('PressWind\PWVite')) {
  // http in dev: self-signed cert broke the HMR websocket (reload loop)
  \PressWind\PWVite::init(port: 3000, path: '', is_https: false);
  \PressWind\PWVite::init(
    port: 4444,
    path: '/admin',
    position: 'editor',
    is_ts: false,
    is_https: false
  );
}

/**
 * Register block styles.
 */
function init_theme()
{
  add_filter('jpeg_quality', fn () => 100, 10, 2);

  register_block_style('core/image', [
    'name' => 'img-dropshadow',
    'label' => __('Drop Shadow', 'press-wind'),
  ]);

  register_block_style('core/image', [
    'name' => 'img-dropshadow-rounded',
    'label' => __('Drop Shadow Rounded', 'press-wind'),
  ]);

  register_block_style('core/heading', [
    'name' => 'text-effect',
    'label' => __('Text Effect', 'press-wind'),
  ]);

  register_block_style('core/paragraph', [
    'name' => 'underscore',
    'label' => __('Underscore', 'press-wind'),
  ]);
}

add_action('init', __NAMESPACE__ . '\init_theme');

/**
 * Enable Interactivity API support.
 */
function enable_interactivity_api()
{
  add_theme_support('interactivity');
  wp_enqueue_script('wp-interactivity');
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\enable_interactivity_api');

add_filter('big_image_size_threshold', fn () => 5000);

/**
 * Hero entrance: full animation only on first visit. Runs in <head>
 * before the hero renders; on later visits adds eh-seen on <html> so
 * entrance-hero.css shortens the animation to the background slide.
 */
function print_hero_seen_script()
{
  if (! is_front_page()) {
    return;
  }
  ?>
  <script>
    try {
      if (localStorage.getItem('env-hero-seen')) {
        document.documentElement.classList.add('eh-seen');
      }
      localStorage.setItem('env-hero-seen', '1');
    } catch (e) {}
  </script>
  <?php
}

add_action('wp_head', __NAMESPACE__ . '\print_hero_seen_script', 1);

/**
 * Front config: correct URLs whether WP lives in a subdir (dev) or the
 * domain root (prod). Used by scripts.js ([data-env-blog]) and archive-filter.js.
 */
function print_env_site_config()
{
  $blog_page = (int) get_option('page_for_posts');
  $config = [
    'blog' => $blog_page ? get_permalink($blog_page) : home_url('/'),
  ];

  printf('<script>window.ENV_SITE = %s;</script>', wp_json_encode($config));
}

add_action('wp_footer', __NAMESPACE__ . '\print_env_site_config');
