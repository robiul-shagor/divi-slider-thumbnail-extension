<?php
class DSTE_SliderCarousel extends ET_Builder_Module {

	public $slug       = 'robiul_slider_carousel';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => 'Robiul Shagor',
		'author_uri' => 'https://themeforest.net/user/softhopper',
	);

	public function init() {
		$this->name = esc_html__( 'Slider Carousel', 'dste-divi-slider-thumbnail-extension' );

		$this->child_slug      = 'et_pb_slick_slide_mc';
		$this->child_item_text = esc_html__( 'Carousel Item' );

		wp_register_script( 'slick-carousel', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js', array('jquery'), '', true);
		wp_register_script( 'carousel-divi-module', plugin_dir_url( __FILE__ ) . 'carousel-divi-module.js', array('jquery','slick-carousel') );
		wp_register_style( 'carousel-divi-module-css', plugin_dir_url( __FILE__ ) . 'style.css' );
		wp_register_style('slick-css', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css');
		wp_register_style('slick-theme', '//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css');
		if(!is_admin()) {
			wp_enqueue_script('slick-carousel');
			wp_enqueue_script('carousel-divi-module');
			wp_enqueue_style('slick-css');
			wp_enqueue_style('slick-theme');
			wp_enqueue_style('carousel-divi-module-css');
		}

		$this->whitelisted_fields = array();
		foreach ( $this->get_fields() as $name => $field ) {
			$this->whitelisted_fields[] = $name;
		}

		$this->settings_modal_toggles = [
            'general'  => [
				'toggles' => array(
					'slider_settings' => et_builder_i18n( 'Slider Settings' ),
				),
            ],
			'advanced'   => array(
				'toggles' => array(
					'slider_box' => et_builder_i18n( 'Slider Style' ),
				),
			)
        ];
		
	}

	public function get_fields() {
		$fields = array(
			'admin_label' => array(
				'label'       => __( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => __( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			// Add a slider option for a custom setting
			'autoplay_main'         => array(
				'label'            => esc_html__( 'Autoplay Slider', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'slider_settings',
				'description'      => esc_html__( 'This setting will turn on and off the circle buttons at the bottom of the slider.', 'et_builder' ),
			),
			'show_arrows'             => array(
				'label'            => esc_html__( 'Show Arrows', 'et_builder' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'          => array(
					'on'  => et_builder_i18n( 'Yes' ),
					'off' => et_builder_i18n( 'No' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'      => 'slider_settings',
				'description'      => esc_html__( 'This setting will turn on and off the navigation arrows.', 'et_builder' ),
			),
			'custom_slider' => array(
				'label' => 'Thumbnail Item',
				'type' => 'range',
				'default' => '6',
				'default_unit' => '',
				'range_settings' => array(
					'min' => '0',
					'max' => '10',
					'step' => '1',
				),
				'mobile_options'   => true,
				'hover'            => 'tabs',
				'option_category' => 'configuration',
				'description' => 'Adjust the value using the slider',
				'toggle_slug'      => 'slider_settings',
			),
			'custom_slider_gap' => array(
				'label' => 'Thumbnail Item Gap',
				'type' => 'range',
				'default' => '15',
				'default_unit' => '',
				'range_settings' => array(
					'min' => '0',
					'max' => '100',
					'step' => '1',
				),
				'mobile_options'   => true,
				'hover'            => 'tabs',
				'option_category' => 'configuration',
				'description' => 'Adjust the value using the slider',
				'toggle_slug'      => 'slider_settings',
			),			
			
			// Add a slider option for style
			'slider_box_width' => array(
				'label' => 'Slider Box Width',
				'type' => 'range',
				'default' => '450',
				'default_unit' => 'px',
				'range_settings' => array(
					'min' => '0',
					'max' => '100',
					'step' => '1',
				),
				'option_category' => 'configuration',
				'description' => 'Adjust the value using the slider',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'slider_box',
				'mobile_options'   => true,
				'hover'            => 'tabs',
			),
			'slider_left_arrow_position' => array(
				'label' => 'Slider Left Arrow Positions',
				'type' => 'range',
				'default' => '20',
				'default_unit' => 'px',
				'range_settings' => array(
					'min' => '0',
					'max' => '100',
					'step' => '1',
				),
				'option_category' => 'configuration',
				'description' => 'Adjust the value using the slider',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'slider_box',
				'mobile_options'   => true,
				'hover'            => 'tabs',
			),
			'slider_right_arrow_position' => array(
				'label' => 'Slider Right Arrow Positions',
				'type' => 'range',
				'default' => '20',
				'default_unit' => 'px',
				'range_settings' => array(
					'min' => '0',
					'max' => '100',
					'step' => '1',
				),
				'option_category' => 'configuration',
				'description' => 'Adjust the value using the slider',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'slider_box',
				'mobile_options'   => true,
				'hover'            => 'tabs',
			),
			'slider_main_height' => array(
				'label' => 'Slider Height',
				'type' => 'range',
				'default' => '630',
				'default_unit' => 'px',
				'range_settings' => array(
					'min' => '0',
					'max' => '1000',
					'step' => '1',
				),
				'option_category' => 'configuration',
				'description' => 'Adjust the value using the slider',
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'slider_box',
				'mobile_options'   => true,
				'hover'            => 'tabs',
			),
			'box_background'     => array(
				'label'          => esc_html__( 'Content Box Background', 'et_builder' ),
				'description'    => esc_html__( 'Pick a color to use for the box background.', 'et_builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'slider_box',
				'mobile_options' => true,
				'sticky'         => true,
				'hover'          => 'tabs',
			),			
			'box_border_color'     => array(
				'label'          => esc_html__( 'Content Box Border Color', 'et_builder' ),
				'description'    => esc_html__( 'Pick a color to use for the box border.', 'et_builder' ),
				'type'           => 'color-alpha',
				'custom_color'   => true,
				'tab_slug'       => 'advanced',
				'toggle_slug'    => 'slider_box',
				'mobile_options' => true,
				'sticky'         => true,
				'hover'          => 'tabs',
			),
		);
		return $fields;
	}

	/**
	 * Module's advanced options configuration
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_advanced_fields_config() {
		$advanced_fields = [];

        $advanced_fields['text']         = [];
        $advanced_fields['width']         = false;
        $advanced_fields['borders']      = [];
        $advanced_fields['text_shadow']  = [];
        $advanced_fields['link_options'] = false;
        $advanced_fields['box_shadow'] = false;
        $advanced_fields['margin_padding'] = false;

        $advanced_fields['fonts']        = array(
			'body'   => array(
				'css'   => array(
					'line_height' => "{$this->main_css_element} .robiul_slider_carousel_main .slider-descriptions p",
					'plugin_main' => "{$this->main_css_element} .robiul_slider_carousel_main .slider-descriptions p",
					'text_shadow' => "{$this->main_css_element} .robiul_slider_carousel_main .slider-descriptions p",
				),
				'label' => esc_html__( 'Description', 'simp-simple' ),
			),
			'header' => array(
				'css'          => array(
					'main'      => "{$this->main_css_element} .robiul_slider_carousel_main h2",
					'important' => 'all',
				),
				'header_level' => array(
					'default' => 'h2',
				),
				'label'        => esc_html__( 'Main Title', 'simp-simple' ),
			),
		);

		$advanced_fields['button'] = array(
			'button' => array(
				'label' => esc_html__( 'Slider Button', 'et_builder' ),
				'css' => array(
					'main'         => ".slider-buttons"
				),
				'box_shadow'     => array(
				),						
				'margin_padding' => array(
					'css' => array(
						'main' => ".slider-buttons",
						'important' => 'all',
					),
				),
			)				
		);

        return $advanced_fields;
	}

	public function get_custom_css_fields_config() {
		return array(
			'content' => array(
				'label'    => esc_html__( 'Content Text', 'simp-simple' ),
				'selector' => '%%order_class%% .robiul_slider_carousel_main',
			),
			'heading' => array(
				'label'    => esc_html__( 'Heading', 'simp-simple' ),
				'selector' => '%%order_class%% .robiul_slider_carousel_main h2',
			),

		);
	}

	public function render( $attrs, $content = null, $render_slug = '' ) {
		$content 			  = $this->content;
		$show_arrows 		  = $this->props['show_arrows'] === 'on' ? true : false;
		$autoplay 		  = $this->props['autoplay_main'] === 'on' ? true : false;
		$slider_gap           = $this->props['custom_slider_gap'];
		$slider_item          = $this->props['custom_slider'];


		$slider_right_arrow_pos          = $this->props['slider_right_arrow_position'];
		$slider_left_arrow_pos          = $this->props['slider_left_arrow_position'];
		$slider_main_height          = $this->props['slider_main_height'];
		$box_background          = $this->props['box_background'];
		$box_border_color          = $this->props['box_border_color'];
		$slider_box_width          = $this->props['slider_box_width'];

		
		// Handle slider's previous background size default value ("default") as well
		if ( !empty( $slider_left_arrow_pos )  ) {
			$el_left_style = array(
				'selector'    => '%%order_class%% .slick-prev',
				'declaration' => sprintf(
					'left: %1$s !important;',
					$slider_left_arrow_pos
				),
			);
			ET_Builder_Module::set_style( $render_slug, $el_left_style );
		}		
		
		if ( !empty( $slider_right_arrow_pos )  ) {
			$el_right_style = array(
				'selector'    => '%%order_class%% .slick-next',
				'declaration' => sprintf(
					'right: %1$s !important;',
					$slider_right_arrow_pos
				),
			);
			ET_Builder_Module::set_style( $render_slug, $el_right_style );
		}		
		
		if ( !empty( $box_background )  ) {
			$box_background = array(
				'selector'    => '%%order_class%% .robiul_slider_carousel_main .slider-inner',
				'declaration' => sprintf(
					'background: %1$s !important;',
					$box_background
				),
			);
			ET_Builder_Module::set_style( $render_slug, $box_background );
		}		
		
		if ( !empty( $box_border_color )  ) {
			$box_border_color = array(
				'selector'    => '%%order_class%% .robiul_slider_carousel_main .slider-inner',
				'declaration' => sprintf(
					'border-bottom: 10px solid %1$s !important;',
					$box_border_color
				),
			);
			ET_Builder_Module::set_style( $render_slug, $box_border_color );
		}		
		
		if ( !empty( $slider_box_width )  ) {
			$slider_box_width = array(
				'selector'    => '%%order_class%% .robiul_slider_carousel_main .slider-inner',
				'declaration' => sprintf(
					'max-width: %1$s !important;',
					$slider_box_width
				),
			);
			ET_Builder_Module::set_style( $render_slug, $slider_box_width );
		}

		$slider_options_main = array(
			'autoplay' => $autoplay,
			'arrows' =>  $show_arrows,
		);			
		
		
		$slider_thumb = et_pb_responsive_options()->get_property_values( $this->props, 'custom_slider' );
		$slider_thumb_tablet = isset( $slider_thumb['tablet'] ) ? $slider_thumb['tablet'] : '';
		$slider_thumb_phone  = isset( $slider_thumb['phone'] ) ? $slider_thumb['phone'] : '';
		
		$slider_options_thumg = array(
			'slidesToShow' => $slider_thumb,
			'responsive' =>  array(
				array(
					'breakpoint' => 1140,
					'settings' => array(
						'slidesToShow' => ($slider_thumb_tablet + 1),
					)
				),			
				array(
					'breakpoint' => 780,
					'settings' => array(
						'slidesToShow' => $slider_thumb_tablet,
					)
				),			
				array(
					'breakpoint' => 600,
					'settings' => array(
						'slidesToShow' => $slider_thumb_phone,
					)
				),
			),
		);	
		
		$main_slider_setting = json_encode($slider_options_main);
		$thumb_slider_setting = json_encode($slider_options_thumg);
		return sprintf( '<div class="robiul-main-slider"><div class="robiul_slider_carousel_main" data-settings=%2$s>%1$s</div>
		<div class="robiul_slider_thumb" data-settings=%3$s>%1$s</div></div>', $content, $main_slider_setting, $thumb_slider_setting );
	}
}
new DSTE_SliderCarousel;

class ET_Builder_Module_Carousel_Item extends ET_Builder_Module {
	function init() {
		$this->name                        = esc_html__( 'Carousel Item' );
		$this->slug                        = 'et_pb_slick_slide_mc';
		$this->type                        = 'child';
		$this->vb_support 				   = 'on';

		$this->whitelisted_fields = array();
		foreach ( $this->get_fields() as $name => $field ) {
			$this->whitelisted_fields[] = $name;
		}

		$this->fields_defaults = array();

		$this->advanced_setting_title_text = esc_html__( 'Carousel Item' );
		$this->settings_text               = esc_html__( 'Carousels Item');
	}

	function get_fields() {
		$fields = array(
			'slider_image' => array(
				'label'              => esc_html__( 'Slider Image', 'et_builder' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => esc_attr__( 'Upload an image', 'et_builder' ),
				'choose_text'        => esc_attr__( 'Choose a Slider Image', 'et_builder' ),
				'update_text'        => esc_attr__( 'Set As Slider Image', 'et_builder' ),
				'description'        => esc_html__( 'Slider Images Add from here', 'et_builder' ),
			),
			'slider_title' => array(
				'label'           => esc_html__( 'Title', 'dicm-divi-custom-modules' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Text entered here will appear as title.', 'dicm-divi-custom-modules' ),
			),
			'slider_content' => array(
				'label'           => esc_html__( 'Content', 'dicm-divi-custom-modules' ),
				'type'            => 'textarea',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the slider.', 'dicm-divi-custom-modules' ),
			),
			'button_text' => array(
				'label'           => esc_html__( 'Button Text', 'dicm-divi-custom-modules' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input your desired button text, or leave blank for no button.', 'dicm-divi-custom-modules' ),
				'toggle_slug'     => 'button',
			),
			'button_url' => array(
				'label'           => esc_html__( 'Button URL', 'dicm-divi-custom-modules' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Input URL for your button.', 'dicm-divi-custom-modules' ),
				'toggle_slug'     => 'button',
			),
			'button_url_new_window' => array(
				'default'         => 'off',
				'default_on_front'=> true,
				'label'           => esc_html__( 'Url Opens', 'dicm-divi-custom-modules' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'In The Same Window', 'dicm-divi-custom-modules' ),
					'on'  => esc_html__( 'In The New Tab', 'dicm-divi-custom-modules' ),
				),
				'toggle_slug'     => 'button',
				'description'     => esc_html__( 'Choose whether your link opens in a new window or not', 'dicm-divi-custom-modules' ),
			),
		);
		return $fields;
	}

	public function get_advanced_fields_config()
    {

        $advanced_fields = [];

        $advanced_fields['text']         = [];
        $advanced_fields['borders']      = [];
        $advanced_fields['text_shadow']  = [];
        $advanced_fields['link_options'] = false;
        $advanced_fields['background'] 	 = false;
        $advanced_fields['fonts']        = [];

        return $advanced_fields;
    }

	function render( $atts, $content = null, $render_slug="" ) {

		$background_image = $this->props['slider_image'];
		$slider_title = $this->props['slider_title'];	
		$content = $this->props['slider_content'];	
		$button_url = $this->props['button_url'];	
		$button_text = $this->props['button_text'];	

		$output = sprintf(
			'<div class="slick-item">
				<div class="slider-wrapper" style="background-image: url(%1$s)">
					<div class="slider-inner">
						<img src="%1$s" class="slider-thumb" alt="%2$s"  />
						<h2 class="slider-title">%2$s</h2>
						<div class="slider-descriptions"><p>%3$s</p></div>
						<a href="%4$s" class="slider-buttons">%5$s</a>
					</div> <!-- .et_pb_slide_description -->
				</div> <!-- .et_pb_container -->
			</div>			
			',
			$background_image, 
			$slider_title, 
			$content, 
			$button_url, 
			$button_text, 
		);

		return $this->_render_module_wrapper( $output, $render_slug );
	}
}
new ET_Builder_Module_Carousel_Item;