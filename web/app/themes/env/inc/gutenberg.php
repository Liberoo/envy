<?php

namespace Env\Inc;

/**
 * Get all registered core block patterns names
 */
function get_all_pattern_default()
{
    $get_patterns = \WP_Block_Patterns_Registry::get_instance()->get_all_registered();
    $pattern_names = array_map(
        function (array $pattern) {
            return $pattern['name'];
        },
        $get_patterns
    );

    return $pattern_names;
}

/**
 * gutenberg settings
 */
function setup()
{
    // add css style for editor admin
    add_theme_support('editor-styles');
    add_editor_style('style-editor.css');

    // add default block style
    add_theme_support('wp-block-styles');

    // responsive embed
    add_theme_support('responsive-embeds');

    // add category for theme patterns
    register_block_pattern_category('press-wind/press-wind-patterns', ['label' => __('Press Wind', 'press-wind')]);
	// add custom patterns category
	register_block_pattern_category('custom/custom-patterns', ['label' => __('Custom Patterns', 'press-wind')]);

    // Enable theme support for block patterns (needed for custom patterns to work)
    add_theme_support('core-block-patterns');

    // remove remote patterns
    add_filter('should_load_remote_block_patterns', '__return_false');

    // Remove all Core Patterns
    $registered_patterns = namespace\get_all_pattern_default();
    foreach ($registered_patterns as $pattern_name) {
        // if the name starts with 'core' remove it
        if (substr($pattern_name, 0, strlen('core')) === 'core') {
            unregister_block_pattern($pattern_name);
        }
    }

    add_post_type_support('page', 'excerpt');
}

add_action('init', __NAMESPACE__ . '\setup');

/**
 * Register custom block styles for buttons
 */
function register_button_styles()
{

    // Register pulse button style
    register_block_style('core/button', [
        'name' => 'pulse',
        'label' => __('Pulse', 'press-wind'),
        'style_handle' => 'button-pulse-style',
    ]);

    // Register pulse-reverse button style
    register_block_style('core/button', [
        'name' => 'pulse-reverse',
        'label' => __('Pulse Reverse', 'press-wind'),
        'style_handle' => 'button-pulse-reverse-style',
    ]);

    // Ghost: white outline on dark sections
    register_block_style('core/button', [
        'name' => 'ghost',
        'label' => __('Ghost', 'press-wind'),
    ]);

    // Mono: white bg / dark text, JetBrains Mono uppercase
    register_block_style('core/button', [
        'name' => 'mono',
        'label' => __('Mono', 'press-wind'),
    ]);

    // Mono Outline: same size as Mono, transparent with border, fills on hover
    register_block_style('core/button', [
        'name' => 'mono-outline',
        'label' => __('Mono Outline', 'press-wind'),
    ]);

}

add_action('init', __NAMESPACE__ . '\register_button_styles');

function block_category($categories)
{
    array_splice(
        $categories,
        2,
        0,
        [
            [
                'slug' => 'presswind',
                'title' => __('Presswind Theme', 'press-wind'),
            ],
        ]
    );

    return $categories;
}

add_filter('block_categories_all', __NAMESPACE__ . '\block_category', 10, 2);
