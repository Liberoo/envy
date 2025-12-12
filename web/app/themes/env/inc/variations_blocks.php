<?php
/**
 * Related Posts Query Loop Variation.
 *
 * Provides a Query Loop block variation that displays 3 random related posts,
 * excluding the current post being viewed.
 *
 * @package WP_Performance
 */

namespace WP_Performance\Inc;

/**
 * Check if block is our Related Posts variation.
 *
 * @param array|object $block Block data or WP_Block instance.
 * @return bool True if this is our variation.
 */
function is_related_posts_variation( $block ) {
	$block_name = is_object( $block ) ? $block->name : ( isset( $block['blockName'] ) ? $block['blockName'] : '' );
	$attributes = is_object( $block ) ? $block->attributes : ( isset( $block['attrs'] ) ? $block['attrs'] : array() );

	return (
		'core/query' === $block_name &&
		isset( $attributes['namespace'] ) &&
		'wp-performance/related-post' === $attributes['namespace']
	);
}

/**
 * Get current post ID using reliable methods.
 *
 * @return int|null Current post ID or null if not found.
 */
function get_current_post_id() {
	// Method 1: get_queried_object_id() - most reliable for single posts.
	if ( is_singular() ) {
		$current_id = get_queried_object_id();
		if ( $current_id ) {
			return (int) $current_id;
		}
	}

	// Method 2: global $wp_query.
	global $wp_query;
	if ( isset( $wp_query->queried_object_id ) && $wp_query->queried_object_id ) {
		return (int) $wp_query->queried_object_id;
	}
	if ( isset( $wp_query->post->ID ) && $wp_query->post->ID ) {
		return (int) $wp_query->post->ID;
	}

	// Method 3: global $post.
	global $post;
	if ( isset( $post->ID ) && $post->ID ) {
		return (int) $post->ID;
	}

	// Method 4: get_the_ID().
	$current_id = get_the_ID();
	if ( $current_id ) {
		return (int) $current_id;
	}

	return null;
}

/**
 * Capture current post ID and store it in block attributes before Query Loop renders.
 *
 * This filter runs in the context of the main query, so we can reliably
 * get the current post ID and store it in block attributes for later use.
 *
 * @param array $parsed_block Parsed block data.
 * @param array $source_block  Source block data.
 * @param array $parent_block  Parent block data.
 * @return array Modified parsed block.
 */
add_filter(
	'render_block_data',
	function ( $parsed_block, $source_block, $parent_block ) {
		// Unused parameters required by filter signature.
		unset( $source_block, $parent_block );

		if ( ! is_related_posts_variation( $parsed_block ) ) {
			return $parsed_block;
		}

		$current_id = get_current_post_id();
		if ( ! $current_id ) {
			return $parsed_block;
		}

		// Store in block attributes for use in query filter.
		if ( ! isset( $parsed_block['attrs']['query'] ) ) {
			$parsed_block['attrs']['query'] = array();
		}
		$parsed_block['attrs']['query']['exclude'] = array( $current_id );

		return $parsed_block;
	},
	10,
	3
);

/**
 * Filter query vars for the related posts Query Loop variation.
 *
 * Excludes the current post (from block attributes) and ensures random order
 * with 3 posts limit.
 *
 * @param array    $query_vars Query variables.
 * @param WP_Block $block      Block instance.
 * @return array Modified query variables.
 */
add_filter(
	'query_loop_block_query_vars',
	function ( $query_vars, $block ) {
		if ( ! is_related_posts_variation( $block ) ) {
			return $query_vars;
		}

		$attributes = is_object( $block ) ? $block->attributes : ( isset( $block['attrs'] ) ? $block['attrs'] : array() );

		// Get exclude IDs from block attributes (set by render_block_data).
		$exclude_ids = array();
		if ( isset( $attributes['query']['exclude'] ) && is_array( $attributes['query']['exclude'] ) ) {
			$exclude_ids = array_filter( array_map( 'intval', $attributes['query']['exclude'] ) );
		}

		// Add to post__not_in if we have IDs to exclude.
		if ( ! empty( $exclude_ids ) ) {
			$existing_exclude           = isset( $query_vars['post__not_in'] ) ? (array) $query_vars['post__not_in'] : array();
			$query_vars['post__not_in']  = array_values( array_unique( array_merge( $existing_exclude, $exclude_ids ) ) );
		}

		// Set random order and limit to 3 posts.
		$query_vars['orderby']        = 'rand';
		$query_vars['posts_per_page'] = 3;

		return $query_vars;
	},
	20,
	2
);
