<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_post-general',
		'title' => 'Post - general',
		'fields' => array (
			array (
				'key' => 'field_53d47f776d466',
				'label' => 'Page layout',
				'name' => 'page_layout',
				'type' => 'radio_image',
				'choices' => array (
					'sidebar' => array (
						'label' => 'Sidebar',
						'img' => 'layout_portfolio/sidebar.png',
					),
					'full' => array (
						'label' => 'Full width',
						'img' => 'layout_portfolio/fit.png',
					),
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'sidebar',
				'layout' => 'vertical',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_portfolio-general',
		'title' => 'Portfolio - general',
		'fields' => array (
			array (
				'key' => 'field_53d008e29a8f7',
				'label' => 'Grid sub-title',
				'name' => 'sub_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'bw_portfolio',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_template-custom-category',
		'title' => 'Template - Custom Category',
		'fields' => array (
			array (
				'key' => 'field_53ceaa91cc812',
				'label' => 'Do you want to display a gallery or portfolio category?',
				'name' => 'gallery_or_portfolio',
				'type' => 'radio',
				'choices' => array (
					'gallery' => 'Gallery',
					'portfolio' => 'Portfolio',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'gallery',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_53cea90f9fbbd',
				'label' => 'Gallery',
				'name' => 'pt_gallery',
				'type' => 'page_link',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceaa91cc812',
							'operator' => '==',
							'value' => 'gallery',
						),
					),
					'allorany' => 'all',
				),
				'post_type' => array (
					0 => 'bw_gallery',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_53ceaa3ebdbcf',
				'label' => 'Portfolio',
				'name' => 'pt_portfolio',
				'type' => 'taxonomy',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53ceaa91cc812',
							'operator' => '==',
							'value' => 'portfolio',
						),
					),
					'allorany' => 'all',
				),
				'taxonomy' => 'portfolio',
				'field_type' => 'multi_select',
				'allow_null' => 0,
				'load_save_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'templates/custom-category.php',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_gallery-general',
		'title' => 'Gallery - general',
		'fields' => array (
			array (
				'key' => 'field_53c80a6d9b73d',
				'label' => 'Gallery',
				'name' => 'gallery',
				'type' => 'gallery',
				'instructions' => 'This is the description.',
				'layout' => 'vertical',
				'choices' => array (
				),
				'default_value' => '',
				'other_choice' => 0,
				'save_other_choice' => 0,
			),
			array (
				'key' => 'field_53c7b4985748c',
				'label' => 'Gallery type',
				'name' => 'gallery_type',
				'type' => 'radio_image',
				'choices' => array (
					'rail' => array (
						'label' => 'Rail',
						'img' => 'layout_gallery/rail.png',
					),
					'isotope' => array (
						'label' => 'Isotope',
						'img' => 'layout_gallery/isotope2.png',
					),
					'masonry' => array (
						'label' => 'Masonry',
						'img' => 'layout_gallery/masonry.png',
					),
					'fotorama' => array (
						'label' => 'Fotorama',
						'img' => 'layout_gallery/fotorama.png',
					),
					'kenburns' => array (
						'label' => 'Kenburns',
						'img' => 'layout_gallery/kenburns.png',
					),
					'metro' => array (
						'label' => 'Metro',
						'img' => 'layout_gallery/metro.png',
					),
					'isotope-catalog' => array (
						'label' => 'Catalog',
						'img' => 'layout_gallery/isotope-catalog.png',
					),
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'rail',
				'layout' => 'vertical',
			),
			array (
				'key' => 'field_53c8fcdab3bb3',
				'label' => 'Elements space',
				'name' => 'isotope_elements_space',
				'type' => 'number_slider',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53c7b4985748c',
							'operator' => '==',
							'value' => 'rail',
						),
						array (
							'field' => 'field_53c7b4985748c',
							'operator' => '==',
							'value' => 'isotope',
						),
						array (
							'field' => 'field_53c7b4985748c',
							'operator' => '==',
							'value' => 'masonry',
						),
						array (
							'field' => 'field_53c7b4985748c',
							'operator' => '==',
							'value' => 'metro',
						),
						array (
							'field' => 'field_53c7b4985748c',
							'operator' => '==',
							'value' => 'isotope-catalog',
						),
					),
					'allorany' => 'any',
				),
				'default_value' => '',
				'prepend' => '',
				'append' => 'px',
				'min' => '',
				'max' => 50,
				'step' => '',
			),
			array (
				'key' => 'field_53c8f90eb6fca',
				'label' => 'Enable gallery cover',
				'name' => 'enable_gallery_cover',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_53c8f926b6fcb',
				'label' => 'Gallery cover image',
				'name' => 'gallery_cover_image',
				'type' => 'image',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53c8f90eb6fca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_53c8f95fb6fcc',
				'label' => 'Gallery cover title',
				'name' => 'gallery_cover_title',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53c8f90eb6fca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53c8f976b6fcd',
				'label' => 'Gallery cover text',
				'name' => 'gallery_cover_text',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53c8f90eb6fca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53c90b562452a',
				'label' => 'Gallery cover color',
				'name' => 'gallery_cover_color',
				'type' => 'color_picker',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_53c8f90eb6fca',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '#000000',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'bw_gallery',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_page-general',
		'title' => 'Page - general',
		'fields' => array (
			array (
				'key' => 'field_53bd4d3039441',
				'label' => 'Sub title',
				'name' => 'page_sub_title',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53bd4163a2e3a',
				'label' => 'Background image',
				'name' => 'page_bg_img',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			),
			array (
				'key' => 'field_53bf7264f1b6d',
				'label' => 'White page background',
				'name' => 'white_page_bg',
				'type' => 'true_false',
				'instructions' => 'Check this options if you want you page to be white. Recommended when using image for background.',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_53bf75dda2369',
				'label' => 'Fixed page width',
				'name' => 'fixed_page_width',
				'type' => 'true_false',
				'instructions' => 'Check this options to fix your page on the screen.',
				'message' => '',
				'default_value' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'default',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_image-general',
		'title' => 'Image - general',
		'fields' => array (
			array (
				'key' => 'field_53bfa413492ee',
				'label' => 'Video url',
				'name' => 'embed_video',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53d0b01a5d34b',
				'label' => 'Image source label',
				'name' => 'image_source_label',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53d0b00f5d34a',
				'label' => 'Image source_url',
				'name' => 'image_source_url',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_53bacddd97289',
				'label' => 'Metro gallery - Element width',
				'name' => 'metro_width',
				'type' => 'select',
				'instructions' => 'Use for metro gallery only',
				'choices' => array (
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
				),
				'default_value' => 1,
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_53bac8900184c',
				'label' => 'Metro gallery - Element height',
				'name' => 'metro_height',
				'type' => 'select',
				'instructions' => 'Use for metro gallery only',
				'choices' => array (
					1 => 1,
					2 => 2,
					3 => 3,
					4 => 4,
				),
				'default_value' => 1,
				'allow_null' => 0,
				'multiple' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_media',
					'operator' => '==',
					'value' => 'all',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
