<?php
/*
	Plugin Name: JaJaDi Kerktijden.nl
	Plugin URI: https://wordpress.org/plugins/jajadi-kerktijden/
	Description: Publish gatherings from kerktijden.nl
	Version: 3.6
	Author: Janjaap van Dijk
	Author URI: http://janjaapvandijk.nl
	License: GPL2
	Text Domain: jajadi-kerktijden
	Domain Path: /languages/
*/

/*	Copyright 2013  J. van Dijk 

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


/************************************************************************************************/
/*	Algemene acties																				*/
/************************************************************************************************/

// Include other files
include( plugin_dir_path( __FILE__ ) . 'jajadi-kerktijden-settings.php');
include( plugin_dir_path( __FILE__ ) . 'jajadi-kerktijden-functions.php');
// Hooks a function on to a specific action.
add_action( 'plugins_loaded', 'jajadi_kerktijden_load_textdomain');
add_action( 'plugins_loaded', 'jajadi_kerktijden_update_db_check');
add_action( 'contextual_help', 'jajadi_kerktijden_add_help_text', 10, 3 );
register_activation_hook(__FILE__, 'jajadi_kerktijden_activation');
add_action('jajadi_kerktijden_daily_event', 'jajadi_kerktijden_daily_update_gathering_table');
?>