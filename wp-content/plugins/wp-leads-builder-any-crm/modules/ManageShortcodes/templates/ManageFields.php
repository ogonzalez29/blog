<?php

/*********************************************************************************
 * WP Leads Builder For CRM is a tool to capture leads from WordPress to CRM.
 * plugin developed by Smackcoder. Copyright (C) 2016 Smackcoders.
 *
 * WP Leads Builder For CRM is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License version 3
 * as published by the Free Software Foundation with the addition of the
 * following permission added to Section 15 as permitted in Section 7(a): FOR
 * ANY PART OF THE COVERED WORK IN WHICH THE COPYRIGHT IS OWNED BY WP Leads 
 * Builder For CRM, WP Leads Builder For CRM DISCLAIMS THE WARRANTY OF NON
 * INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * WP Leads Builder For CRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public
 * License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program; if not, see http://www.gnu.org/licenses or write
 * to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA 02110-1301 USA.
 *
 * You can contact Smackcoders at email address info@smackcoders.com.
 *
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License
 * version 3, these Appropriate Legal Notices must retain the display of the
 * WP Leads Builder For CRM copyright notice. If the display of the logo is
 * not reasonably feasible for technical reasons, the Appropriate Legal
 * Notices must display the words
 * "Copyright Smackcoders. 2016. All rights reserved".
 ********************************************************************************/

function formFields( $options, $onAction, $editShortCodes , $formtype = "post" )
{
	$siteurl= site_url();
	$module =$module_options ='Leads';
	$content1='';
	if($editShortCodes=='')
		$editShortCodes = 'no';
	$imagepath= WP_CONST_ULTIMATE_CRM_CPT_DIR . 'images/';
	$config_leads_fields = get_option($options);
	$content='
	<input type="hidden" name="field-form-hidden" value="field-form" />
	<div>';
	$i = 0;
	if(!isset($config_leads_fields['fields'][0]))
	{
		$content.='<p style="text-align:center;font-size:20px;color:red;">Crm fields are not yet synchronised</p>';
	}
	else
	{
		$iscontent = true;
		$content.='<table style="background-color: #F1F1F1; border: 1px solid #dddddd;width:85%;margin-bottom:26px;margin-top:5px"><tr class="smack_highlight smack_alt" style="border-bottom: 1px solid #dddddd;"><th class="smack-field-td-middleit" style="width: 40px;" align="left"><input type="checkbox" name="selectall" id="selectall" onclick="selectAll'."('field-form','".$module."')".';"/></th><th style="width: 100px;" align="left"><h5>Field Name</h5></th><th class="smack-field-td-middleit" style="width: 100px;" align="left"><h5>Show Field</h5></th><th class="smack-field-td-middleit" style="width: 150px;" align="left"><h5>Order</h5></th></tr>';

		for($i=0;$i<count($config_leads_fields['fields']);$i++)
		{
			if( $config_leads_fields['fields'][$i]['wp_mandatory'] == 1 )
			{
				$madantory_checked = 'checked="checked"';
			}
			else
			{
				$madantory_checked = "";
			}
			if( isset($config_leads_fields['fields'][$i]['mandatory']) && $config_leads_fields['fields'][$i]['mandatory'] == 2)
			{
				if($i % 2 == 1)
					$content1.='<tr class="smack_highlight smack_alt">';
				else
					$content1.='<tr class="smack_highlight">';

				$content1.='
				<td class="smack-field-td-middleit"><input type="checkbox" name="select'.$i.'" id="select'.$i.'" disabled=disabled checked=checked ></td>
				<td>'.$config_leads_fields['fields'][$i]['label'].' *</td>
				<td class="smack-field-td-middleit">';
				{
					$content1.='<a name="publish'.$i.'" id="publish'.$i.'" onclick="'."alert('This field is mandotory, cannot hide')".'">
					<img src="' . esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR) . 'images/tick_strict.png"/>
					</a>';
				}
				$content1.='</td>
				<td class="smack-field-td-middleit">';
				$content1.= "<input class='position-text-box' type='textbox' name='position{$i}' value='".($i+1)."' >";
				$content1.='</td></tr>';
			}
			else
			{
				if($i % 2 == 1)
					$content1.='<tr class="smack_highlight smack_alt">';
				else
					$content1.='<tr class="smack_highlight">';

				$content1.='<td class="smack-field-td-middleit">';
				$content1.= '<input type="checkbox" name="select'.$i.'" id="select'.$i.'">';
				$content1.='</td>
				<td>'.$config_leads_fields['fields'][$i]['label'].'</td>
				<td class="smack-field-td-middleit">';
				if($config_leads_fields['fields'][$i]['publish'] == 1){
					$content1.='<a name="publish'.$i.'" id="publish'.$i.'" >
					<img src="' . esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR) . 'images/tick.png"/>
					</a>';
				}
				else{
					$content1.='<a name="publish'.$i.'" id="publish'.$i.'" >
					<img src="' . esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR) . 'images/publish_x.png"/>
					</a>';
				}
				$content1.='</td>
				<td class="smack-field-td-middleit">';
				$content1.= "<input class='position-text-box' type='textbox' name='position{$i}' value='".($i+1)."' >";
				$content1.='</td></tr>';
			}
		}
	}
	$content1.="<input type='hidden' name='no_of_rows' id='no_of_rows' value={$i} />";
	$content.=$content1;
	$content.= '</table>
	</div>
	';
	return array( 'iscontent' => $iscontent , 'data' => $content);
}
$formtypes = array('post' => "Post" , 'widget' => "Widget" );
?>
<?php
global $IncludedPlugins;
$crmtype = $IncludedPlugins[$skinnyData['activatedplugin']];
?>
<span id='inneroptions' style='position:relative;left:5px;margin-left:10px;'>
<?php
$nonce = $_REQUEST['__wpnonce'];
if( !wp_verify_nonce( $nonce , 'lead_nonce' )  )
{
die('You are not allowed to do this operation');
}
echo "CRM Type: $crmtype";
echo str_repeat('&nbsp;', 8);
echo "Module Type: Leads";
?>
<br><br>
<h3 style="margin-left:0px; ">
	[<?php  echo $skinnyData['activatedplugin']; ?>-web-form type='<?php echo $skinnyData['formtype'];?>']
	<input style="float:right;" type="button" class="button-secondary submit-add-to-menu" name="sync_crm_fields" value="Fetch CRM Fields" onclick=" syncCrmFields('<?php echo esc_js($skinnyData['siteurl']) ;?>','<?php echo esc_js($skinnyData['module']) ;?>','<?php echo esc_js($skinnyData['options']) ;?>', '<?php echo esc_js($skinnyData['onAction']) ;?>');"/>
