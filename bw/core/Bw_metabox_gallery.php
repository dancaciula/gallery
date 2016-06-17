<?php

class Bw_metabox_gallery {

    static $metabox;

    static function init() {

        self::$metabox = array(
            'id' => 'general_gallery',
            'title' => 'Gallery',
            'desc' => '',
            'pages' => array( 'bw_gallery' ),
            'context' => 'normal', //side
            'priority' => 'high', //low
            'fields' => array(
                array(
                    'label' => 'Image gallery',
                    'id' => 'bw_gallery',
                    'type' => 'bw_gallery',
                    'desc' => ''
                ),
                array(
                    'label' => 'Gallery layout',
                    'id' => 'gallery_layout',
                    'type' => 'radio_image',
                    'desc' => '',
                    'choices' => array(
                        array(
                            'label' => 'Rail',
                            'value' => '',
                            'src' => BW_URI_FRAME_ASSETS . 'img/admin/layout_gallery/rail.png'
                        ),
                        array(
                            'label' => 'Isotope',
                            'value' => 'isotope',
                            'src' => BW_URI_FRAME_ASSETS . 'img/admin/layout_gallery/isotope2.png'
                        ),
                        array(
                            'label' => 'Isotope wall',
                            'value' => 'isotope-wall',
                            'src' => BW_URI_FRAME_ASSETS . 'img/admin/layout_gallery/isotope1.png'
                        ),
                        array(
                            'label' => 'Masonry',
                            'value' => 'masonry',
                            'src' => BW_URI_FRAME_ASSETS . 'img/admin/layout_gallery/masonry.png'
                        ),
                        array(
                            'label' => 'Fotorama',
                            'value' => 'fotorama',
                            'src' => BW_URI_FRAME_ASSETS . 'img/admin/layout_gallery/fotorama.png'
                        ),
                        array(
                            'label' => 'Kenburns',
                            'value' => 'kenburns',
                            'src' => BW_URI_FRAME_ASSETS . 'img/admin/layout_gallery/kenburns.png'
                        ),
                        array(
                            'label' => 'Metro',
                            'value' => 'metro',
                            'src' => BW_URI_FRAME_ASSETS . 'img/admin/layout_gallery/metro.png'
                        ),
                        array(
                            'label' => 'Catalog',
                            'value' => 'isotope-catalog',
                            'src' => BW_URI_FRAME_ASSETS . 'img/admin/layout_gallery/isotope-catalog.png'
                        )
                    )
                ),
                // category cover
                array(
                    'label' => 'Gallery cover image',
                    'id' => 'gallery_cover_image',
                    'type' => 'upload',
                    'desc' => '',
                    'class' => 'gallery-cover-image'
                ),
                array(
                    'label' => 'Gallery cover title',
                    'id' => 'gallery_cover_title',
                    'type' => 'text',
                    'desc' => '',
                    'class' => 'gallery-cover-image'
                ),
                array(
                    'label' => 'Gallery cover text',
                    'id' => 'gallery_cover_text',
                    'type' => 'text',
                    'desc' => '',
                    'class' => 'gallery-cover-image'
                ),
            )
        );

        ot_register_meta_box( self::$metabox );
    }

}

?>