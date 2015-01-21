<?php

class SunriseSunset {
	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct() {
		$this->plugin_name = 'sunrisesunset';
		$this->version = '.5';

		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	private function define_admin_hooks() {
		// Any admin hooks...
	}

	private function define_public_hooks() {		
		// Hook shortcodes, etc.
		add_action( 'init', array( $this, 'register_shortcodes' ) );
		add_action( 'init', array( $this, 'enqueuestyles' ));
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_version() {
		return $this->version;
	}
	
	public function register_shortcodes() {
		add_shortcode('sunrisesunset', array($this, 'run_sunrisesunset') );
	}
	
	public function enqueuestyles() {
		wp_enqueue_style( 'sunrisesunsetcss', plugins_url('../css/sunrisesunset.css',__FILE__), array(), $this->version  );
	}
	
	public function run_sunrisesunset($atts) {
		
		extract( shortcode_atts( array(
				'lat' => '44.15',		// Latitude value
				'long' => '-69.64',		// Longitude value
				'graphical' => 'true'	// Display moon information?
				
			), $atts, 'sunrisesunset' ) );
		
		$transName = $this->plugin_name;
		$cacheTime = 60;				// Refresh cache every 1 hour
		
		if(false === ($sunrisedata = get_transient($transName) ) ) {
			// Refresh the cache by grabbing the data...
		   $sunrisedata = wp_remote_get('http://www.earthtools.org/sun/' . $lat . '/'. $long .'/' . date('n', strtotime('now') ) . '/'. date('j', strtotime('now')) . '/99/0');
		   
		   if ( !is_wp_error( $sunrisedata ) ) {
		   	set_transient($transName, $sunrisedata, 60 * $cacheTime);	// Set it and forget it
		   }
		}
		
		if ( isset( $sunrisedata )) {
			$body = wp_remote_retrieve_body($sunrisedata);
			$xml = simplexml_load_string($body);
			
			$this->display_sunrisesunset( $xml->morning->sunrise, $xml->evening->sunset, $graphical == 'true' );
		}
		
		return;
	}

	/*
		Displays sunrise/sunset data:
		$sunrise - time value for sunrise (eg. 6:00)
		$sunset - time value for sunset (eg. 15:00)
		$graphical - bool true to display sun/moon with output.
	*/	
	public function display_sunrisesunset($sunrise, $sunset, $graphical = true) {

	?>
		<div class="sunrise-sunset<?php echo ( $graphical == true? ' sun-graphical':'');?>">
			<span class="time-sunrise"><strong>Sunrise</strong><?php echo date('g:i a', strtotime( date('n/j/Y', strtotime('now')) . $sunrise )); ?></span>
			<span class="time-sunset"><strong>Sunset</strong><?php echo date('g:i a', strtotime( date('n/j/Y', strtotime('now')) . $sunset )); ?></span>
		</div>
		<?php
			
		return;

	}
}