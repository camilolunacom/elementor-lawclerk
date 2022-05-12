<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Attorneys Slider Widget.
 *
 * Slider for showing attorneys.
 *
 * @since 1.0.0
 */
class Elementor_Slider_Attorneys extends \Elementor\Widget_Base {

	/**
	 * Constructor function.
	 *
	 * @param array $data
	 * @param array $args
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		wp_register_script( 'slider-attorneys-script', plugins_url( '/assets/js/slider-attorneys.js', dirname( __FILE__ ) ), array( 'jquery', 'elementor-frontend' ), '1.0.0', true );
		wp_register_style( 'slider-attorneys-style', plugins_url( '/assets/css/slider-attorneys.css', dirname( __FILE__ ) ) );
	}

	/**
	 * Get scripts for the widget.
	 *
	 * @return array JS handles
	 */
	public function get_script_depends() {
		return array( 'slider-attorneys-script' );
	}

	/**
	 * Get styles for the widget.
	 *
	 * @return array CSS Handles.
	 */
	public function get_style_depends() {
		return array( 'slider-attorneys-style' );

	}

	/**
	 * Get widget name.
	 *
	 * Retrieve attorneys slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'slider_attorneys';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve attorneys slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Attorneys Slider', 'lawclerk' );
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
		return 'eicon-slider-album';
	}

		/**
		 * Get widget categories.
		 *
		 * Retrieve the list of categories the attorneys slider widget belongs to.
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
		 * Retrieve the list of keywords the attorneys slider widget belongs to.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return array Widget keywords.
		 */
	public function get_keywords() {
		return array( 'slider', 'lawclerk', 'attorney', 'attorneys' );
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

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'attorney_name',
			array(
				'label'       => esc_html__( 'Name', 'lawclerk' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Name', 'lawclerk' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'attorney_location',
			array(
				'label'       => esc_html__( 'Location', 'lawclerk' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Location', 'lawclerk' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'attorney_description',
			array(
				'label'       => esc_html__( 'Description', 'lawclerk' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'rows'        => 4,
				'placeholder' => esc_html__( 'Description', 'lawclerk' ),
				'show_label'  => false,
			)
		);

		$repeater->add_control(
			'attorney_image',
			array(
				'label'   => esc_html__( 'Image', 'plugin-name' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'attorneys',
			array(
				'label'       => esc_html__( 'Attorneys', 'lawclerk' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ attorney_name }}}',
			)
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
		?>

		<div class="swiper attorneys">
			<div class="swiper-wrapper attorneys__wrapper">

				<?php foreach ( $settings['attorneys'] as $index => $attorney ) : ?>
				
					<?php
					$name        = $attorney['attorney_name'];
					$image       = $attorney['attorney_image'];
					$location    = $attorney['attorney_location'];
					$description = $attorney['attorney_description'];
					?>

					<div class="swiper-slide attorneys__slide">
						<div class="attorneys__container">
							<div class="attorneys__col attorneys__col--1">
								<?php echo wp_get_attachment_image( $image['id'], 'thumbnail' ); ?>
							</div>
							<div class="attorneys__col attorneys__col--2">
								<h3 class="attorneys__name"><?php echo esc_html( $name ); ?></h3>
								<p class="attorneys__location"><?php echo esc_html( $location ); ?></p>
								<p class="attorneys__desc"><?php echo esc_html( $description ); ?></p>
							</div>
						</div>
				</div>

				<?php endforeach; ?>

			</div>
			<div class="attorneys__button attorneys__button--prev"></div>
			<div class="attorneys__button attorneys__button--next"></div>
		</div>
		

		<?php
	}
}
