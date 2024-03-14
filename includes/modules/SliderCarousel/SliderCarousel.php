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
		
	}

	public function get_fields() {
		$fields = array(
			'admin_label' => array(
				'label'       => __( 'Admin Label', 'et_builder' ),
				'type'        => 'text',
				'description' => __( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),
			),
			'link_options' => array()
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
        $advanced_fields['borders']      = [];
        $advanced_fields['text_shadow']  = [];
        $advanced_fields['link_options'] = [];
        $advanced_fields['fonts']        = array(
			'body'   => array(
				'css'   => array(
					'line_height' => "{$this->main_css_element} .robiul_slider_carousel_main .slider-descriptions p",
					'plugin_main' => "{$this->main_css_element} .robiul_slider_carousel_main .slider-descriptions p",
					'text_shadow' => "{$this->main_css_element} .robiul_slider_carousel_main .slider-descriptions p",
				),
				'label' => esc_html__( 'Description Text', 'simp-simple' ),
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
				'box_shadow'     => array(
					'css' => array(
						'main' => "{$this->main_css_element} .robiul_slider_carousel_main a",
					),
				),				
				'fonts'     => array(
					'css' => array(
						'main' => ".robiul_slider_carousel_main a",
						'important' => 'all',
					),
				),			
				'margin_padding' => array(
					'css' => array(
						'main' => ".robiul_slider_carousel_main a",
						'important' => 'all',
					),
				),
			)				
		);

        return $advanced_fields;
	}

	// public function get_custom_css_fields_config() {
	// 	return array(
	// 		'content' => array(
	// 			'label'    => esc_html__( 'Content', 'simp-simple' ),
	// 			'selector' => '%%order_class%% .robiul_slider_carousel_main p',
	// 		),
	// 		'heading' => array(
	// 			'label'    => esc_html__( 'Heading', 'simp-simple' ),
	// 			'selector' => '%%order_class%% .robiul_slider_carousel_main h2',
	// 		),
	// 	);
	// }

	public function render( $attrs, $content = null, $render_slug = '' ) {
		$content = $this->content;
		return sprintf( '<div class="robiul-main-slider"><div class="robiul_slider_carousel_main">%1$s</div>
		<div class="robiul_slider_thumb">%1$s</div></div>', $content );
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
				'type'            => 'tiny_mce',
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
        $advanced_fields['link_options'] = [];
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
						<img src="%1$s" class="%2$s" />
						<h2 class="slider-title">%2$s</h2>
						<div class="slider-descriptions">%3$s</div>
						<a href="%4$s">%5$s</a>
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