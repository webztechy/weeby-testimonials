<?php
 /**
 * Call metabox class and functions
 *
 */
 if( !class_exists('Weeby_Testimony_Metabox_class') ) {
	 

	class Weeby_Testimony_Metabox_class{	

		public function __construct() {
		
			add_action('admin_menu' ,array($this, 'author_bio_metaboxes') );
			add_action('save_post' ,array($this, 'author_bio_metaboxes_submit') );
			
		}
		
		
		public function author_bio_metaboxes() {
			add_meta_box(WEEBY_TESTIMONY_PREFIX.'author_metaboxes', '<span class="fa fa-info-circle"></span> Testimony Detail', array($this, 'author_bio_metaboxes_form'), WEEBY_POST_TYPE_TESTIMONY, 'normal', 'low' );
			
		}
		
		public function author_bio_metaboxes_form() {
			global $post;
			include(WEEBY_TESTIMONY_DIR.'view/metaboxes/metabox-testimony.php');
		}
		
		public function author_bio_metaboxes_submit($post_id){

			global $post;
			//// CHECK IF IT'S AN AUTOSAVE
			if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
			
			if(isset($_POST['post_type'])) {
			
				//// VERIFY PERMISSIONS
				if('page' == $_POST['post_type']) {
					 
					//// IF USER CAN'T EDIT PAGE
					if(!current_user_can('edit_page', $post_id)) { return $post_id; }
					
					//// IF USER CAN'T EDIT POST
					if(!current_user_can('edit_post', $post_id)) { return $post_id; }
					
				}
			}

			$var_detail = array(
								 WEEBY_TESTIMONY_VAR_PREFIX.'position',
								 WEEBY_TESTIMONY_VAR_PREFIX.'posted',
								 
								 WEEBY_TESTIMONY_VAR_PREFIX.'social_facebook',
								 WEEBY_TESTIMONY_VAR_PREFIX.'social_twitter',
								 WEEBY_TESTIMONY_VAR_PREFIX.'social_linkedin',
								 WEEBY_TESTIMONY_VAR_PREFIX.'social_youtube',
								 WEEBY_TESTIMONY_VAR_PREFIX.'social_google_plus',
								 
								 WEEBY_TESTIMONY_VAR_PREFIX.'ratings'
							);
			
			foreach($var_detail as $field){
				if(isset($_POST[$field])) {
					update_post_meta($post_id, $field , $_POST[$field]);
				}
			}
			
			$testimony_rating = WEEBY_TESTIMONY_VAR_PREFIX.'ratings';
			if ( !isset($_POST[$testimony_rating]) ){
				update_post_meta($post_id, $testimony_rating , 0);	
			}
			
		}
		
		
		
	}
	
	new Weeby_Testimony_Metabox_class();
 }

?>