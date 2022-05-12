<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Slidedown Banner Widget.
 *
 * Slider for showing attorneys.
 *
 * @since 1.0.0
 */
class Elementor_Slidedown_Banner extends \Elementor\Widget_Base {

	/**
	 * Constructor function.
	 *
	 * @param array $data
	 * @param array $args
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		wp_register_script( 'slidedown-banner-script', plugins_url( '/assets/js/slidedown-banner.js', dirname( __FILE__ ) ), array( 'jquery', 'elementor-frontend' ), '1.0.0', true );
		wp_register_style( 'slidedown-banner-style', plugins_url( '/assets/css/slidedown-banner.css', dirname( __FILE__ ) ) );
	}

	/**
	 * Get scripts for the widget.
	 *
	 * @return array JS handles
	 */
	public function get_script_depends() {
		return array( 'slidedown-banner-script' );
	}

	/**
	 * Get styles for the widget.
	 *
	 * @return array CSS Handles.
	 */
	public function get_style_depends() {
		return array( 'slidedown-banner-style' );

	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Slidedown Banner widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'slidedown_banner';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Slidedown Banner widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Slidedown Banner', 'lawclerk' );
	}

		/**
		 * Get widget icon.
		 *
		 * Retrieve currency widget icon.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return string Widget icon.
		 */
	public function get_icon() {
		return 'eicon-banner';
	}

		/**
		 * Get widget categories.
		 *
		 * Retrieve the list of categories the Slidedown Banner widget belongs to.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return array Widget categories.
		 */
	public function get_categories() {
		return array( 'basic' );
	}

		/**
		 * Get widget keywords.
		 *
		 * Retrieve the list of keywords the Slidedown Banner widget belongs to.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return array Widget keywords.
		 */
	public function get_keywords() {
		return array( 'banner', 'lawclerk', 'slidedown' );
	}

		/**
		 * Register widget controls.
		 *
		 * Add input fields to allow the user to customize the widget settings.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'lawclerk' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'banner_text',
			[
				'label' => esc_html__( 'Banner text', 'lawclerk' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Type the text for the banner here', 'lawclerk' ),
			]
		);

		$this->add_control(
			'banner_btn_text',
			[
				'label' => esc_html__( 'Button text', 'lawclerk' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Click here', 'lawclerk' ),
			]
		);

		$this->add_control(
			'banner_btn_link',
			[
				'label' => esc_html__( 'Button link', 'lawclerk' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://www.lawclerk.legal/', 'lawclerk' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['banner_btn_link']['url'] ) ) {
			$this->add_link_attributes( 'banner_btn_link', $settings['banner_btn_link'] );
		}
		?>

		<div class="banner">
			<div class="banner__col banner__col--1">

				<p class="banner__text"><?php echo $settings['banner_text']; ?></p>

			</div>
			<div class="banner__col banner__col--2">

				<a class="banner__btn" <?php echo $this->get_render_attribute_string( 'banner_btn_link' ); ?>><?php echo $settings['banner_btn_text']; ?></a>

			</div>
			<button class="banner__close">&times;</button>
		</div>


		<?php
	}
}
