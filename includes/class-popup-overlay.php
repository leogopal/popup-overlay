<?php
/**
 * Define the main plugin class
 *
 * @since 0.0.1
 *
 * @package Popup_Overlay
 */

// Don't allow this file to be accessed directly.
if ( ! defined( 'WPINC' ) ) {
	die();
}

/**
 * The main class.
 *
 * @since 0.1.0
 */
final class Popup_Overlay {

	/**
	 * The plugin version.
	 *
	 * @since 0.0.1
	 */
	const VERSION = '0.0.1';

	/**
	 * The plugin slug.
	 *
	 * @since 0.0.1
	 */
	const SLUG = 'popup_overlay';

	/**
	 * The only instance of this class.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected static $instance = null;

	/**
	 * Get the only instance of this class.
	 *
	 * @since 0.0.1
	 *
	 * @return object $instance The only instance of this class.
	 */
	public static function get_instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Prevent cloning of this class.
	 *
	 * @since 0.0.1
	 *
	 * @return void
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', self::SLUG ), self::VERSION );
	}

	/**
	 * Prevent unserializing of this class.
	 *
	 * @since 0.0.1
	 *
	 * @return void
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', self::SLUG ), self::VERSION );
	}

	public function __construct() {

		/**
		 * Add the necessary action hooks.
		 */
		$this->add_actions();

	}

	private function add_actions() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		// Maybe display the overlay.
		add_action( 'wp_footer', array( $this, 'popup_overlay' ) );

		// Load Scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}

	public function enqueue_styles() {
		wp_enqueue_style( 'sera-popup-styles', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/popup.css' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'sera-js-cookie', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/js.cookie.js', array(
			'jquery',
		) );
		wp_enqueue_script( 'sera-scripts', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/main.js', array(
			'jquery',
		) );
	}

	public function popup_overlay() {

		// Disable page caching by W3 Total Cache.
		define( 'DONOTCACHEPAGE', true );

		if ( what_the_os( 'android' ) || what_the_os( 'desktop' ) ) { 
			?>

        <div class="modal">
            <div class="modal-content">

                <div class="modal-top">
                    <span class="close-button">&times;</span>
                    <h1><span class="tu-red">YOU</span> ARE PAYING<br><span class="tu-red">TOO MUCH</span> FOR<br>YOUR DATA!</h1>
                </div>

                <div class="modal-body">
                    <p class="top">DOUBLE YOUR DATA FOR FREE.<br><span style="font-weight:bold;">DOWNLOAD THE APP TODAY!</span></p>
                    <a href="https://theunlimited.co.za/doubleconnect"><p class="middle"><span style="font-size: 20px;">YES! I WANT TO</span><br><span style="font-size:15px;">DOUBLE MY DATA!</span></p></a>
                    <a href="https://play.google.com/store/apps/details?id=za.co.digitlab.unlimitedconnect" class="android"><img src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>assets/images/googleplay.png" alt="Google Play Icon"></a>
                    <a href="https://theunlimited.co.za/doubleconnect" class="dclogo"><img src="<?php echo plugin_dir_url( dirname( __FILE__ ) );?>assets/images/dclogo.png" alt="Double Connect Logo" ></a>
                </div>
            </div>
        </div>

	<?php }
	}
}