</h3>
</span>
<span  style="padding:10px;  color:#FFFFFF; background-color: #37707D; text-align:center; float:right; font-weight:bold; cursor:pointer; margin-top:-11px; position:relative; overflow:hidden;"  id ="showmore">Form Options <i class="dashicons dashicons-arrow-down"></i></span>
<span  style="padding:10px; color:#FFFFFF; background-color: #37707D; text-align:center; float:right; font-weight:bold; cursor:pointer;  margin-top: 233px; margin-right:0px; position:relative; overflow:hidden;"  id ="showless">Form Options <i class="dashicons dashicons-arrow-up"></i></span>

<?php
	$Helper_obj = new WPCapture_includes_helper;
	$save_form_nonce_key = $Helper_obj->leads_create_nonce_key();
	$const_plug_url = WP_CONST_ULTIMATE_CRM_CPT_PLUG_URL;
	$save_form_options = add_query_arg( array( '__module' => 'ManageShortcodes' , '__action' => 'ManageFields' , 'module' => 'Leads' , 'EditShortCode' => 'yes' , 'formtype' => $skinnyData['formtype'], 'step' => 'formOptions' , '__wpnonce' => $save_form_nonce_key ),$const_plug_url );
?>
<form id="formOptions" name = "formOptions" action="<?php echo esc_url($save_form_options) ;?> " method="post">
	<input type="hidden" id="nonce_form" value="<?php echo $save_form_nonce_key;  ?>">
	<div class="wp-common-crm-content" style="background-color: white;">
		<div class="content" style="padding: 20px 0px; color:#004D40 !important; font-size:13px !important; font-weight: bold !important; position:relative;margin-top:-10px; ">
			<table style="width: 45%;">
				<tr>
					<?php
					$config_fields = get_option($skinnyData['option']);
					$content = "";
					$content.= "<td style='position:relative;'>Form Type ". str_repeat('&nbsp' , 51).": </td> <td><span> {$formtypes[$skinnyData['formtype']]} </span>";
					$content.= "<input type='hidden' name='formtype' value='{$skinnyData['formtype']}'>";
					$content.= "</td>";
					echo $content;
					?>
				</tr>
				<tr><td><br></td></tr>
				<tr>
					<td>
						<label style="position:relative";>Error Message On Form Submission <?php echo str_repeat('&nbsp' , 7)?>: </label>
					</td>
					<td>
						<input type="text" name="errormessage" placeholder = "Submission Failed" value="<?php if(isset($config_fields['errormessage'])) echo sanitize_text_field($config_fields['errormessage']); ?>" />
					</td>
					<td style = "width=18px;">
						<a class="tooltip"  href="#">
							<img src="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR); ?>images/help.png">
							<span class="tooltipPostStatus">
							<img src="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR); ?>images/callout.gif" class="callout">
							Form submission failure message display text.
							<img style="margin-top: 6px;float:right;" src="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR); ?>images/help.png">
						</span> </a>
					</td>
				</tr>
				<tr> <td> <br></td></tr>
				<tr>
					<td style="position:relative;">
						<label >Success Message On Form Submission <?php echo str_repeat('&nbsp' , 2)?>: </label>
					</td>
					<td>
						<input type="text" name="successmessage" placeholder = "Thankyou For Submitting" value="<?php if(isset($config_fields['successmessage'])) echo sanitize_text_field($config_fields['successmessage']); ?>" />
					<td>
					<td style = "width=18px;">
						<a class="tooltip" href="#">
							<img src="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR); ?>images/help.png">
                        <span class="tooltipPostStatus">
                        <img src="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR); ?>images/callout.gif" class="callout">
                        Form submission success message display text.
                        <img style="margin-top: 6px;float:right;" src="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR); ?>images/help.png">
                        </span> </a>
					</td>
	
				</tr>
			
				<tr><td><br></td></tr>
				<tr>
					<td style="position:relative;">
						<label>Enable URL Redirection <?php echo str_repeat( '&nbsp' , 28 ) ; ?>: </label>
					</td>
					<td>
						<input type="checkbox" id ="enableurlredirection" name="enableurlredirection" class="cmn-toggle cmn-toggle-yes-no" value="on" <?php if(isset($config_fields['enableurlredirection']) == 'on'){ echo "checked=checked"; } ?> />
						<label for="enableurlredirection" id="innertext" data-on="Yes" data-off="No"></label>
					</td>
				</tr>	
				<tr>
			
				<td style="position:relative;"> <label>URL Redirection Id <?php echo str_repeat( '&nbsp' , 36) ; ?>: </label> </td>	
				<td>
						<input id="redirecturl" type="text" name="redirecturl" placeholder = "1" value="<?php if(isset($config_fields['redirecturl']) && intval($config_fields['redirecturl'])) { echo $config_fields['redirecturl'];} ?>" />
					<td>
					<td style = "width=18px;">
						<a class="tooltip" href="#">
							<img src="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR); ?>images/help.png">
                        <span class="tooltipPostStatus">
                        <img src="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR); ?>images/callout.gif" class="callout"> Redirect Page or Post Id.
                        <img style="margin-top: 6px;float:right;" src="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR); ?>images/help.png">
                        </span> </a>

					</td>

				</tr>
				
			<tr>
			<td></td><td></td>				
			<input type="submit" value="Apply Form Options" class="button-primary" style="float:right;">
			</tr>
			</table>

		</div>
	</div>
