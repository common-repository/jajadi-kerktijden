<?php

function jajadi_kerktijden_load_textdomain() {
	load_plugin_textdomain( 'jajadi-kerktijden', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

//Check Plugin DB version - start
global $jajadi_kerktijden_db_version;
$jajadi_kerktijden_db_version = '1.0';

function jajadi_kerktijden_install() {
	global $wpdb;
	global $jajadi_kerktijden_db_version;

	$table_name = $wpdb->prefix . 'jajadi_kerktijden';

	$installed_ver = get_option( 'jajadi_kerktijden_db_version' );

	if( $installed_ver != $jajadi_kerktijden_db_version ) {

		$sql = "CREATE TABLE $table_name (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				gatheringDatetime datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				preacher tinytext,
				gatheringType tinytext,
				UNIQUE KEY id (id));
		";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		update_option( 'jajadi_kerktijden_db_version', $jajadi_kerktijden_db_version );

	}
}


function jajadi_kerktijden_update_db_check() {
	global $jajadi_kerktijden_db_version;
	if ( get_site_option( 'jajadi_kerktijden_db_version' ) != $jajadi_kerktijden_db_version) {
		jajadi_kerktijden_install();
	}
}
//Check Plugin DB version - End

//Import gathering data CRON - Start
function jajadi_kerktijden_activation() {
    if (! wp_next_scheduled ( 'jajadi_kerktijden_daily_event' )) {
	wp_schedule_event(time(), 'daily', 'jajadi_kerktijden_daily_event');
    }
}


function jajadi_kerktijden_daily_update_gathering_table() {
	//Get WordPress Table prefix
	$jajadikerktijdenInsertdatabaseJob = $GLOBALS['wpdb']->prefix . 'jajadi_kerktijden';
	//Get KerkId from datase
	$jajadikerktijdenid = get_option( 'jajadikerktijdenkerkid' );
	
	//Delete current data from database before update
	$GLOBALS['wpdb']->query( "DELETE FROM $jajadikerktijdenInsertdatabaseJob WHERE `gatheringDatetime` >= DATE(NOW())" );

	if ($jajadikerktijdenid != NULL || $jajadikerktijdenid != '' ){
		// Update gatherings table from XML
		libxml_use_internal_errors(true);

		
		$xml = simplexml_load_file("https://www.kerktijden.nl/data/kerktijden/gemeente/".$jajadikerktijdenid."/");


		if ($xml === false) {
			//echo "Failed loading XML: ";
			foreach(libxml_get_errors() as $error) {
				//echo "<br>", $error->message;
				
				// create error handling....(todo)
			}
		} else {
			foreach ($xml->children() as $children) {
				foreach ($children->item as $items) {
					$dienstdatumNl	= $items->title;
					$NlDate = array('zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag', 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');
					$EnDate   = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
					$dienstdatumEn  = str_replace($NlDate, $EnDate, $dienstdatumNl);
					$dienstenarr = explode("\n", $items->description);
					foreach($dienstenarr as $dienst){
						$dienstarr = explode(" - ", $dienst);
						$diensttijd			= substr($dienstarr[0], 0, 5);
						$dienstvoorganger	= substr($dienstarr[0], 6);
						$dienstdesc			= $dienstarr[1];
						$dienstdesc			= str_replace("Reguliere dienst", "", $dienstdesc);
						$date = DateTime::createFromFormat('l j m Y H:i', $dienstdatumEn . ' ' . $diensttijd );
						$date2 = $date->Format("Y-m-d H:i:s");
						//insert into database
						$GLOBALS['wpdb']->insert( $jajadikerktijdenInsertdatabaseJob, array('gatheringDatetime' => $date2, 'preacher' => $dienstvoorganger, 'gatheringType' => $dienstdesc ));
					}
				}
			}
		}
			
	}


	
}
//Import gathering data CRON - End


/********************************************************************************************************/
/*	returns the content of $GLOBALS['post']																*/
/*	Function updated by henrivanwerkhoven [https://wordpress.org/support/profile/henrivanwerkhoven]		*/
/********************************************************************************************************/
function jajadi_kerktijden_shortcode($atts){
	
	//Get WordPress Table prefix
	$jajadikerktijdenInsertdatabaseJob = $GLOBALS['wpdb']->prefix . 'jajadi_kerktijden';
	
	//default attributes
	 $atts = shortcode_atts( array(
		 'limit' => NULL, /* number of items to show, NULL to show all */
		 'header' => FALSE, /* set to TRUE to display in table header */
		 'url' => NULL, /* url to page containing all gatherings, NULL to omit url */
		 'url_name' => __('more gatherings', 'jajadi-kerktijden') /* name for urlto page containing all gatherings */
	 ), $atts);

	 $return = '';
	 $jajadikerktijdentableheader = '';
	 if($atts['header'] == true){ $jajadikerktijdentableheader = '<tr><th>' . __('Date', 'jajadi-kerktijden') . '</th><th>' . __('Preacher', 'jajadi-kerktijden') . '</th><th>' . __('Type', 'jajadi-kerktijden') . '</th></tr>'; }
	 if(!is_null($atts['limit'])){
			$jajadi_kerktijden_limit_results = $GLOBALS['wpdb']->get_results( $GLOBALS['wpdb']->prepare( "SELECT *
			FROM $jajadikerktijdenInsertdatabaseJob
			WHERE `gatheringDatetime` >= DATE(NOW())
			ORDER BY `gatheringDatetime`
			LIMIT 0 , %d", $atts['limit']));
			

		$return .= '<table>
		'.$jajadikerktijdentableheader;

			foreach ( $jajadi_kerktijden_limit_results as $jajadi_kerktijden_limit_result ) 
			{
				$return .= '<tr><td>' . Date( get_option('date_format') . ' ' . get_option('time_format') . ' \u\u\r', strtotime($jajadi_kerktijden_limit_result->gatheringDatetime)) . '</td><td>' . $jajadi_kerktijden_limit_result->preacher . '</td><td>' . $jajadi_kerktijden_limit_result->gatheringType . '</td></tr>';

			}
		 $return .= '</table>';
		if(!is_null($atts['url'])){
			$return .= '<a href="' . htmlspecialchars($atts['url']) . '" style="float:right;">' . htmlspecialchars($atts['url_name']) . '</a>';
		}
	 }
	 else{
			$jajadi_kerktijden_limit_results = $GLOBALS['wpdb']->get_results( "SELECT *
			FROM $jajadikerktijdenInsertdatabaseJob
			WHERE `gatheringDatetime` >= DATE(NOW())
			ORDER BY `gatheringDatetime`");
			

		$return .= '<table>'.$jajadikerktijdentableheader;

			foreach ( $jajadi_kerktijden_limit_results as $jajadi_kerktijden_limit_result ) 
			{
				$return .= '<tr><td>' . Date( get_option('date_format') . ' ' . get_option('time_format') . ' \u\u\r', strtotime($jajadi_kerktijden_limit_result->gatheringDatetime)) . '</td><td>' . $jajadi_kerktijden_limit_result->preacher . '</td><td>' . $jajadi_kerktijden_limit_result->gatheringType . '</td></tr>';
			}
		 $return .= '</table>';
		if(!is_null($atts['url'])){
			$return .= '<a href="' . htmlspecialchars($atts['url']) . '" style="float:right;">' . htmlspecialchars($atts['url_name']) . '</a>';
		}
	 }
	$return	.= '<br /><small>' . __('Source:', 'jajadi-kerktijden') . ' <a href="http://www.kerktijden.nl/gem/' . get_option( 'jajadikerktijdenkerkid' ) . '">kerktijden.nl</a></small></div>';
	
	return $return;
}
add_shortcode('kerktijden', 'jajadi_kerktijden_shortcode');

/************************************************************************************************/
/*	Add settings link on plugin page															*/
/************************************************************************************************/
function jajadi_kerktijden_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=jajadi-kerktijden/jajadi-kerktijden-settings.php">' . __('Settings', 'jajadi-kerktijden') . '</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}

/************************************************************************************************/
/*	Add Helptext															*/
/************************************************************************************************/
function jajadi_kerktijden_add_help_text( $contextual_help, $screen_id, $screen ) { 
	if ( 'settings_page_jajadi-kerktijden/jajadi-kerktijden-settings' == $screen->id ) {
		$contextual_help =
			'<p><strong>' . __('How to use this plugin', 'jajadi-kerktijden') . '</strong></p>' .
			'<ol type="1">' .
			'<li>' . sprintf(__('Go to %1$s and search your church.', 'jajadi-kerktijden'), '<a href="http://www.kerktijden.nl/">kerktijden.nl</a>') . '</li>' .
			'<li>' . __('Look in the URL and search for the id.', 'jajadi-kerktijden') . 
				'<ul>' .
				'<li>' . sprintf(__('<i>%1$s the id is %2$s</i>', 'jajadi-kerktijden'), 'http://www.kerktijden.nl/gem/1/name_of_the_church', '1') . '</li>' .
				'<li>' . sprintf(__('<i>%1$s the id is %2$s</i>', 'jajadi-kerktijden'), 'http://www.kerktijden.nl/gem/345/name_of_the_church', '345') . '</li>' .
				'</ul>' . 
			'</li>' .
			'<li>' . __('Insert the id below and hit save.', 'jajadi-kerktijden') . '</li>' .
			'<li>' . sprintf(__('Create a page or post and paste the following shortcode: %1$s', 'jajadi-kerktijden'), '[kerktijden]') . '</li>' .
			'</ol>';
	}
	return $contextual_help;
}



?>