<?php

class Bw_post_type_portfolio {
	
	static $enable = true;
	
	static $name = 'bw_portfolio';
	
	static function init() {
		
		if(!self::$enable) return;
		
		/*
		 * Uncomment for post formats to the current post type.
		 */
		# add_post_type_support( 'bw_gallery', 'post-formats' );
		
		register_post_type( 'bw_portfolio',
			array(
				'menu_icon' => 'dashicons-portfolio',
				'labels' => array (
					'name' => __('Portfolio', BW_THEME),
					'singular_name' => __('Portfolio', BW_THEME),
					'add_new' => __('Add New', BW_THEME),
					'add_new_item' => __('Add New project', BW_THEME),
					'edit_item' => __('Edit project', BW_THEME),
					'new_item' => __('New project', BW_THEME),
					'all_items' => __('All projects', BW_THEME),
					'view_item' => __('View project', BW_THEME),
					'search_items' => __('Search projects', BW_THEME),
					'not_found' => __('No projects found', BW_THEME),
					'not_found_in_trash' => __('No projects found in Trash', BW_THEME),
					'menu_name' => __('Portfolio', BW_THEME),
				),
				'taxonomies' => array('portfolio'),
				'public' => true,
				'rewrite' => array(
					'slug' => 'project',
					'with_front' => false
				),
				'has_archive' => 'bw_portfolio',
				'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt', 'post-formats' ),
			)
		);
		
	}
	
}

?>