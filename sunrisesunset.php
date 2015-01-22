<?php
/*
 * Plugin Name:       Sunrise/Sunset
 * Plugin URI:        http://www.github.com/bengreeley/sunrisesunset
 * Description:       A WordPress plugin to display sunrise and sunset times for a given latitude and longitude.
 * Version:           0.5
 * Author:            Ben Greeley
 * Author URI:        http://www.bengreeley.com
 */
 
 /*  
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Activation code for plugin to create necessary fields, etc.
function activate_sunrisesunset() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/class-sunrisesunset-activator.php';
	SunriseSunset_Activator::activate();
}

register_activation_hook( __FILE__, 'activate_sunrisesunset' );

// The code that runs during plugin deactivation.
function deactivate_sunrisesunset() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/class-sunrisesunset-deactivator.php';
	SunriseSunset_Deactivator::deactivate('sunrisesunset');
}

register_deactivation_hook( __FILE__, 'deactivate_sunrisesunset' );

require plugin_dir_path( __FILE__) . 'inc/class-sunrisesunset.php';

new SunriseSunset();