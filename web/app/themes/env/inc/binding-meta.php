<?php

namespace Env\Inc;


function get_hero_category($args)
{
    global $post;

    if ($post && $post->post_type === 'post') {
        return __('Artykuły, archiwa i kategorie', 'press-wind');
    }

    return __('Archiwa i kategorie', 'press-wind');
}




function register_block_bindings()
{
    register_meta(
        'post',
        'wp_performance-page-thematic',
        array(
            'show_in_rest'      => true,
            'single'            => true,
            'type'              => 'string',
            'sanitize_callback' => 'wp_strip_all_tags',
            'default'           => 'Totalement open-source',
        )
    );

    register_block_bindings_source('wpperformance/hero-category', array(
        'label'              => __('Hero theme category', 'press-wind'),
        'get_value_callback' =>  __NAMESPACE__ . '\get_hero_category',
    ));
}

add_action('init', __NAMESPACE__ . '\register_block_bindings');
