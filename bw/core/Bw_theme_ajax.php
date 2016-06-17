<?php

class Bw_theme_ajax {
    
    static $funcs = array(
        '__call_likebox'
    );

    static function init() {

        # localize script
        add_action( 'wp_footer', array( 'Bw_theme_ajax', 'bad_weather_ajax' ) );

        self::alocate_callbacks();
        
    }

    static function bad_weather_ajax() {
        
        wp_localize_script( 'bw-main', 'bw_theme_ajax', array(
            'ajax' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'ajax-nonce' )
        ));
        
    }

    static function alocate_callbacks() {
        
        foreach( self::$funcs as $func ) {
            
            add_action( 'wp_ajax_nopriv_' . $func, array( 'Bw_theme_ajax', $func ) );
            add_action( 'wp_ajax_' . $func, array( 'Bw_theme_ajax', $func ) );
            
        }
    }
    
    static function __call_likebox() {
        
        // Check for nonce security
        $nonce = $_POST['nonce'];
      
        if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
            die ( 'Busted!');
        }
         
        if(isset($_POST['post_like'])) {
            // Retrieve user IP address
            $ip = $_SERVER['REMOTE_ADDR'];
            $post_id = $_POST['post_id'];
             
            // Get voters'IPs for the current post
            $meta_IP = get_post_meta($post_id, "voted_IP");
            
            $voted_IP = isset($meta_IP[0]) ? $meta_IP[0] : false;
     
            if(!is_array($voted_IP))
                $voted_IP = array();
             
            // Get votes count for the current post
            $meta_count = get_post_meta($post_id, "votes_count", true);
     
            // Use has already voted ?
            if( ! Bw_theme_ajax::has_voted($post_id)) {
                $voted_IP[$ip] = time();
     
                // Save IP and increase votes count
                update_post_meta($post_id, "voted_IP", $voted_IP);
                update_post_meta($post_id, "votes_count", ++$meta_count);
                 
                // Display count (ie jQuery return value)
                echo $meta_count;
            } else {
                echo "already";
            }
        }
        exit;
    }
    
    static function has_voted($post_id) {
        
        $timebeforerevote = 120; // 2 hours
     
        // Retrieve post votes IPs
        $meta_IP = get_post_meta($post_id, "voted_IP");
        $voted_IP = isset($meta_IP[0]) ? $meta_IP[0] : false;
         
        if(!is_array($voted_IP))
            $voted_IP = array();
             
        // Retrieve current user IP
        $ip = $_SERVER['REMOTE_ADDR'];
         
        // If user has already voted
        if(in_array($ip, array_keys($voted_IP))) {
            
            $time = $voted_IP[$ip];
            $now = time();
            
            // Compare between current time and vote time
            if(round(($now - $time) / 60) > $timebeforerevote) {
                return false;
            }
            
            return true;
        }
        
        return false;
    }
    
    static function get_vote( $post_id = 0 ) {
        $vote = get_post_meta( $post_id, "votes_count", true );
        return ( $vote > 0 ) ? $vote : 0;
    }

}
