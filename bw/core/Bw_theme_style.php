<?php

class Bw_theme_style {

    // option [ default_value ]
    static $options = array(
        'main_color' => '#e9685d',
        'test' => '',
        'menu_bg_image' => '',
    );

    static function init() {

        $variables = self::collect();
        self::style( $variables );
    }

    static function collect() {

        foreach( self::$options as $option => $default ) {
            $variables[$option] = Bw::get_option( $option, $default );
        }
        return $variables;
    }

    static function style( $ot ) {

        $style = "
            
            /* background */
			.woocommerce span.onsale, .woocommerce-page span.onsale, .isotope-filter .filter-content li:hover, .isotope-filter .filter-content em, #rail-info .img-desc a:after, .social-holder .pad {background-color:{$ot['main_color']}}
            
            /* color */
			.woocommerce .product_meta a, #main-menu .bottom-part a:hover, .isotope-portfolio .portfolio-info .rate i, blockquote:before, .post .the-date a, a, a:visited, a:focus {color:{$ot['main_color']}}
            
            /* border */
            #main-menu .bottom-part p, .isotope-portfolio .portfolio-info ul li {border-color:{$ot['main_color']}}
            
            .single_add_to_cart_button:hover {background-color:{$ot['main_color']}!important}
            
		";

        if( !empty( $ot['menu_bg_image'] ) ) {
            $style .= "#main-menu {background:#353535 url('{$ot['menu_bg_image']}') no-repeat center center fixed;}";
            $style .= "#main-menu {background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;z-index:5;}";
        }

        printf( "<style>%s</style>", $style );
    }

}

?>