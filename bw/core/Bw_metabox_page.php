<?php

class Bw_metabox_page {
	
	static $metabox;
	
	static function init() {
		
		return false;
		
		self::$metabox = array(
		
			'id'          => 'general_page',
			'title'       => 'General page settings',
			'desc'        => '',
			'pages'       => array( 'page' ),
			'context'     => 'side', //side
			'priority'    => 'low', //low
			'fields'      => array(
				
				array(
					'label'       => 'Hide title',
					'id'          => 'hide_title',
					'type'        => 'checkbox',
					'desc'        => '',
					'choices'     => array(
						array(
							'label' => 'Yes',
							'value' => '1'
						)
					)
				),
				
				array(
					'label'       => 'Page layout',
					'id'          => 'page_layout',
					'type'        => 'radio_image',
					'desc'        => '',
					'choices'     => array(
						
						array(
							'label' => 'Full',
							'value' => 'full',
							'src' => BW_URI_FRAME_ASSETS.'img/admin/layouts_small/full.png'
						),
						array(
							'label' => 'Boxed',
							'value' => 'boxed',
							'src' => BW_URI_FRAME_ASSETS.'img/admin/layouts_small/boxed.png'
						),
						array(
							'label' => 'Image',
							'value' => 'left-part-image',
							'src' => BW_URI_FRAME_ASSETS.'img/admin/layouts_small/left-part-image.png'
						),
					)
				),
				
			)
		);
		
		ot_register_meta_box( self::$metabox );
		
	}
}

?>