<?php
/**
 * Redirect taxonomy archives to portfolio page with filter
 */

// Redirect tag archives to portfolio page
add_action('template_redirect', function() {
    if (is_tag() || is_category()) {
        $portfolio_page = get_page_by_path('portfolio'); // Change 'portfolio' to your portfolio page slug
        
        if ($portfolio_page) {
            $current_term = get_queried_object();
            $filter_url = get_permalink($portfolio_page->ID) . '?filter=' . $current_term->slug;
            wp_redirect($filter_url, 301);
            exit;
        }
    }
});

// Redirect custom taxonomy archives to portfolio page
add_action('template_redirect', function() {
    if (is_tax('portfolio_type')) { // Change 'portfolio_type' to your taxonomy name
        $portfolio_page = get_page_by_path('portfolio'); // Change 'portfolio' to your portfolio page slug
        
        if ($portfolio_page) {
            $current_term = get_queried_object();
            $filter_url = get_permalink($portfolio_page->ID) . '?filter=' . $current_term->slug;
            wp_redirect($filter_url, 301);
            exit;
        }
    }
});

