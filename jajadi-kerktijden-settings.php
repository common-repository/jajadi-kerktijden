<?php
function jajadi_kerktijden_importdata_button_action()
{
  echo '<div id="message" class="updated fade"><p>'
    .__('Data from kerktijden.nl imported', 'jajadi-kerktijden') . '</p></div>';
	
	jajadi_kerktijden_daily_update_gathering_table();
}  

// create custom plugin settings menu
add_action('admin_menu', 'jajadi_kerktijden_settings_menu');

function jajadi_kerktijden_settings_menu() {

	//create new top-level menu
	add_options_page('Kerktijden', 'Kerktijden', 'manage_options', __FILE__, 'jajadi_kerktijden_settings_page');

	//call register settings function
	add_action( 'admin_init', 'jajadi_register_kerktijden_settings' );
}

function jajadi_register_kerktijden_settings() {
	//register our settings
	register_setting( 'jajadi-kerktijden-settings', 'jajadikerktijdenkerkid' );
			 
}


function jajadi_kerktijden_admin_tabs( $current = 'homepage' ) {
    $tabs = array( 'general' => __('General Settings', 'jajadi-kerktijden'));
	//$tabs['style'] = __('Styling', 'jajadi-kerktijden');
	$tabs['about'] = __('About', 'jajadi-kerktijden');
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=jajadi-kerktijden/jajadi-kerktijden-settings.php&tab=$tab'>$name</a>";

    }
}

function jajadi_kerktijden_settings_page() {
	?>
	<div id="icon-options-general" class="icon32"></div><h2><?php echo __('Kerktijden', 'jajadi-kerktijden'); ?></h2>
	<h2 class="nav-tab-wrapper">
	<div class="wrap">
	<?php
	if ( isset ( $_GET['tab'] ) ){
		jajadi_kerktijden_admin_tabs($_GET['tab']);
		$tab = $_GET['tab'];
	}
	else{
		jajadi_kerktijden_admin_tabs('general');
		$tab = 'general';
	}
	?>
	</h2>

	<form method="post" action="options.php">
		<?php settings_fields( 'jajadi-kerktijden-settings' ); ?>
		<?php do_settings_sections( 'jajadi-kerktijden-settings' ); ?>
		<?php
		if($tab == 'general'){
			?>
			<table class="form-table">
				<tr valign="top">
				<th scope="row"><?php echo __('Church ID', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdenkerkid" value="<?php echo get_option( 'jajadikerktijdenkerkid' ); ?>" /></td>
				</tr>
			</table><br />

		<?php
					submit_button(); 

		echo '<h3>'.__('Shortcode', 'jajadi-kerktijden').'</h3>[kerktijden]<br />';
		echo '<h3>'.__('Attributes:', 'jajadi-kerktijden').'</h3><ul>';
		echo '<li><b>limit:</b> '.__('Displays max amount of gatherings on a page. Default: All gatherings', 'jajadi-kerktijden').'</li>';
		echo '<li><b>header:</b> '.__('Displays header. Default: No header', 'jajadi-kerktijden').'</li>';
		echo '<li><b>url:</b> '.__('Creates a link you specified to a page with more gatherings. Default: No link', 'jajadi-kerktijden').'</li>';
		echo '<li><b>url_name:</b> '.__('Change the text of the more gatherings link. Default: More gaterings', 'jajadi-kerktijden').'</li>';
		echo '</ul>';

		  
		echo '<h2>' . __('Example', 'jajadi-kerktijden') . '</h2> [kerktijden limit=10 header=1 url="\link" url_name="Sample text link"]<br />';
		echo jajadi_kerktijden_shortcode( array('limit' => 10, 'header' => true, 'url' => "\link", 'url_name' => "Sample text link"));
		}
		/*elseif($tab == 'style'){
			include( plugin_dir_path( __FILE__ ) . 'jajadi-kerktijden-settings-style.php');
		}*/
		elseif($tab == 'about'){
			include( plugin_dir_path( __FILE__ ) . 'jajadi-kerktijden-about.php');
		}
		?>
		
		<?php 
		if($tab != 'about'){
			submit_button(); 
		}
			?>

	</form>
	<?php
	
			// Check whether the button has been pressed AND also check the nonce
		  if (isset($_POST['jajadi_kerktijden_importdata_button']) && check_admin_referer('jajadi_kerktijden_importdata_button_clicked')) {
			// the button has been pressed AND we've passed the security check
			jajadi_kerktijden_importdata_button_action();
		  }

		  echo '<form action="options-general.php?page=jajadi-kerktijden%2Fjajadi-kerktijden-settings.php" method="post">';

		  // this is a WordPress security feature - see: https://codex.wordpress.org/WordPress_Nonces
		  wp_nonce_field('jajadi_kerktijden_importdata_button_clicked');
		  echo '<input type="hidden" value="true" name="jajadi_kerktijden_importdata_button" />';
		  submit_button(__('Import Data from kerktijden.nl', 'jajadi-kerktijden'));
		  echo '</form>';

		  echo '</div>';
}
 
 ?>