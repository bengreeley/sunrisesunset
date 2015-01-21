<?php

// Functions/hooks for plugin deactivation process for cleaning up of any settings.
class SunriseSunset_Deactivator {

	public static function deactivate($pluginname) {

		if( is_multisite() ) {
			delete_site_transient( $pluginname );	
		}
		else {
			delete_transient( $pluginname );	
		}
		
	}
}