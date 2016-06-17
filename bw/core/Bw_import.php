<?php

class Bw_import {
	
	static $demo;
	
	static $importer;
	
	static $message;
	
	static $menus = array(
		'primary' => 'Primary - left',
		'secondary' => 'Primary - right'
	);
	
	static $static_pages = array(
		'home_page_name' => 'Home',
		'blog_page_name' => 'Journal'
	);
	
	static function init() {
		
		self::$demo = BW_DEMO.'theme-demo.xml';
		
		self::create_importer();
		
		self::assign_menus();
		
		self::assign_static_pages();
		
		self::set_permalink_format();
		
		//self::assign_widgets_content();
		
		//self::assign_custom_post_meta();
		
		self::finish();
		
	}
	
	static function create_importer() {
		
		if (!class_exists("WP_Import")) {
			if (!defined("WP_LOAD_IMPORTERS")) define("WP_LOAD_IMPORTERS",true);
			require_once(BW_FRAME_LIB."wordpress-importer/wordpress-importer.php");
		}

		self::$importer = new WP_Import();
		self::$importer->fetch_attachments = true;
		
		self::import();
		
	}
	
	static function import() {
		
		set_time_limit(0);
		ob_start();
		add_action('import_end', array('Bw_import','import_end'));
		self::$importer->import(self::$demo);
		
	}
	
	static function import_end() {
		self::$message = ob_get_contents();
	}
	
	static function assign_menus() {
		
		$locations = array();
		
		foreach(self::$menus as $menu_location => $menu_name) {
			
			$menu = get_term_by('name', $menu_name, 'nav_menu');
			$locations[$menu_location] = $menu->term_id;
		}
		
		if( count( $locations ) ) {
			set_theme_mod('nav_menu_locations', $locations);
		}
	}
	
	static function assign_static_pages() {
		
		# Front page displays: a static page
		update_option( 'show_on_front', 'page' );
		
		# static front page
		$about = get_page_by_title( self::$static_pages['home_page_name'] );
		if( is_object( $about ) ) {
			update_option( 'page_on_front', $about->ID );
		}

		# static blog page
		$blog = get_page_by_title( self::$static_pages['blog_page_name'] );
		if( is_object( $blog ) ) {
			update_option( 'page_for_posts', $blog->ID );
		}
	}
    
	static function set_permalink_format() {
        
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
        $wp_rewrite->flush_rules();
        
    }
	
	static function assign_widgets_content() {
		
		$import_array = array(
			//'sidebars_widgets' 				=> 'YTo3OntzOjY6ImZvb3RlciI7YTowOnt9czoxOToid3BfaW5hY3RpdmVfd2lkZ2V0cyI7YTowOnt9czo5OiJzaWRlYmFyLTEiO2E6NTp7aTowO3M6NjoidGV4dC0yIjtpOjE7czoxOToiYndfbGF0ZXN0X3Jldmlld3MtMiI7aToyO3M6MTk6ImJ3X3BvbHVwYWxfd2lkZ2V0LTIiO2k6MztzOjExOiJ0YWdfY2xvdWQtMiI7aTo0O3M6MTg6ImJ3X3NsaWRlcl93aWRnZXQtMiI7fXM6ODoiZm9vdGVyXzEiO2E6MTp7aTowO3M6MTg6ImJ3X3NsaWRlcl93aWRnZXQtMyI7fXM6ODoiZm9vdGVyXzIiO2E6MTp7aTowO3M6MTQ6InJlY2VudC1wb3N0cy0yIjt9czo4OiJmb290ZXJfMyI7YToyOntpOjA7czoxOToiYndfbGF0ZXN0X3Jldmlld3MtMyI7aToxO3M6NjoidGV4dC0zIjt9czoxMzoiYXJyYXlfdmVyc2lvbiI7aTozO30=',
			//'widget_text'					=> 'YTozOntpOjI7YTozOntzOjU6InRpdGxlIjtzOjA6IiI7czo0OiJ0ZXh0IjtzOjMxNToiPGEgaHJlZj0iIyIgc3R5bGU9ImZsb2F0OmxlZnQ7d2lkdGg6MTAwJTt0ZXh0LWFsaWduOmNlbnRlcjsiPjxpbWcgY2xhc3M9ImxhenkiIGRhdGEtc3JjPSJodHRwOi8vYndkZXNrLmNvbS9tYXJyb2NvL2RlbW8tY29udGVudC93cC1jb250ZW50L3VwbG9hZHMvMjAxNC8wNi9iYW5uZXJfMzAweDI1MC5wbmciIGFsdD0iIiBzcmM9Imh0dHA6Ly9id2Rlc2suY29tL21hcnJvY28vZGVtby1jb250ZW50L3dwLWNvbnRlbnQvdGhlbWVzL21hcnJvY28vYXNzZXRzL2ltZy9lbXB0eS9waXhlbC5wbmciIHN0eWxlPSJ2ZXJ0aWNhbC1hbGlnbjpib3R0b207Ij48L2E+IjtzOjY6ImZpbHRlciI7YjowO31pOjM7YTozOntzOjU6InRpdGxlIjtzOjk6IlNvbWUgdGV4dCI7czo0OiJ0ZXh0IjtzOjE4MDoiTG9yZW0gaXBzdW0gZG9sb3Igc2l0IGFtZXQsIGNvbnNlY3RldHVyIGFkaXBpc2NpbmcgZWxpdC4gRHVpcyBxdWlzIHNvZGFsZXMgbGVvLiBEdWlzIGFkaXBpc2NpbmcsIHVybmEgdmVsIHZpdmVycmEgZGlnbmlzc2ltLCBhbnRlIHZlbGl0IHBvc3VlcmUgZXJvcywgYSBjb25zZWN0ZXR1ciBkdWkgbnVuYyBzZWQgbWkuIjtzOjY6ImZpbHRlciI7YjowO31zOjEyOiJfbXVsdGl3aWRnZXQiO2k6MTt9',
		);
		
		if( count($import_array) ) {
			foreach($import_array as $import_option => $import_value) {
				update_option($import_option, unserialize(trim(base64_decode($import_value))));
			}
		}
		
	}
	
	static function assign_custom_post_meta() {
		
		$post_metas = array(
			//array('post_id' => '40', 'meta_key' => 'bw_megamenu_layout', 'meta_value' => 'slider_latest_posts'),
		);
		
		if( count($post_metas) ) {
			foreach($post_metas as $post_meta) {
				add_post_meta($post_meta['post_id'], $post_meta['meta_key'], $post_meta['meta_value']);
			}
		}
		
	}
	
	static function finish() {
		
		# demo data was installed
		update_option( 'bw_demo_was_installed', true );
		
		# output message
		return self::$message;
	}
}

?>