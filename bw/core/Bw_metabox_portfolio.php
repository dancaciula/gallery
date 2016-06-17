<?php

class Bw_metabox_portfolio {

    static $metabox;

    static function init() {

        self::$metabox = array(
            'id' => 'general_portfolio',
            'title' => 'Portfolio general settings',
            'desc' => '',
            'pages' => array( 'bw_portfolio' ),
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
                /*array(
                    'label' => '',
                    'id' => 'slider_layout',
                    'type' => 'radio_image',
                    'desc' => '',
                    'class' => 'post-format-gallery',
                    'choices' => array(
                        array(
                            'label' => 'Normal',
                            'value' => '',
                            'src' => BW_URI_FRAME_ASSETS . 'img/admin/layout_portfolio/normal.png'
                        ),
                        array(
                            'label' => 'Fit to container',
                            'value' => 'fit',
                            'src' => BW_URI_FRAME_ASSETS . 'img/admin/layout_portfolio/fit.png'
                        ),
                        array(
                            'label' => 'Full page image',
                            'value' => 'full',
                            'src' => BW_URI_FRAME_ASSETS . 'img/admin/layout_portfolio/resize.png'
                        ),
                    )
                ),*/
                array(
                    'label' => 'Embed code',
                    'id' => 'embed_code',
                    'type' => 'textarea',
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