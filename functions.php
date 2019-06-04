<?php
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'MySaintUrsula General Settings',
		'menu_title'	=> 'MySaintUrsula Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));	
	
}
/*add_action('after_setup_theme','remove_core_updates');
function remove_core_updates()
{
 if(! current_user_can('update_core')){return;}
 add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
 add_filter('pre_option_update_core','__return_null');
 add_filter('pre_site_transient_update_core','__return_null');
}
remove_action('load-update-core.php','wp_update_plugins');
add_filter('pre_site_transient_update_plugins','__return_null');*/