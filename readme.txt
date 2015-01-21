#=== Multisite Shared Menu ===
Contributors: ben.greeley
Tags: sunrise, sunset, shortcode, widget
Requires at least: 3.0.1
Tested up to: 4.1
Stable tag: .5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin to integrate with the excellent earthtools.org web services.

#== Description ==
Plugin integrates with earthtools.org web service to display sunrise/sunset information for a passed latitude/longitude (defaults to Waterville, Maine).
Server will store the information for one hour before querying the web service again.

Sun/moon graphic by RPH Studio (http://www.rphstudio.com)

# Installation
Simply copy the folder into your wp-content/plugins directory and activate for the sites you wish to use plugin on.

Once activated, use the [sunrisesunset lat="" long=""] shortcode to display sunrise/sunset data wherever you want.

If you do not wish to display the moon/sun graphic, pass the attribute 'graphical="false"' to the shortcode.

# Changelog
<h3>.5</h3>
Initial Release. Will add widget functionality in future release to tie in with existing shortcode.
