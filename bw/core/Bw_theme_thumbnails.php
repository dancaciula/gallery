<?php

class Bw_theme_thumbnails {
	
	static function init() {
		
		/*
		 * Enabling Support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' ); 
		
		self::add_thumbs();
	}
	
	static function add_thumbs() {
            
            // full image previews
            add_image_size( 'thumb_1920x1080', 1920, 1080 );
            add_image_size( 'thumb_1920x1080_true', 1920, 1080, true );
            // isotope
            add_image_size( 'thumb_424x500_true', 424, 500, true );
            // isotope - catalog
            add_image_size( 'thumb_520x820_true', 520, 820, true );
            // isotope - masonry
            add_image_size( 'thumb_424x500', 424, 500 );
            // isotope - metro - big element
            add_image_size( 'thumb_920x732', 920, 732 );
            // journal
            add_image_size( 'thumb_480_false', 480, 9999, false );
            // journal slider
            add_image_size( 'thumb_480x500_true', 480, 500, true );
            // portfolio gallery
            add_image_size( 'thumb_960', 960, 9999, false );
            // journal gallery
            add_image_size( 'thumb_920_520_true', 920, 520, true );
		
	}
}