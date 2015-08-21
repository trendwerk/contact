<?php 
/**
 * Plugin Name: Contact
 * Description: Contact settings. Comes with widgets.
 *
 * Plugin URI: https://github.com/trendwerk/contact
 * 
 * Author: Trendwerk
 * Author URI: https://github.com/trendwerk
 * 
 * Version: 1.0.1
 */

include_once( 'assets/inc/class-tp-contact.php' );
include_once( 'assets/inc/class-tp-social.php' );

class TP_Contact_Information {

	function __construct() {
		add_action( 'plugins_loaded', array( $this, 'localization' ) );

		add_action( 'admin_init', array( $this, 'add_settings' ) );
		add_action( 'admin_menu', array( $this, 'add_menu' ), 1);

		add_filter( 'option_page_capability_tp-information', array( $this, 'get_capability' ) );
	}

	/**
	 * Load localization
	 */
	function localization() {
		load_muplugin_textdomain( 'contact', dirname( plugin_basename( __FILE__ ) ) . '/assets/lang/' );
	}
	
	/**
	 * Add settings fields through the Settings API
	 */
	function add_settings() {
		/**
		 * General
		 */
		add_settings_section( 'tp-general', __( 'General settings', 'contact' ), '', 'tp-information' );
		
		add_settings_field( 'tp-sitename', __( 'Sitename', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-general', array(
			'label_for' => 'tp-sitename', 
			'class' => 'regular-text', 
			'option_key' => 'blogname',
		) );
		register_setting( 'tp-information', 'tp-sitename', array( $this, 'save_site_name' ) );
		
		add_settings_field( 'tp-description', __( 'Description', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-general', array(
			'label_for' => 'tp-description',
			'class' => 'regular-text',
			'option_key' => 'blogdescription',
		) );
		register_setting( 'tp-information', 'tp-description', array( $this, 'save_site_description' ) );
		
		/**
		 * Contact
		 */
		add_settings_section( 'tp-contact', __( 'Contact', 'contact' ), '', 'tp-information' );
		
		add_settings_field( 'tp-company-name', __('Company name','contact'), array( $this, 'show_text_field' ), 'tp-information', 'tp-contact', array(
			'label_for' => 'tp-company-name',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-company-name' );
		
		add_settings_field( 'tp-address', __( 'Address', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-contact', array(
			'label_for' => 'tp-address',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-address' );
		
		add_settings_field( 'tp-postal-code', __( 'Postal code' , 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-contact', array(
			'label_for' => 'tp-postal-code',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-postal-code' );
		
		add_settings_field( 'tp-city', __( 'City', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-contact', array(
			'label_for' => 'tp-city',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-city' );
		
		add_settings_field( 'tp-country', __( 'Country', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-contact', array(
			'label_for' => 'tp-country',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-country' );
		
		add_settings_field( 'tp-email', __( 'E-mail', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-contact', array(
			'label_for' => 'tp-email',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-email' );
		
		add_settings_field( 'tp-telephone', __( 'Telephone', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-contact', array(
			'label_for' => 'tp-telephone',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-telephone' );
		
		add_settings_field( 'tp-fax', __( 'Fax', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-contact', array(
			'label_for' => 'tp-fax',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-fax' );
		
		/**
		 * Registration numbers & financial
		 */
		add_settings_section( 'tp-registration', __( 'Registration numbers & financial', 'contact' ), '', 'tp-information' );
		
		add_settings_field( 'tp-cc', __( 'CC No.', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-registration', array(
			'label_for' => 'tp-cc',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-cc' );
		
		add_settings_field( 'tp-vat', __( 'VAT No.', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-registration', array(
			'label_for' => 'tp-vat',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-vat' );
		
		add_settings_field( 'tp-bank', __( 'Bank name', 'contact'), array( $this, 'show_text_field' ), 'tp-information', 'tp-registration', array(
			'label_for' => 'tp-bank',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-bank' );
		
		add_settings_field( 'tp-bank-no', __( 'Bank No.', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-registration', array(
			'label_for' => 'tp-bank-no',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-bank-no' );
		
		/**
		 * Social media links
		 */
		add_settings_section( 'tp-social', __( 'Social media links', 'contact' ), '', 'tp-information' );
		
		add_settings_field( 'tp-twitter', __( 'Twitter URL', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-social', array(
			'label_for' => 'tp-twitter',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-twitter' );
		
		add_settings_field( 'tp-facebook', __( 'Facebook URL', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-social', array(
			'label_for' => 'tp-facebook',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-facebook' );
		
		add_settings_field( 'tp-linkedin', __( 'LinkedIn URL', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-social', array(
			'label_for' => 'tp-linkedin',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-linkedin');
		
		add_settings_field( 'tp-googleplus', __( 'Google Plus URL', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-social', array(
			'label_for' => 'tp-googleplus',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-googleplus' );
		
		add_settings_field( 'tp-youtube', __( 'YouTube URL', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-social', array(
			'label_for' => 'tp-youtube',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-youtube' );
		
		add_settings_field( 'tp-newsletter', __( 'Newsletter / mailto link', 'contact' ), array( $this, 'show_text_field' ), 'tp-information', 'tp-social', array(
			'label_for' => 'tp-newsletter',
			'class' => 'regular-text',
		) );
		register_setting( 'tp-information', 'tp-newsletter' );
		
		add_settings_field( 'tp-rss', '', array( $this, 'show_checkbox' ), 'tp-information', 'tp-social', array(
			'label' => __( 'Show RSS feed in the social media widget', 'contact' ),
			'option_key' => 'tp-rss',
		) );
		register_setting( 'tp-information', 'tp-rss' );
	}
	
	/**
	 * Show a text field
	 *
	 * @param array $args Some additional arguments
	 */
	function show_text_field( $args ) {
		$args['option_key'] = isset( $args['option_key'] ) ? $args['option_key'] : $args['label_for'];
		?>
		<input id="<?php echo $args['label_for']; ?>" name="<?php echo $args['label_for']; ?>" value="<?php echo get_option( $args['option_key'] ); ?>" class="<?php echo $args['class']; ?>" type="text" />
		<?php
	}
	
	/**
	 * Show a checkbox
	 *
	 * @param array $args Some additional arguments
	 */
	function show_checkbox( $args ) {
		?>
		<label>
			<input name="<?php echo $args['option_key']; ?>" value="true" class="<?php echo $args['class']; ?>" type="checkbox" <?php checked( get_option( $args['option_key'] ), 'true' ); ?> />
			<?php echo $args['label']; ?>
		</label>
		<?php
	}
	
	/**
	 * Exception: Save the site name
	 */
	function save_site_name( $value ) {
		update_option( 'blogname', $value );
		return $value;
	}
	
	/**
	 * Exception: Save the site description
	 */
	function save_site_description( $value ) {
		update_option( 'blogdescription', $value );
		return $value;
	}
	
	/**
	 * Add contact information page to menu
	 */
	function add_menu() {
		add_options_page( __( 'Contact information', 'contact' ), __( 'Contact information', 'contact' ), $this->get_capability(), 'tp-information', array( $this, 'display' ) );
	}
	
	/**
	 * Display admin page
	 */
	function display() {
		?>
		<div class="wrap">

			<div class="icon32" id="icon-themes"><br></div>

			<h2><?php _e( 'Contact information', 'contact' ); ?></h2>
			
			<form action="options.php" method="post">
				<?php 
					settings_fields( 'tp-information' );
					do_settings_sections( 'tp-information' );
					submit_button(); 
				?>
			</form>

		</div>
		<?php
	}

	/**
	 * Get capability
	 */
	function get_capability() {
		return 'publish_pages';
	}

} new TP_Contact_Information;
