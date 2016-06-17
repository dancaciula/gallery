<?php

class Bw_theme {

    static function init() {
        
        if( ! is_admin() ) {
            
            add_action( 'init', array( 'Bw_theme', 'components' ) );
            
        }
    }

    static function components() {

        # assets
        self::enqueue_assets();

        # set the theme font styles
        Bw_theme_fonts::init();

        # theme header options
        Bw_theme_header_options::init();

        # theme footer options
        Bw_theme_footer_options::init();
    }

    static function enqueue_assets() {

        # css
        Bw_assets::addStyle( 'style', 'style.css' );
        Bw_assets::addStyle( 'bw-owl-carousel', 'assets/css/vendors/jquery.owl.carousel/owl.carousel.all.css' );
        Bw_assets::addStyle( 'bw-magnific-popup', 'assets/css/vendors/jquery.magnific-popup/magnific-popup.css' );
        Bw_assets::addStyle( 'bw-fotorama', 'assets/css/vendors/jquery.fotorama/fotorama.css' );
        Bw_assets::addStyle( 'bw-kenburns', 'assets/css/vendors/jquery.kenburns/kenburns.css' );
        Bw_assets::addStyle( 'bw-style', 'assets/css/style.css' );
        Bw_assets::addStyle( 'bw-media', 'assets/css/media.css' );

        # js
        if( Bw::get_option( 'enable_smooth_scroll' ) ) {
            Bw_assets::addScript( 'bw-smoothscroll', 'assets/js/vendors/smoothscroll/smoothscroll.min.js' );
        }
        
        wp_enqueue_script( 'comment-reply' );
        
        Bw_assets::addScript( 'bw-modernizr', 'assets/js/vendors/modernizr/modernizr.custom.js', array(), BW_VERSION, false );
        Bw_assets::addScript( 'bw-imagesloaded', 'assets/js/vendors/jquery.imagesloaded/imagesloaded.min.js' );
        Bw_assets::addScript( 'bw-owl-transitions', 'assets/js/vendors/jquery.owl.slider/owl.carousel.min.js' );
        Bw_assets::addScript( 'bw-magnific-popup-js', 'assets/js/vendors/jquery.magnific-popup/jquery.magnific-popup.min.js' );
        Bw_assets::addScript( 'bw-djax', 'assets/js/vendors/jquery.djax/jquery.djax.js' );
        Bw_assets::addScript( 'bw-preloader', 'assets/js/vendors/jquery.preloader/preloader.js' );
        Bw_assets::addScript( 'bw-tween-max', 'assets/js/vendors/tween-max/tweenmax.min.js' );
        Bw_assets::addScript( 'bw-easing', 'assets/js/vendors/jquery.easing/jquery.easing.1.3.js' );
        Bw_assets::addScript( 'bw-smartresize', 'assets/js/vendors/jquery-smartresize-master/jquery.debouncedresize.js' );
        Bw_assets::addScript( 'bw-isotope', 'assets/js/vendors/jquery.isotope/jquery.isotope.min.js' );
        Bw_assets::addScript( 'bw-mousewheel', 'assets/js/vendors/jquery.mousewheel/jquery.mousewheel.js' );
        Bw_assets::addScript( 'bw-fotorama-css', 'assets/js/vendors/jquery.fotorama/fotorama.js' );
        Bw_assets::addScript( 'bw-kenburns-js', 'assets/js/vendors/jquery.kenburns/kenburns.js' );
        
        # load jquery mobile when mobile device
        if( Bw::is_mobile() ) {
            //Bw_assets::addScript( 'bw-mobile', 'assets/js/vendors/jquery.mobile/jquery.mobile-1.4.3.min.js' );
        }
        
        Bw_assets::addScript( 'bw-main', 'assets/js/main.js', array( 'jquery' ) );
        
    }

}