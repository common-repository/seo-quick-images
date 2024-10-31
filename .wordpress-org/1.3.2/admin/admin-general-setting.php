<?php 
if (!defined('ABSPATH')) {
	exit;
}

class AdminGeneralSettingSEO_IMAGES {

    public function __construct(){
		add_action("wp_ajax_addPostTypeFlag", array($this, "SEO_IMAGES_addPostTypeFlag"));
		add_action("wp_ajax_nopriv_addPostTypeFlag", array($this, "SEO_IMAGES_addPostTypeFlag"));

        add_action("wp_ajax_call_imageApi", array($this, "SEO_IMAGES_call_image_api"));
		add_action("wp_ajax_nopriv_call_imageApi", array($this, "SEO_IMAGES_call_image_api"));

        add_action("wp_ajax_set_featured_image", array($this, "SEO_IMAGES_set_featured_image"));
		add_action("wp_ajax_nopriv_set_featured_image", array($this, "SEO_IMAGES_set_featured_image"));

        add_action("wp_ajax_insert_selected_imageApi", array( $this, "insert_selected_imageApi" ) );
        add_action("wp_ajax_seo_images_savePost", array( $this, "seo_images_savePost" ) );
        add_action("wp_ajax_nopriv_seo_images_savePost", array( $this, "seo_images_savePost" ) );
		add_action("add_meta_boxes", array($this, "SEO_IMAGES_adding_custom_meta_boxes"), 10, 2 );
        add_action('admin_menu', array( $this, 'settings' ), 100, 2 );
        add_action('admin_init', array( $this, 'start_session' ), 1);

        add_filter( 'plugin_action_links_seo-images/seo_images.php', array( $this, 'seo_images_settings_link' ) );
	}

    public function seo_images_settings_link( $links ) {
    // Build and escape the URL.
    $url = esc_url( add_query_arg(
        'page',
        'wp-seo-plugins-login',
        get_admin_url() . 'admin.php'
    ) );
    // Create the link.
    $settings_link = "<a href='$url'>" . __( 'Settings' ) . '</a>';
    // Adds the link to the end of the array.
    array_push(
        $links,
        $settings_link
    );
    return $links;
}

    public function start_session(){
        if (!session_id())
            session_start();
    }

    public function settings() {
        add_submenu_page('wp-seo-plugins-login', 'Images', 'Images', 'edit_posts', 'seo-images', array( $this, 'settingsView' ) );
    }

    public function settingsView() {
        include plugin_dir_path(__DIR__) . 'view/seoImagesSettings.php';
    }

	public function SEO_IMAGES_adding_custom_meta_boxes() {
        add_meta_box(
            'metabox_import_media',
            __( 'SEO Images', 'textdomain' ),
            array($this, "SEO_IMAGES_wpdocs_metabox_callback"),
            get_current_screen(),
            'side',
            'default'
        );
	}

