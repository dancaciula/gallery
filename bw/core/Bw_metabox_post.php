<?php

class Bw_metabox_post {

    static $metabox;

    static function init() {

        self::$metabox = array(
            'id' => 'general_post',
            'title' => 'General post settings',
            'pages' => array( 'post' ),
            'context' => 'normal', //side
            'priority' => 'high', //low
            'class' => 'dynamic-meta', // add this class to dynamically change metas for post formats ( post type only )
            'fields' => array(
                # gallery
                array(
                    'label' => '',
                    'id' => 'bw_gallery',
                    'type' => 'bw_gallery',
                    'class' => 'post-format-gallery',
                ),
                array(
                    'label' => 'Slider options',
                    'id' => 'auto_height',
                    'type' => 'checkbox',
                    'choices' => array(
                        array(
                            'label' => 'Auto-height: check this so you can use diffrent heights on each slide. Don\'t use it on large content websites',
                            'value' => '1'
                        )
                    ),
                    'desc' => '',
                    'class' => 'post-format-gallery'
                ),
                array(
                    'label' => '',
                    'id' => 'auto_play',
                    'type' => 'checkbox',
                    'choices' => array(
                        array(
                            'label' => 'Auto-play: check this if you want your slider to play automatically',
                            'value' => '1'
                        )
                    ),
                    'desc' => '',
                    'class' => 'post-format-gallery'
                ),
                array(
                    'label' => '',
                    'id' => 'hide_nav',
                    'type' => 'checkbox',
                    'choices' => array(
                        array(
                            'label' => 'Hide navigation: this option will hide the previous and next button of the slider',
                            'value' => '1'
                        )
                    ),
                    'desc' => '',
                    'class' => 'post-format-gallery'
                ),
                array(
                    'label' => 'Slider effect',
                    'id' => 'slider_effect',
                    'type' => 'select',
                    'choices' => array(
                        array( 'label' => 'slide', 'value' => false ),
                        array( 'label' => 'fade', 'value' => 'fade' ),
                        array( 'label' => 'backSlide', 'value' => 'backSlide' ),
                        array( 'label' => 'goDown', 'value' => 'goDown' ),
                        array( 'label' => 'fadeUp', 'value' => 'fadeUp' ),
                    ),
                    'desc' => '',
                    'class' => 'post-format-gallery'
                ),
                # link
                array(
                    'label' => 'Link',
                    'id' => 'link_content',
                    'type' => 'text',
                    'desc' => 'Url of link, format: http://www.example.com',
                    'class' => 'post-format-link'
                ),
                array(
                    'label' => 'Link text',
                    'id' => 'link_text',
                    'type' => 'text',
                    'desc' => 'Text representation of the link',
                    'class' => 'post-format-link'
                ),
                array(
                    'label' => 'Link target',
                    'id' => 'link_target',
                    'type' => 'checkbox',
                    'choices' => array(
                        array(
                            'label' => 'Open link in a new page',
                            'value' => '1'
                        )
                    ),
                    'desc' => '',
                    'class' => 'post-format-link'
                ),
                # quote
                array(
                    'label' => 'Quote content',
                    'id' => 'quote_content',
                    'type' => 'textarea_simple',
                    'desc' => '',
                    'class' => 'post-format-quote'
                ),
                array(
                    'label' => 'Quote author',
                    'id' => 'quote_author',
                    'type' => 'text',
                    'desc' => '',
                    'class' => 'post-format-quote'
                ),
                # video
                array(
                    'label' => 'Embed code',
                    'id' => 'embed_code',
                    'type' => 'textarea_simple',
                    'desc' => '',
                    'class' => 'post-format-video'
                ),
                array(
                    'label' => 'Auto-height video',
                    'id' => 'embed_height',
                    'type' => 'checkbox',
                    'choices' => array(
                        array(
                            'label' => 'Check if you want your embed code to be dipsplayed in 16:9 aspect',
                            'value' => '1'
                        )
                    ),
                    'desc' => '',
                    'class' => 'post-format-video'
                ),
            )
        );

        ot_register_meta_box( self::$metabox );
    }

}

?>