<?php 
class PluginActivationSEO_IMAGES {
	
	public function setupDataOptionSEO_IMAGES() {
	   	
	   	global $wpdb;
	  
	    $seo_images_db_version = '1.0';
		$seo_images_post_type_flag = $wpdb->prefix . 'post_type_flag';
		$charset_collate = $wpdb->get_charset_collate();
    	$getDbVersion = get_option( 'SEO_IMAGES_db_version', '' );
	 
		if($wpdb->get_var("show tables like '".$seo_images_post_type_flag."'") != $seo_images_post_type_flag) {
			
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

			$sql = "CREATE TABLE $seo_images_post_type_flag (
					  `id` int(10) NOT NULL AUTO_INCREMENT,
					  `post_type` varchar(25) NOT NULL,
					  `created_at` datetime NOT NULL,
					  PRIMARY KEY (id)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
	 		
	 		dbDelta($sql);
		}

		if($getDbVersion != $seo_images_db_version) {
	    	add_option( 'SEO_IMAGES_db_version', $seo_images_db_version );
		}
	 
	}
}
$PluginActivationSEO_IMAGES = new PluginActivationSEO_IMAGES();