	/**
	 * Meta box display callback.
	 * @param WP_Post $post Current post object.
	*/
	public function SEO_IMAGES_wpdocs_metabox_callback( $post ){
	    
	    ob_start(); ?>
        <div class="loader-curtain" id="loader_curtain" style="display: none;">
            <img src="<?php echo esc_html( SEO_IMAGES_PATH_SRC.'assets/images/spinner-2x.gif' ); ?>" />
        </div>
	    <div class="seo_images-metabox-cvr">
	    	<p class="notice-info"><span class="red-sp">Note:</span>Search using any keyword to import images into WYSIWYG editor.</p>
	    	<span class="bug-holder"></span>
	    	
    		<div class="seo_images-group" id="search_group" style="display:none;">
	    		<label class="search-lb set-bold">Search <span class="req-sp">*</span></label>
	    		<input type="text" class="search-inp" name="search_keyword">
	    		<input type="hidden" id="p_id" value="<?php echo esc_html( $post->ID ); ?>">
	    		<input type="hidden" id="article_title" value="<?php echo esc_html( get_the_title( $post->ID ) ); ?>">
	    		<input type="hidden" id="h1_title" data-h1count="" data-h1id="" value="">
	    		<input type="hidden" id="h2_title" data-h2count="" data-h2id="" value="">
	    		<input type="hidden" id="h3_title" data-h3count="" data-h3id="" value="">
	    		<input type="hidden" id="h4_title" data-h4count="" data-h4id="" value="">
	    		<input type="hidden" id="h5_title" data-h5count="" data-h5id="" value="">
	    		<input type="hidden" id="h6_title" data-h6count="" data-h6id="" value="">
	    	</div>
	    	<div class="seo_images-group" style="display: none;">
	    		<label class="search-lb set-bold" for="fname">No of images <span class="req-sp">*</span></label>
	    		<input type="number" class="seo_images-number-inp" name="image_quant" min="1" max="9">
	    		<span class="set-short">(No. of images should'nt go beyond headings count.)</span>
	    	</div>
            <!--
            <div class="seo_images-group">
                <label class="set-bold" for="lname">Select source of images <span class="req-sp">*</span></label>
                <div class="seo_images-inner-holder">
                    <div class="seo_images-inner-pad">
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span>checkbox</span>
                            </legend>
                            <label for="source_1">
                                <input name="source" type="radio" id="source_1" value="source_1">
                                Source 1
                            </label>
                        </fieldset>
                    </div>
                    <div class="seo_images-inner-pad">
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span>checkbox</span>
                            </legend>
                            <label for="source_2">
                                <input name="source" type="radio" id="source_2" value="source_2">
                                Source 2
                            </label>
                        </fieldset>
                    </div>
                    <div class="seo_images-inner-pad">
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span>checkbox</span>
                            </legend>
                            <label for="source_3">
                                <input name="source" type="radio" id="source_3" value="source_3">
                                Source 3
                            </label>
                        </fieldset>
                    </div>
                    <div class="seo_images-inner-pad" style="margin-top: 16px;">
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span>checkbox</span>
                            </legend>
                            <label for="source_4">
                                <input name="source" type="radio" id="source_4" value="source_4">
                                Shutterstock
                            </label>
                        </fieldset>
                    </div>
                    <div class="seo_images-inner-pad">
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span>checkbox</span>
                            </legend>
                            <label for="source_5">
                                <input name="source" type="radio" id="source_5" value="source_5">
                                Shutterstock Enterprise
                            </label>
                        </fieldset>
                        <input name="shutterstock_api_key" type="text" id="shutterstock_api_key" value="Enter Api Key" class="regular-text" style="max-width: 100%;margin-top: 8px;">
                    </div>
                </div>
            </div>
            -->
	    	<div class="seo_images-group"> 	
	    		<label class="set-bold" for="lname">Image Size <span class="req-sp">*</span></label>
	    		<div class="seo_images-inner-holder">
	    			<div class="seo_images-inner-pad">
	    				<input type="radio" id="150x150" name="image_size" value="150x150">
	    				<label for="150x150">150x150 (Thumbnail)</label>
	    			</div>
	    			<div class="seo_images-inner-pad">
	    				<input type="radio" id="300x300" name="image_size" value="300x300">
	    				<label for="300x300">300x300 (Medium)</label>
	    			</div>
	    			<!-- <div class="seo_images-inner-pad">
	    				<input type="radio" id="600x600" name="image_size" value="600x600">
	    				<label for="600x600">600x600</label>
	    			</div> -->
	    			<div class="seo_images-inner-pad">
	    				<input type="radio" id="1024x1024" name="image_size" value="1024x1024">
	    				<label for="1024x1024">1024x1024 (Large)</label>
	    			</div>
	    			<div class="seo_images-inner-pad">
	    				<input type="radio" id="full" name="image_size" value="full">
	    				<label for="full">Original Size (Full)</label>
	    			</div>
	    		</div>
	    	</div>
	    	<div class="seo_images-group">
	    		<label class="set-bold" for="lname">Image Alignment<span class="req-sp">*</span></label>
	    		<div class="seo_images-inner-holder">
	    			<div class="seo_images-inner-pad">
	    				<input type="radio" id="left" name="image_align" value="left">
	    				<label for="left">Left</label>
	    			</div>
	    			<div class="seo_images-inner-pad">	
	    				<input type="radio" id="right" name="image_align" value="right">
	    				<label for="right">Right</label>
	    			</div>
	    			<div class="seo_images-inner-pad">
	    				<input type="radio" id="center" name="image_align" value="center">
	    				<label for="center">Center</label>
	    			</div>
	    			<div class="seo_images-inner-pad">
	    				<input type="radio" id="random" name="image_align" value="random">
	    				<label for="random">Random</label>
	    			</div>
	    		</div>
	    	</div>
            <div class="seo_images-group">
                <fieldset>
                    <legend class="screen-reader-text">
                        <span>checkbox</span>
                    </legend>
                    <label for="creative_commons">
                        <input name="creative_commons" type="checkbox" id="creative_commons" value="1">
                        Use only images with creative commons
                    </label>
                </fieldset>
                <fieldset>
                    <legend class="screen-reader-text">
                        <span>checkbox</span>
                    </legend>
                    <label for="show_author">
                        <?php $show_image_author = get_option( 'seo_images_show_author' ); ?>
                        <input name="show_author" type="checkbox" id="show_author" value="1" <?php echo sanitize_text_field( $show_image_author ) ? 'checked' : '' ?>>
                        Show Author
                    </label>
                </fieldset>
            </div>
	    	<div class="seo_images-group"> 
	    		<input type="button" id="add_image_act" class="button button-primary" value="Fetch Images">
	    	</div>
	    </div>
        <div id="seo_images_selection"></div>
        <div class="seo_images_selection_source" id="seo_images_selection_source_1"></div>
        <div class="seo_images_selection_source" id="seo_images_selection_source_2"></div>
        <div class="seo_images_selection_source" id="seo_images_selection_source_3"></div>
        <div class="seo_images_selection_source" id="seo_images_selection_source_4"></div>
        <div class="seo_images_selection_source" id="seo_images_selection_source_5"></div>
        <div class="seo_images_selection_buttons" id="seo_images_selection_buttons" style="clear: both;"></div>
        <?php $credits = wp_seo_plugins_get_credits(); ?>
        <p style="text-align: right">
            <small>
                <i>You have <span style="color: #ba000d"><?php echo esc_html( $credits->seo_images ); ?> credits left</span> - Click <a href="https://wpseoplugins.org/" target="_blank">here</a> to purchase more credits.</i>
            </small>
            <br />
            <small><i>SEO Images v.<?php echo esc_html( SEO_IMAGES_VERSION ); ?></i></small>
        </p>
		<?php
		echo ob_get_clean();  	
	}

	public function SEO_IMAGES_addPostTypeFlag(){
		
		global $wpdb;
		
		$params = array();
    	parse_str($_POST['form_data'], $params);
    	// print_r($params);
    	
    	if ( isset( $params['save_seo_images_flag'] ) && wp_verify_nonce( $params['save_seo_images_flag'], 'SEO_IMAGES' ) ) {

			$post_type_flag = $params['post_type_flag'];
			$table_name = $wpdb->prefix.'post_type_flag';
			$created_at = date("Y-m-d H:i:s");
			$data = array('post_type' => $post_type_flag, 'created_at' => $created_at );

			$res = $wpdb->get_results( "SELECT * FROM $table_name", ARRAY_A );
			
			// if entry present
			if(count($res) > 0) {
				
				// then delete the entry first
				$wpdb->query("DELETE FROM $table_name");

				// now insert data
				$wpdb->insert($table_name,$data);
			} else {
				// else entry not present then insert it
				$wpdb->insert($table_name,$data);
			}
		}

		exit();
	}
	
	/*
	 * @param $image_url string image web path
	 * @param $post_id  string post id
	 * @param $fileName string name of file to upload
	 * @param $size_resolution string resolution of image
	 * @param $featured string featured image yes/no flag
	 */
	public function uploadImageToWP($image_url = null, $post_id = null, $fileName, $size_resolution, $featured) {

        global $wpdb;
        $upload_meta = array();

        // Get image from external url and save to Media Library
        if ($image_url && $post_id) {
            $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $fileName));
            $att_id = '';
            if(!empty($attachment[0])){
                $att_id = $attachment[0];
            }

            if( !empty($att_id) ) {

            // set_post_thumbnail($post_id, $att_id);
            // return $att_id;
                $img_url = wp_get_attachment_image_src($att_id, $size_resolution, true );
                $upload_meta['image'] = $img_url[0];
                $upload_meta['width'] = $img_url[1];
                $upload_meta['height'] = $img_url[2];
                $upload_meta['attachement_id'] = $att_id;

                if(!empty($upload_meta)) {
                    return $upload_meta;
                } else {
                    return 'no_image';
                }
            } else {

                // Need to require these files
                if (!function_exists('media_handle_upload')) {
                    require_once ABSPATH . "wp-admin" . '/includes/image.php';
                    require_once ABSPATH . "wp-admin" . '/includes/file.php';
                    require_once ABSPATH . "wp-admin" . '/includes/media.php';
                }

                $tmp = download_url($image_url);

                if (is_wp_error($tmp)) {
                // download failed, handle error
                    return 'no_image';
                }

                $desc       = get_the_title($post_id);
                $file_array = array();
                // Set variables for storage
                // fix file filename for query strings
                preg_match('/[^?]+.(jpg|jpe|jpeg|gif|png)/i', $image_url, $matches);
                //$file_array['name'] = basename($matches[0]);
                $file_array['name']     = $fileName . '.jpg';
                $file_array['tmp_name'] = $tmp;
                // If error storing temporarily, unlink
                if (is_wp_error($tmp)) {
                    //var_dump($tmp);
                    @unlink($file_array['tmp_name']);
                    $file_array['tmp_name'] = '';
                }
                // do the validation and storage stuff
                $id = media_handle_sideload($file_array, $post_id, $desc);
                // If error storing permanently, unlink
                if (is_wp_error($id)) {
                    //var_dump($id);
                    @unlink($file_array['tmp_name']);
                }

                // set featured image for this variable only
                if($featured == 'yes') {
                    set_post_thumbnail($post_id, $id);
                }

                // here uploaded image url is returned
                $img_url = wp_get_attachment_image_src($id, $size_resolution, true );
                $upload_meta['image'] = $img_url[0];
                $upload_meta['width'] = $img_url[1];
                $upload_meta['height'] = $img_url[2];
                $upload_meta['attachement_id'] = $id;
				
				if(!empty($upload_meta)) {
					return $upload_meta;
				} else {
					return 'no_image';
				}
			}
		}
	}

	public function preNameSetter( $length = 8 ){
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
		$string = substr( str_shuffle( $chars ), 0, $length );
		return $string;
	}

    public function SEO_IMAGES_set_featured_image(){
        if( !empty($_POST)){
            header('Content-Type: application/json');
            $post_id = sanitize_text_field( $_POST['p_id'] );
            $featured_image = sanitize_text_field( $_POST['featured_image']);
            $article_title = sanitize_text_field( $_POST['article_title'] );
            $name = $article_title;
            $uniqu_prefix = AdminGeneralSettingSEO_IMAGES::preNameSetter(8);
            $file_name = $uniqu_prefix.'_'.$name;
            $size_resolution = 'full';
            $featured = 'yes';

            if(strpos($featured_image, '.jpg') !== false ||
                strpos($featured_image, '.jpeg') !== false ||
                strpos($featured_image, '.gif') !== false ||
                strpos($featured_image, '.png') !== false ||
                strpos($featured_image, '.bmp') !== false
            ) {
                // then only upload & set featured image
                $flag = AdminGeneralSettingSEO_IMAGES::uploadImageToWP($featured_image, $post_id, $file_name, $size_resolution, $featured);
            }

            if($flag != 'no_image' && !empty($flag)) {
                //  means image is uploaded
                $featured_image_response['image'] = $flag;
                echo json_encode( array('status' => 0, 'message' => 'ok' ));
            } else if($flag == 'no_image') {
                echo json_encode( array('status' => -1, 'message' => 'no_image' ));
            } else {
                echo json_encode( array('status' => -2, 'message' => 'something wrong' ));
            }
        } else {
            $msg = 0;
            echo json_encode($msg);
        }
        exit();
    }

	public function SEO_IMAGES_call_image_api(){

		if( !empty($_POST) ) {
            header('Content-Type: application/json');
			
			// at first delete array instances
			unset($heading_val);
			unset($heading_id_ar);
			unset($images_ar);
			unset($response_html);

			$post_id = sanitize_text_field( $_POST['p_id'] );
			$article_title = sanitize_text_field( $_POST['article_title'] );
			$image_quant = sanitize_text_field( $_POST['image_quant'] );
			$image_size = sanitize_text_field( $_POST['image_size'] );
			$image_align = sanitize_text_field( $_POST['image_align'] );
			$headings = !empty( $_POST['headings'] ) ? (array) $_POST['headings'] : array() ;
            $headings = array_map( 'sanitize_text_field', $headings );
			$headings_id = !empty( $_POST['headings_id'] ) ? (array) $_POST['headings_id'] : '';
            $headings_id = array_map( 'sanitize_text_field', $headings_id );
            $creative_commons = sanitize_text_field( $_POST['creative_commons'] ) ?? '';
            $source = sanitize_text_field( $_POST['source'] ) ?? '';
            $show_author = sanitize_text_field( $_POST['show_author'] ) ?? '';
            $_yoast_wpseo_focuskw = get_post_meta( $post_id, '_yoast_wpseo_focuskw', true);

            $error = 'false';
            $error_msg = '';
			
			// One liner to remove empty ("" empty string) elements from your array.
			// Note: This code deliberately keeps null, 0 and false elements.
			$headings = array_filter($headings, function($a) {return $a !== "";});
			$headings_id = array_filter($headings_id, function($a) {return $a !== "";});
			
			// at first set featured image
			$featured_image_response = array();

            $api_key = get_option( 'sc_api_key' );
            $remote_get = WP_SEO_PLUGINS_BACKEND_URL . '/images?title=' . $article_title . '&api-key=' . $api_key . '&source=' . $source . '&creative_commons=' . $creative_commons;
			$args = array(
                'timeout'     => 120,
                'sslverify' => false
            );
            $data = wp_remote_get( $remote_get, $args );

            if( is_wp_error( $data ) ) {
                file_put_contents( $_SERVER['DOCUMENT_ROOT'] . "/seo_images.log", date( 'Y-m-d H:i:s' ) . ' --> ' . print_r( $data, true ), FILE_APPEND | LOCK_EX );
                exit;
            }

            $rowData = json_decode( $data['body'] );
            if( $rowData->status == 0 ) {
                $g_data = $rowData->result;
            } else {
                $featured_img_bug = $rowData->message;
            }

			if(strpos($g_data, '<title>Bad Request</title>') !== false) {
				// echo 'error response'; 
				// don't set featured image for post here
				$featured_img_bug = 'Bad Request: Featured image unable to set for this keyword!';
			} else {
				// echo 'no error present!';

				$g_array = json_decode($g_data, true);

                //file_put_contents( $_SERVER['DOCUMENT_ROOT'] . "/seo_images.log", date( 'Y-m-d H:i:s' ) . ' --> ' . print_r( $g_array, true ), FILE_APPEND | LOCK_EX );

				$name = $article_title;
				$uniqu_prefix = AdminGeneralSettingSEO_IMAGES::preNameSetter(8);
				$file_path = $g_array['images'];
				$file_name = $uniqu_prefix.'_'.$name;
				$size_resolution = 'full';
				$featured = 'yes';

				if(!has_post_thumbnail($post_id)) {
					// loop it out image url array here
					for ($a=0; $a<count($file_path); $a++) { 
						
						if(strpos($file_path[$a], '.jpg') !== false ||
							strpos($file_path[$a], '.jpeg') !== false ||
							strpos($file_path[$a], '.gif') !== false ||
							strpos($file_path[$a], '.png') !== false ||	
							strpos($file_path[$a], '.bmp') !== false
						) {
							// then only upload & set featured image
                            // Featured image is in custom ajax
                            //$flag = AdminGeneralSettingSEO_IMAGES::uploadImageToWP($file_path[$a], $post_id, $file_name, $size_resolution, $featured);
						}
						
						if($flag != 'no_image' && !empty($flag)) {
							//  means image is uploaded
                            $featured_image_response['image'] = $flag;
							break; 
						} else if($flag == 'no_image') {
							continue;
						}
					}
				}

			}

            $headings_encoded = '';
            foreach( $headings as $x => $h ) {
                $headings_encoded .= 'headings[' . $x . ']=' . strip_tags( $h ) . '&';
            }
            $headings_id_encoded = '';
            foreach( $headings_id as $x => $h ) {
                $headings_id_encoded .= 'headings_id[' . $x . ']=' . strip_tags( $h ) . '&';
            }

            $remote_get = WP_SEO_PLUGINS_BACKEND_URL . '/images/fetch?' . $headings_encoded . $headings_id_encoded . 'source=' . $source . '&creative_commons=' . $creative_commons . '&api-key=' . $api_key;

            $args = array(
                'timeout'     => 240,
                'sslverify' => false
            );

            $data = wp_remote_get( $remote_get, $args );

            if( is_wp_error( $data ) ) {
                file_put_contents( $_SERVER['DOCUMENT_ROOT'] . "/seo_images.log", date( 'Y-m-d H:i:s' ) . ' --> ' . print_r( $data, true ) . "\n" . $remote_get . "\n", FILE_APPEND | LOCK_EX );
                exit;
            }

            $rowData = json_decode( $data['body'] );

			$response_html = [];

            $response =  array(
                "error" => $rowData->error,
                "msg" => $response_html,
                "error_msg" => $rowData->error_msg,
                "featured" => get_the_post_thumbnail( $post_id ),
                "images_ar" => $rowData->images_ar,
                "heading_val" => $rowData->heading_val,
                "g_data_query" => $g_array['query'],
                "g_data_images" => $g_array['images'],
                "g_data" => $g_array
            );

            die( json_encode( $response ) );

            exit();
		} else {
			$msg = 0;
			echo json_encode($msg);
		}  
    	exit(); 
	}

    private function getHeadingVal( $headings ) {
        $heading_val = [];
        foreach($headings as $x => $x_value) {
            if($x == 'h1_title') {
                $x_value = strip_tags($x_value);
                $x_value = str_replace(array('\'','"',',' ,';','<','>','~','!','#','%','^','&','*','(',')','?','/'), "", $x_value);
                $x_value = preg_replace("/&#?[a-z0-9]{2,8};/i","",$x_value);

                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $str = preg_replace('/\s+/', '+', $x_value[$i]);
                        array_push($heading_val, trim($str));
                    }
                } else {
                    array_push($heading_val, trim($x_value));
                }
            }
            if($x == 'h2_title') {
                $x_value = strip_tags($x_value);
                $x_value = str_replace(array('\'','"',',' ,';','<','>','~','!','#','%','^','&','*','(',')','?','/'), "", $x_value);
                $x_value = preg_replace("/&#?[a-z0-9]{2,8};/i","",$x_value);

                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $str = preg_replace('/\s+/', '+', $x_value[$i]);
                        array_push($heading_val, trim($str));
                    }
                } else {
                    array_push($heading_val, trim($x_value));
                }
            }
            if($x == 'h3_title') {
                $x_value = strip_tags($x_value);
                $x_value = str_replace(array('\'','"',',' ,';','<','>','~','!','#','%','^','&','*','(',')','?','/'), "", $x_value);
                $x_value = preg_replace("/&#?[a-z0-9]{2,8};/i","",$x_value);

                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $str = preg_replace('/\s+/', '+', $x_value[$i]);
                        array_push($heading_val, trim($str));
                    }
                } else {
                    array_push($heading_val, trim($x_value));
                }
            }
            if($x == 'h4_title') {
                $x_value = strip_tags($x_value);
                $x_value = str_replace(array('\'','"',',' ,';','<','>','~','!','#','%','^','&','*','(',')','?','/'), "", $x_value);
                $x_value = preg_replace("/&#?[a-z0-9]{2,8};/i","",$x_value);

                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $str = preg_replace('/\s+/', '+', $x_value[$i]);
                        array_push($heading_val, trim($str));
                    }
                } else {
                    array_push($heading_val, trim($x_value));
                }
            }
            if($x == 'h5_title') {
                $x_value = strip_tags($x_value);
                $x_value = str_replace(array('\'','"',',' ,';','<','>','~','!','#','%','^','&','*','(',')','?','/'), "", $x_value);
                $x_value = preg_replace("/&#?[a-z0-9]{2,8};/i","",$x_value);

                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $str = preg_replace('/\s+/', '+', $x_value[$i]);
                        array_push($heading_val, trim($str));
                    }
                } else {
                    array_push($heading_val, trim($x_value));
                }
            }
            if($x == 'h6_title') {
                $x_value = strip_tags($x_value);
                $x_value = str_replace(array('\'','"',',' ,';','<','>','~','!','#','%','^','&','*','(',')','?','/'), "", $x_value);
                $x_value = preg_replace("/&#?[a-z0-9]{2,8};/i","",$x_value);

                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $str = preg_replace('/\s+/', '+', $x_value[$i]);
                        array_push($heading_val, trim($str));
                    }
                } else {
                    array_push($heading_val, trim($x_value));
                }
            }
        }
        return $heading_val;
    }

    private function getIsH1Array( $headings_id ) {
        $is_h1 = [];
        foreach($headings_id as $x => $x_value) {
            if ($x == 'h1_id') {
                $x_value = trim($x_value);
                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ", $x_value);
                    for ($i = 0; $i < count($x_value); $i++) {
                        $j = $x_value[$i];
                        array_push($heading_id_ar, trim($j));
                        array_push($is_h1, trim($j));
                    }
                } else {
                    array_push($heading_id_ar, trim($x_value));
                    array_push($is_h1, trim($x_value));
                }
            }
        }
        return $is_h1;
    }

    private function getHeadingIdArray( $headings_id ) {
        $heading_id_ar = [];
        foreach($headings_id as $x => $x_value) {
            if($x == 'h1_id') {
                $x_value = trim($x_value);
                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $j = $x_value[$i];
                        array_push($heading_id_ar, trim($j));
                    }
                } else {
                    array_push($heading_id_ar, trim($x_value));
                }
            }
            if($x == 'h2_id') {
                $x_value = trim($x_value);
                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $j = $x_value[$i];
                        array_push($heading_id_ar, trim($j));
                    }
                } else {
                    array_push($heading_id_ar, trim($x_value));
                }
            }
            if($x == 'h3_id') {
                $x_value = trim($x_value);
                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $j = $x_value[$i];
                        array_push($heading_id_ar, trim($j));
                    }
                } else {
                    array_push($heading_id_ar, trim($x_value));
                }
            }
            if($x == 'h4_id') {
                $x_value = trim($x_value);
                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $j = $x_value[$i];
                        array_push($heading_id_ar, trim($j));
                    }
                } else {
                    array_push($heading_id_ar, trim($x_value));
                }
            }
            if($x == 'h5_id') {
                $x_value = trim($x_value);
                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $j = $x_value[$i];
                        array_push($heading_id_ar, trim($j));
                    }
                } else {
                    array_push($heading_id_ar, trim($x_value));
                }
            }
            if($x == 'h6_id') {
                $x_value = trim($x_value);
                if (strpos($x_value, ' | ') !== false) {
                    $x_value = explode(" | ",$x_value);
                    for($i=0; $i<count($x_value); $i++) {
                        $j = $x_value[$i];
                        array_push($heading_id_ar, trim($j));
                    }
                } else {
                    array_push($heading_id_ar, trim($x_value));
                }
            }
        }
        return $heading_id_ar;
    }

    function insert_selected_imageApi() {
        $post_id = sanitize_text_field( $_POST['p_id'] );
        $image_size = sanitize_text_field( $_POST['image_size'] );
        $image_align = sanitize_text_field( $_POST['image_align'] );
        $show_author = sanitize_text_field( $_POST['show_author'] );
        $headings = array_filter( $_POST['headings'], function($a) { return $a !== ""; } );
        $headings_id = array_filter( $_POST['headings_id'], function($a) { return $a !== ""; } );
        $heading_val = $this->getHeadingVal( $headings );
        $heading_id_ar = $this->getHeadingIdArray( $headings_id );
        $is_h1 = $this->getIsH1Array( $headings_id );
        $_yoast_wpseo_focuskw = get_post_meta( $post_id, '_yoast_wpseo_focuskw', true);

        $categories_id = wp_get_post_categories( $post_id );
        $categories = array();
        foreach( $categories_id as $category_id ) {
            $category = get_category( $category_id );
            $categories[] = $category->name;
        }
        $tags_id = get_the_tags( $post_id );
        $tags = array();
        foreach( $tags_id as $tag ) {
            $tags[] = $tag->name;
        }

        $error = 'false';
        $error_msg = '';
        $i = 0;
        foreach ( $_POST['images'] as $image) {
            $IMG_TAG = '';

            if( !empty( $image[0] ) && !empty( $image[1] ) ) {
                $name = trim( $image[0] );
                $alt_array = array();
                if( in_array( $heading_id_ar[$i], $is_h1 ) ) {
                    if( $_yoast_wpseo_focuskw ) {
                        $alt_array[] = $_yoast_wpseo_focuskw;
                    }
                }
                foreach( $categories as $category ) {
                    $alt_array[] = $category;
                }
                $alt_array[] = $name;
                $alt = implode( ', ', $alt_array );

                $title_array = array();
                foreach( $tags as $tag ) {
                    $title_array[] = $tag;
                }
                $title_array[] = $name;
                if( $_yoast_wpseo_focuskw ) {
                    $title_array[] = $_yoast_wpseo_focuskw;
                }
                $title = implode( ', ', $title_array );


                $uniqu_prefix = AdminGeneralSettingSEO_IMAGES::preNameSetter(8);

                // $file_path = $images_ar[$b];
                $file_name = $uniqu_prefix.'_'.$name;
                $featured = 'no';

                if($image_size == '150x150') {
                    // thumbnail
                    $size_resolution = array('150','150');
                    $size = '150px';
                } else if($image_size == '300x300') {
                    // medium
                    $size_resolution = array('300','300');
                    $size = '300px';
                } else if($image_size == '1024x1024') {
                    // large
                    $size_resolution = array('1024','1024');
                    $size = '1024px';
                } else if($image_size == 'full') {
                    // full
                    $size_resolution = 'full';
                    $size = '100%';
                }

                //images_ar: [[["https://tedescopietre.it/wp-content/uploads/2018/04/Pietra_lavica_4c2b18c013d99.jpg",…]],…]
                $file_path = stripslashes( $image[1] );

                // TODO - Better security check
                if(strpos( strtolower( $file_path ), '.jpg') !== false ||
                    strpos( strtolower( $file_path ), '.jpeg') !== false ||
                    strpos( strtolower ( $file_path ), '.gif') !== false ||
                    strpos( strtolower ( $file_path ), '.png') !== false ||
                    strpos( strtolower ( $file_path ), '.bmp') !== false
                ) {
                    // then only upload & set featured image
                    //$uploaded_path = AdminGeneralSettingSEO_IMAGES::uploadImageToWP($file_path, $post_id, $file_name, $size_resolution, $featured);
                    $uploaded_path = AdminGeneralSettingSEO_IMAGES::uploadImageToWP($file_path, $post_id, $file_name, 'full', $featured);
                }


                if($uploaded_path != 'no_image' && !empty($uploaded_path)) {
                    //  MEANS IMAGE IS UPLOADED SUCCESSFULLY..
                    // META USED TO CREAE IMG TAG
                    $upl_path = $uploaded_path['image'];
                    $upl_width = $uploaded_path['width'];
                    $upl_height = $uploaded_path['height'];
                    $upl_id = $uploaded_path['attachement_id'];

                    $random_align = array('alignleft','alignright','aligncenter', 'alignnone');
                    // Randomize the order of array items
                    shuffle($random_align);

                    // DRAW IMAGE TAG USING META
                    $explode_author = explode('/', $file_path);
                    $author = isset( $explode_author[2] ) ? $explode_author[2] : '';

                    if( $show_author != 'show_author' ) {
                        $author = '';
                    }

                    if($image_size == '150x150' && $image_align == "left") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="alignleft"]<img class="size-thumbnail wp-image-'.$upl_id.' alignleft" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == '150x150' && $image_align == "right") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="alignright"]<img class="size-thumbnail wp-image-'.$upl_id.' alignright" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == '150x150' && $image_align == "center") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="aligncenter"]<img class="size-thumbnail wp-image-'.$upl_id.' aligncenter" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == '150x150' && $image_align == "random") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="' . $random_align[0] . '"]<img class="size-thumbnail wp-image-'.$upl_id.'" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == '300x300' && $image_align == "left") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="alignleft"]<img class="size-medium wp-image-'.$upl_id.' alignleft" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == '300x300' && $image_align == "right") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="alignright"]<img class="size-medium wp-image-'.$upl_id.' alignright" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == '300x300' && $image_align == "center") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="aligncenter"]<img class="size-medium wp-image-'.$upl_id.' aligncenter" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == '300x300' && $image_align == "random") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="' . $random_align[0] . '"]<img class="size-medium wp-image-'.$upl_id.'" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == '1024x1024' && $image_align == "left") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="alignleft"]<img class="size-large wp-image-'.$upl_id.' alignleft" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == '1024x1024' && $image_align == "right") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="alignright"]<img class="size-large wp-image-'.$upl_id.' alignright" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == '1024x1024' && $image_align == "center") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="aligncenter"]<img class="size-large wp-image-'.$upl_id.' aligncenter" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == '1024x1024' && $image_align == "random") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="' . $random_align[0] . '"]<img class="size-large wp-image-'.$upl_id.'" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == 'full' && $image_align == "left") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="alignleft"]<img class="size-full wp-image-'.$upl_id.' alignleft" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == 'full' && $image_align == "right") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="alignright"]<img class="size-full wp-image-'.$upl_id.' alignright" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == 'full' && $image_align == "center") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="aligncenter"]<img class="size-full wp-image-'.$upl_id.' aligncenter" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    } else if($image_size == 'full' && $image_align == "random") {
                        $IMG_TAG = '[caption id="attachment_'.$upl_id.'" align="' . $random_align[0] . '"]<img class="size-full wp-image-'.$upl_id.'" src="'.$upl_path.'" alt="'.$alt.'" title="'.$title.'" width="'.$upl_width.'" height="'.$upl_height.'" style="width: ' . $size . ';" /><figcaption class="wp-caption-text">' . $author . '</figcaption>[/caption]';
                    }
                }

                $response_html[$i]['error'] = 'false';
                if(!empty($featured_img_bug)) {
                    $error = 'true';
                    $error_msg = $featured_img_bug;
                    $response_html[$i]['featured_img_bug'] = $featured_img_bug;
                }

                $response_html[$i]['heading_title'] = trim( $heading_val[$i] );
                $response_html[$i]['heading_id'] = trim( $heading_id_ar[$i] );
                $response_html[$i]['heading_image'] = do_shortcode( $IMG_TAG );
            }
            $i++;
        }

        $response =  array(
            "error" => $error,
            "msg" => $response_html,
            "error_msg" => $error_msg,
            "featured" => get_the_post_thumbnail( $post_id )
        );
        echo json_encode($response);
        exit();
    }

    public function seo_images_savePost() {
        if( !current_user_can( 'edit_posts' ) ) {
            wp_send_json_error( 'Not enough privileges.' );
            wp_die();
        }

        if ( ! check_ajax_referer( 'seo_images_save_draft_nonce', 'nonce', false ) ) {
            wp_send_json_error( 'Invalid security token sent.' );
            wp_die();
        }

        $post_id = (int) sanitize_text_field( isset( $_POST['post_id'] ) ? sanitize_text_field( $_POST['post_id'] ) : 0 );
        $post_content = isset( $_POST['post_content'] ) ? sanitize_text_field( $_POST['post_content'] ) : '' ;

        if( $post_id > 0 && $post_content != '' ) {
            $_this_post = get_post( $post_id );
            $_this_post->post_content = stripslashes( apply_filters( 'the_content', $post_content ) );
            wp_update_post( $_this_post );
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }
    }
}

$adminGeneralSettingSEO_IMAGES = new AdminGeneralSettingSEO_IMAGES();