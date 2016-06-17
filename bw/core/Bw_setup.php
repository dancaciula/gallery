<?php

/* 
 * Sets up theme defaults
 */
class Bw_setup {
	
	static $post_formats = array(
		'default' => array( 'image', 'gallery', 'video', 'quote', 'link' ),
		'bw_portfolio' => array( 'gallery', 'video' )
	);
	
	static function init() {
		
		add_action( 'after_setup_theme', array('Bw_setup', 'setup') );
		
		add_action( 'admin_head', array( 'Bw_setup', 'assign_post_formats' ) );
		
	}
	
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	static function setup() {
		
		/**
		 * http://codex.wordpress.org/Content_Width
		 */
		if ( ! isset($content_width)) { $content_width = 960; }
		
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /lang/ directory.
		 * If you're building a theme based on Bad Weather framework, use a find and replace
		 * to change 'BW_THEME' static variable to the name of your theme, located in bootstrap.php
		 */
		load_theme_textdomain( BW_THEME, get_template_directory() . '/lang' );
		//load_textdomain('marroco', get_template_directory() . '/lang/default.mo');
		
		# Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		# This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', BW_THEME ),
		) );
		register_nav_menus( array(
			'secondary' => __( 'Secondary Menu', BW_THEME ),
		) );
		
		# Enable support for Post Formats.
		add_theme_support( 'post-formats', self::$post_formats['default'] );

		# Setup the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bad_weather_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		# Enable support for HTML5 markup.
		add_theme_support( 'html5',
			array(
				'comment-list',
				'search-form',
				'comment-form',
				'gallery',
			)
		);
		
		# remove parentheses from category list and add span class to post count
		add_filter('wp_list_categories', array('Bw_setup', 'categories_postcount_filter'));
		
		# same for archives
		add_filter('get_archives_link', array('Bw_setup', 'archive_postcount_filter'));
		
		# custom excerpt text
		add_filter('excerpt_more', array('Bw_setup', 'new_excerpt_more'));
		
		# custom excerpt length
		add_filter('excerpt_length', array('Bw_setup', 'new_excerpt_length'), 999);
		
		# author\'s social media details
		add_filter('user_contactmethods', array('Bw_setup', 'custom_author_social_details'));
		
		# add wp admin bar menu items
		add_filter('admin_bar_menu', array('Bw_setup', 'admin_bar_items'), 999);
		
		# check password of protected posts
		add_filter('wp', array('Bw_setup', 'check_post_pass'));
        
        # assign white preloader layers.
        add_filter('category_link', array( 'Bw_setup', 'bw_query_vars' ) );
        add_filter('post_link', array( 'Bw_setup', 'bw_query_vars' ) );
        add_filter('post_type_link', array( 'Bw_setup', 'bw_query_vars_posttype' ) );
	}
    
    static function bw_query_vars( $link ) {
        return add_query_arg( 'bw', '', $link );
    }
    
    static function bw_query_vars_posttype( $link ) {
        if(get_post_type() == 'bw_portfolio') {
            return add_query_arg( 'bw', '', $link );
        }else{
            return $link;
        }
    }
	
	static function assign_post_formats() {
		
		global $post;
		
		if ( isset( $post->ID ) ) {
		
			$post_id = $post->ID;
			
			$post_type = $post->post_type;
			
			if( array_key_exists( $post_type, self::$post_formats) ) {
				add_theme_support( 'post-formats', self::$post_formats[$post_type] );
			}
		}
	}
	
	static function categories_postcount_filter($variable) {
		$variable = str_replace('(', '<span class="post-count">', $variable);
		$variable = str_replace(')', '</span>', $variable);
		return $variable;
	}
	
	static function archive_postcount_filter($links) {
		$links = str_replace('</a>&nbsp;(', '</a>&nbsp;<span class="post-count">', $links);
		$links = str_replace(')', '</span>', $links);
		return $links;
	}
	
	static function new_excerpt_more() {
		return ' ...';
	}
	
	static function new_excerpt_length( $length ) {
		return 15;
	}
	
	static function custom_author_social_details( $details ) {
		return $details = array(
			'twitter' => 'Twitter',
			'facebook' => 'Facebook',
			'google_plus' => 'Google plus',
		);
	}
	
	static function admin_bar_items( $wp_admin_bar ) {
		$args = array(
			'id'    => 'bw_theme_options',
			'title' => 'Theme Options',
			'href'  => admin_url('themes.php?page=ot-theme-options'),
			'meta'  => array( 'class' => 'bw-admin-bar-options' )
		);
		$wp_admin_bar->add_node( $args );
	}
	
	static function check_post_pass() {

		if(!is_single() || !post_password_required()) return;

		global $post;
		
		if(isset($_COOKIE['wp-postpass_'.COOKIEHASH]) && $_COOKIE['wp-postpass_'.COOKIEHASH] !== $post->post_password) {

			define('BW_INVALID_POST_PASS', true);

			// tell the browser to remove the cookie so the message doesn't show up every time
			setcookie('wp-postpass_'.COOKIEHASH, NULL, -1, COOKIEPATH);
		}
	}
	
}

?>