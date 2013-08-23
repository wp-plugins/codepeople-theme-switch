<?php 
/*  
Plugin Name: CodePeople Theme Switch
Plugin URI: http://wordpress.dwbooster.com/content-tools/codepeople-theme-switch
Version: 1.0.1
Author: <a href="http://www.codepeople.net">CodePeople</a>
Description: "CodePeople Theme Switch" loads the CodePeople Light theme if the website is loaded from a mobile browser. From "CodePeople Theme Switch" is possible to configure the CodePeople Light theme.
*/

require_once 'php/Mobile_Detect.php';

add_action('admin_menu', 'codepeople_theme_switch_admin');

// Initialize the admin panel 
if (!function_exists("codepeople_theme_switch_admin")) { 
	function codepeople_theme_switch_admin() { 
		if (function_exists('add_options_page')) { 
			add_options_page('Switch to CodePeople Light Theme', 'Switch to CodePeople Light Theme', 'manage_options', basename(__FILE__), 'codepeople_theme_switch_admin_page'); 
		} 
	}    
}
	
// Print and process the admin page	
if(!function_exists('codepeople_theme_switch_admin_page')){
	function codepeople_theme_switch_admin_page(){
		$image_dir = plugin_dir_url(__FILE__).'images';
		$js_dir = plugin_dir_url(__FILE__).'js';

		// Load the administration script
		wp_enqueue_script('codepeople-theme-switch-admin-script', $js_dir.'/admin.js', array('jquery'));
		wp_localize_script('codepeople-theme-switch-admin-script', 'config', array(
			'image_path'  	=> $image_dir
		));
        
        if(isset($_POST['codepeople-theme-design-submit'])){
				
			echo '<div class="updated"><p><strong>'.__("Settings Updated").'</strong></div>';
            
            $codepeople_light_options = array(
                'codepeople-light-general-theme' => $_POST['codepeople-mobile-general-theme'],
                'codepeople-light-header-theme'  => $_POST['codepeople-mobile-header-theme'],
                'codepeople-light-footer-theme'  => $_POST['codepeople-mobile-footer-theme'],
                'codepeople-light-navbar-theme'  => $_POST['codepeople-mobile-navbar-theme'],
                'codepeople-light-list-theme'    => $_POST['codepeople-mobile-list-theme']
            );
		
            update_option('codepeople-light-options', $codepeople_light_options);
			
		}
        
        $codepeople_light_options = get_option( 'codepeople-light-options' );
        
		$codepeople_mobile_script_path   = ( isset( $codepeople_light_options[ 'codepeople-light-general-theme' ] ) ) ? $codepeople_light_options[ 'codepeople-light-general-theme' ] : 'default';
		$codepeople_mobile_style_path	 = ( isset( $codepeople_light_options[ 'codepeople-light-general-theme' ] ) ) ? $codepeople_light_options[ 'codepeople-light-general-theme' ] : 'default';	
		$codepeople_mobile_general_theme = ( isset( $codepeople_light_options[ 'codepeople-light-general-theme' ] ) ) ? $codepeople_light_options[ 'codepeople-light-general-theme' ] : 'default';
		$codepeople_mobile_header_theme  = ( isset( $codepeople_light_options[ 'codepeople-light-header-theme' ] ) )  ? $codepeople_light_options[ 'codepeople-light-header-theme' ]  : 'default';
		$codepeople_mobile_footer_theme  = ( isset( $codepeople_light_options[ 'codepeople-light-footer-theme' ] ) )  ? $codepeople_light_options[ 'codepeople-light-footer-theme' ]  : 'default';
		$codepeople_mobile_navbar_theme  = ( isset( $codepeople_light_options[ 'codepeople-light-navbar-theme' ] ) )  ? $codepeople_light_options[ 'codepeople-light-navbar-theme' ]  : 'default';
		$codepeople_mobile_list_theme    = ( isset( $codepeople_light_options[ 'codepeople-light-list-theme' ] ) )    ? $codepeople_light_options[ 'codepeople-light-list-theme' ]    : 'default';
				
		echo '<div class="wrap">
				<form method="post" action="'.$_SERVER['REQUEST_URI'].'">
					<h2>CodePeople Light Theme Configuration</h2>
					<div>'.__('For more information go to the <a href="http://wordpress.dwbooster.com/themes/codepeople-light" target="_blank">CodePeople Light</a> theme page or <a href="http://wordpress.dwbooster.com/content-tools/codepeople-theme-switch" target="_blank">CodePeople Theme Switch</a> plugin page').'</div>
					<table class="form-table" style="width:auto;">
						<tbody>
							<tr valign="top">
								<th scope="row">
									'.__('General theme design', 'codepeople-theme-switch-text').'</label>
								</th>
								<td colspan="2">
									<table class="form-table">
										<tr>
											<td>
												<select name="codepeople-mobile-general-theme" onchange="changeImage(this, \'#codepeople-mobile-general-theme\')">
													'.codepeople_theme_switch_print_options($codepeople_mobile_general_theme, true).'
												</select>
											</td>
										</tr>
										<tr>		
											<td>'.codepeople_theme_switch_print_image($codepeople_mobile_general_theme).'</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									'.__('Particular design for Headers', 'codepeople-theme-switch-text').'</label>
								</th>
								<td>
									<select name="codepeople-mobile-header-theme" onchange="changeImage(this, \'#codepeople-mobile-header-theme\', \'element_\')">
										'.codepeople_theme_switch_print_options($codepeople_mobile_header_theme).'
									</select>
								</td>
								<td>'.codepeople_theme_switch_print_image($codepeople_mobile_header_theme, 'header').'</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									'.__('Particular design for Footers', 'codepeople-theme-switch-text').'</label>
								</th>
								<td>
									<select name="codepeople-mobile-footer-theme" onchange="changeImage(this, \'#codepeople-mobile-footer-theme\', \'element_\')">
										'.codepeople_theme_switch_print_options($codepeople_mobile_footer_theme).'
									</select>
								</td>
								<td>'.codepeople_theme_switch_print_image($codepeople_mobile_footer_theme, 'footer').'</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									'.__('Particular design for Nav Bars', 'codepeople-theme-switch-text').'</label>
								</th>
								<td>
									<select name="codepeople-mobile-navbar-theme" onchange="changeImage(this, \'#codepeople-mobile-navbar-theme\', \'element_\')">
										'.codepeople_theme_switch_print_options($codepeople_mobile_navbar_theme).'
									</select>
								</td>
								<td>'.codepeople_theme_switch_print_image($codepeople_mobile_navbar_theme, 'navbar').'</td>
							</tr>
							<tr valign="top">
								<th scope="row">
									'.__('Particular design for Lists', 'codepeople-theme-switch-text').'</label>
								</th>
								<td>
									 <select name="codepeople-mobile-list-theme" onchange="changeImage(this, \'#codepeople-mobile-list-theme\', \'element_\')">
										'.codepeople_theme_switch_print_options($codepeople_mobile_list_theme).'
									</select>
								</td>
								<td>'.codepeople_theme_switch_print_image($codepeople_mobile_list_theme, 'list').'</td>
							</tr>
						</tbody>
					</table>
					<input type="hidden" name="codepeople-theme-design-submit" value="ok" />
					<div class="submit"><input type="submit" class="button-primary" value="'.__('Update Settings', 'codepeople-theme-switch-text').'" /></div>
				</form>
			</div>';
	}
	
	function codepeople_theme_switch_print_options($value, $general = false){
		$codepeople_mobile_themes = array('default', 'a', 'b', 'c', 'd', 'e');
		$result = '';
		
		foreach ($codepeople_mobile_themes as $theme){
			$result .= '<option value="'.$theme.'" '.(($value == $theme) ? 'selected' : '').' >';
			if($theme == 'default'){
				$result .= ($general) ? __('Default theme', 'codepeople-theme-switch-text') : __('Inherited from general', 'codepeople-theme-switch-text');
			}else{
				$result .= __('Theme ', 'codepeople-theme-switch-text').strtoupper($theme);
			}
			$result .= '</option>';
		}
		
		return $result;
	} // codepeople_theme_switch_print_options

	function codepeople_theme_switch_print_image($value, $prefix = ''){
		$image_dir = plugin_dir_url(__FILE__).'images';
		
		if($value == 'default' && !empty($prefix)){
			$result = '<img id="codepeople-mobile-'.$prefix.'-theme" src="'.$image_dir.'/empty.png">';
		}else{
			$result = '<img id="codepeople-mobile-'.((!empty($prefix)) ? $prefix : 'general').'-theme" src="'.$image_dir.'/'.((!empty($prefix)) ? 'element_' : '').$value.'.png">';
		}
		return $result;
	} // codepeople_theme_switch_print_image
}
	
	
	
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'codepeople_theme_switch_settings_link');

if(!function_exists('codepeople_theme_switch_settings_link')){
	function codepeople_theme_switch_settings_link($links){
		$settings_link = '<a href="options-general.php?page=codepeople-theme-switch.php">'.__('Settings').'</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
	}
}

/**
 * Tell Wordpress to switch the theme based in the device where the webpage is loaded.
 */
add_filter('template', 'codepeople_mobile_switch_theme_by_device');
add_filter('stylesheet', 'codepeople_mobile_switch_theme_by_device');

if(!function_exists("codepeople_mobile_switch_theme_by_device")){
	function codepeople_mobile_switch_theme_by_device($theme){
		if (is_admin ())
			return $theme;
		
		$detect = new Mobile_Detect();
        
		if ($detect->isMobile() || $detect->isTablet()) {
        	$theme = 'codepeople-light';
    	}
		
		return $theme;	
	}
} // codepeople_mobile_switch_theme_by_device

add_action('plugins_loaded', 'codepeople_theme_switch_init');
if(!function_exists("codepeople_theme_switch_init")){
	function codepeople_theme_switch_init(){
		load_plugin_textdomain('codepeople-theme-switch-text', false, dirname(plugin_basename(__FILE__)) . '/../languages/');
	}
} // codepeople_theme_switch_init
?>