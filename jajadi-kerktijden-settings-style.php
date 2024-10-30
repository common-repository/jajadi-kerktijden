<?php
echo '<h3>' . __('Styling gatherings', 'jajadi-kerktijden') . '</h3>';
?>
			<table class="form-table">
				<tr valign="top">
				<th scope="row"><?php echo __('Default text color', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdendefaulttext" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdendefaulttext' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('Default background color', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdendefaulbackground" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdendefaulbackground' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('Cancelled gatherings', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdencancelledregular" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdencancelledregular' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('Cancelled gatheringtypes', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdencancelledtype" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdencancelledtype' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('gathering type', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdengatheringtype" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdengatheringtype' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('gathering type regular', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdengatheringtyperegular" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdengatheringtyperegular' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('Link', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdenlink" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdenlink' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('Link hover', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdenlinkhover" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdenlinkhover' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('Date', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdendate" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdendate' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('Location', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdenlocation" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdenlocation' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('Location deviating', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdenlocationdeviating" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdenlocationdeviating' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('Past', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdenpasttext" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdenpasttext', '#a4a4a4' ); ?>" /></td>
				</tr>
				<tr valign="top">
				<th scope="row"><?php echo __('Past day text', 'jajadi-kerktijden'); ?>: </th>
				<td><input type="text" name="jajadikerktijdenpastdaytext" class="jajadi-color-field" value="<?php echo get_option( 'jajadikerktijdenpastdaytext', '#7a7a7a' ); ?>" /></td>
				</tr>
			</table>
			<input type="hidden" name="jajadikerktijdenkerkid" value="<?php echo get_option( 'jajadikerktijdenkerkid' ); ?>" />