</form>
<?php
	$save_field_setting = $Helper_obj->leads_create_nonce_key();
	$save_field_config = add_query_arg( array( '__module' => 'ManageShortcodes' , '__action' => 'ManageFields' , 'module' => 'Leads' , 'EditShortCode' => 'yes' , 'formtype' => $skinnyData['formtype'], 'step' => 'formFieldsConfiguration' , '__wpnonce' => $save_field_setting ),$const_plug_url );
?>
<form id="field-form" name = "fieldform" action="<?php echo esc_url($save_field_config); ?>" method="post">
	<input type='hidden' name='formtype' value='<?php echo sanitize_text_field($skinnyData['formtype']); ?>'>

	<br>
	<div class="wp-common-crm-content">
		<h4 id="formtext" style=" margin:0px; padding: 10px 0px; "> Field Settings :</h4>
		<div class="action-buttons" style="<?php if($skinnyData['onAction'] == 'onCreate') echo 'width:720px;'; else echo 'width:650px;' ?> padding-bottom: 20px; padding-top: 20px;">
			<img src="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR); ?>images/loading-indicator.gif" id="loading-image" style="display: none; position:relative; left:500px;padding-top: 5px; padding-left: 15px;">
		</div>
		<div class="wp-common-crm-content1">
			<select id="bulk-action-selector-top" name="bulkaction" style="margin: 0px 0px 2px;">
				<option selected="selected" value="-1">Bulk Actions</option>
				<option value="enable_field">Enable Field</option>
				<option value="disable_field">Disable Field</option>
				<option value="update_order">Update Order</option>
			</select>
			<?php
			$content = "";
			$content.= '<input class="button-primary" type="submit" value="Save Field Settings"/>';
			echo $content;
			?>
		</div>
		<div id="fieldtable">
			<?php
			if(isset($skinnyData['REQUEST']['EditShortCode']))
			{
				$return_data = formFields( $skinnyData['option'] , $skinnyData['onAction'] , $skinnyData['REQUEST']['EditShortCode'] , $skinnyData['formtype'] );
				echo $return_data['data'];
			}
			else
			{
				$return_data = formFields( $skinnyData['option'] , $skinnyData['onAction'] , '' , $skinnyData['formtype'] );
				echo $return_data['data'];
			}
			?>
		</div>
	</div>
	<br>
	<div id="crmfield" <?php if(!$return_data['iscontent']) { echo "style='display:none'"; } ?> >
		<script>
			function showAccordion( id )
			{
				if(jQuery("#advance_option_display").val() == 0 )
				{
					jQuery("#advance_option").css("display", "block");
					jQuery("#advance_option_display").val(1);
					jQuery("#accordion_arrow").removeClass( "fa-chevron-right" );
					jQuery("#accordion_arrow").addClass( "fa-chevron-down" );
				}
				else
				{
					jQuery("#advance_option").css("display", "none");
					jQuery("#advance_option_display").val(0);
					jQuery("#accordion_arrow").removeClass( "fa-chevron-down" );
					jQuery("#accordion_arrow").addClass( "fa-chevron-right" );
				}
			}
		</script>
		<script>
			$(document).ready(function() {
				$( ".content" ).hide();
				$( "#showless" ).hide();
				$( "#showmore" ).click(function() {
					$( ".content" ).show( 500 );
					$( "#showless" ).show();
					$( "#showmore" ).hide();
				});
				$( "#showless" ).click(function() {
					$( ".content" ).hide( 500 );
					$( "#showless" ).hide();
					$( "#showmore" ).show();
				});
			});
		</script>
		<h3 onclick="showAccordion('advance_option');" style=" cursor: pointer;"> Advanced Options <i id="accordion_arrow" style="float: right; color:#FFFFFF;" class="fa fa-chevron-right"></i></h3>
		<div class="wp-common-crm-content" id="advance_option" style="display:none; " >
			<input type="hidden" id="advance_option_display" name="advance_option_display"  value=0 >
			<div class="version-warning">
				<span style="font-weight:bold; color:red;">Pro Version Only</span>
				<?php
				require_once(WP_CONST_ULTIMATE_CRM_CPT_DIRECTORY."modules/ManageFields/templates/Advance_Option.php");
				?>
			</div>
		</div>
		<br>
</form>
