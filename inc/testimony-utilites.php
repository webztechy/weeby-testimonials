<?php
 /**
 * Call utilities class and functions
 *
 */
 if( !class_exists('Weeby_Testimony_Utilities_class') ) {
	 

	class Weeby_Testimony_Utilities_class{	

		public function __construct() {
			
			add_action( 'admin_enqueue_scripts', array($this, 'load_weeby_testimonial_wp_admin_style') );
			add_action( 'wp_enqueue_scripts', array($this, 'load_weeby_testimonial_wp_frontend_style') );
			
			add_filter( 'gettext', array($this, 'replace_box_label_title') , 10, 2 );
			
			add_filter('manage_'.WEEBY_POST_TYPE_TESTIMONY.'_posts_columns' , array($this, 'custom_column_post') );
			add_action('manage_'.WEEBY_POST_TYPE_TESTIMONY.'_posts_custom_column', array($this, 'get_custom_column_post'), 10, 2);

			add_action( 'restrict_manage_posts', array($this,'filter_by_taxonomies') , 10, 2);

			self::creating_thumbnails();
			
		}
		
		public function load_weeby_testimonial_wp_admin_style(){
			wp_register_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
			wp_enqueue_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-fontawesome' );
			
			wp_register_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-testimonial', WEEBY_TESTIMONY_URL.'assets/css/style-weeby-testimonial.css');
			wp_enqueue_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-testimonial' );
		}
		
		public function load_weeby_testimonial_wp_frontend_style(){
			
			wp_register_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
			wp_enqueue_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-fontawesome' );
			
			wp_register_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-slick-slider', WEEBY_TESTIMONY_URL.'assets/slick/slick.css');
			wp_enqueue_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-slick-slider' );
			
			wp_register_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-slick-slider-theme', WEEBY_TESTIMONY_URL.'assets/slick/slick-theme.css');
			wp_enqueue_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-slick-slider-theme' );
			
			wp_register_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-testimonial-front', WEEBY_TESTIMONY_URL.'assets/css/style-weeby-testimonial-front.css');
			wp_enqueue_style( WEEBY_POST_TYPE_TESTIMONY.'-style-weeby-testimonial-front' );	
			
			wp_enqueue_script( WEEBY_POST_TYPE_TESTIMONY.'-js-weeby-slick-slider', WEEBY_TESTIMONY_URL.'assets/slick/slick.js', array ( 'jquery' ), 1.1, false);
			wp_enqueue_script( WEEBY_POST_TYPE_TESTIMONY.'-js-weeby-testimonial-front', WEEBY_TESTIMONY_URL.'assets/js/weeby-testimonial.js', array ( 'jquery' ), 1.1, true);
				
		}
		

		public function creating_thumbnails() {
			add_image_size( WEEBY_TESTIMONY_VAR_PREFIX.'profile_image_md', 110, 110, true ); // Hard Crop Mode
			add_image_size( WEEBY_TESTIMONY_VAR_PREFIX.'profile_image_lg', 217, 217, true ); // Hard Crop Mode
		}
		
		public function replace_box_label_title( $translation, $original ){
			$current_post_type = get_post_type();
			if ($current_post_type==WEEBY_POST_TYPE_TESTIMONY){
				if ( 'Excerpt' == $original ) {
					return '<span class="fa fa-comments-o"></span>  Testimony / Comment';
				}else{
					$pos = strpos($original, 'Excerpts are optional hand-crafted summaries of your');
					if ($pos !== false) {
						return  'Summary, comment, suggestion of the person.';
					}
				}
			}
			return $translation;
		}
		
		public function custom_column_post($columns){
			$custom_columns = array(
									'title'										=> __('Person / Client Name', WEEBY_TESTIMONY_PLUGIN_NAME ),
									WEEBY_TESTIMONY_VAR_PREFIX.'category'		=> __('Categories', WEEBY_TESTIMONY_PLUGIN_NAME ),
									WEEBY_TESTIMONY_VAR_PREFIX.'position'		=> __('Position / Industry', WEEBY_TESTIMONY_PLUGIN_NAME ),
									WEEBY_TESTIMONY_VAR_PREFIX.'posted'			=> __('Testimony Date', WEEBY_TESTIMONY_PLUGIN_NAME ),
									WEEBY_TESTIMONY_VAR_PREFIX.'ratings'		=> __('Ratings', WEEBY_TESTIMONY_PLUGIN_NAME ),
									'date'										=> __('Date', WEEBY_TESTIMONY_PLUGIN_NAME )
								);
			
			unset($columns['title']);
			unset($columns['date']);
			$table_columns = array_merge($columns, $custom_columns);
			return $table_columns;
		}
		
		public function get_custom_column_post( $column, $post_id  ) {
			global $wpdb;
			
			switch ( $column ) {
				case WEEBY_TESTIMONY_VAR_PREFIX.'category' : 
						$terms = get_the_terms( $post_id, WEEBY_TESTIMONY_TAXONOMY_NAME );
                        
						$taxonomies = '';
						if ( $terms && ! is_wp_error( $terms ) ){
							$taxonomies_links = array();
						 
							foreach ( $terms as $term ) {
								$taxonomies_links[] = $term->name;
							}				 
							$taxonomies = join( ", ", $taxonomies_links );
						}
						
						echo $taxonomies;
						
					break;
				case WEEBY_TESTIMONY_VAR_PREFIX.'position' : 
						echo get_post_meta($post_id, WEEBY_TESTIMONY_VAR_PREFIX.'position' , true);
					break;
				
				case WEEBY_TESTIMONY_VAR_PREFIX.'posted' : 
						$testimony_date = get_post_meta($post_id, WEEBY_TESTIMONY_VAR_PREFIX.'posted' , true);
						echo date('d M Y', strtotime($testimony_date) );
					break;
					
				case WEEBY_TESTIMONY_VAR_PREFIX.'ratings' : 
						$testimony_ratings = get_post_meta($post_id, WEEBY_TESTIMONY_VAR_PREFIX.'ratings' , true);
						echo Weeby_Testimony_Utilities_class::show_star_ratings($testimony_ratings);
					break;
				
			}	
		}
		
		
		public function filter_by_taxonomies( $post_type, $which ) {

			// A list of taxonomy slugs to filter by
			$taxonomies = array( WEEBY_TESTIMONY_TAXONOMY_NAME );

			foreach ( $taxonomies as $taxonomy_slug ) {

				// Retrieve taxonomy data
				$taxonomy_obj = get_taxonomy( $taxonomy_slug );
				$taxonomy_name = $taxonomy_obj->labels->name;

				// Retrieve taxonomy terms
				$terms = get_terms( $taxonomy_slug );

				// Display filter HTML
				echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
				echo '<option value="">' . sprintf( esc_html__( 'Show All %s', 'text_domain' ), $taxonomy_name ) . '</option>';
				foreach ( $terms as $term ) {
					printf(
						'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
						$term->slug,
						( ( isset( $_GET[$taxonomy_slug] ) && ( $_GET[$taxonomy_slug] == $term->slug ) ) ? ' selected="selected"' : '' ),
						$term->name,
						$term->count
					);
				}
				echo '</select>';
			}

		}
		
		public function testimonial_column_list($num = null){
			$col = 3;
			if ( !is_null($num) ){
				$col_array = array('one'=>1,'two'=>2,'three'=>3,'four'=>4);
				if (array_key_exists($num, $col_array)){
					$col = $col_array[$num];
				}
			}
			
			return $col;
		}
		
		public function show_star_ratings($num){
			$range = range(1, 5);
			$str = '';
			foreach($range as $inc){
				$star_class = '';
				if ($inc>$num){ $star_class = '-o';}
				$str .= '<span class="star-value"><i class="fa fa-star'.$star_class.'"></i></span>';
			}
			return $str;
		}
		
		public function defaut_image(){
			$default_image = WEEBY_TESTIMONY_URL.'assets/img/default-image.jpg';
			return $default_image;
		}

	}
	
	new Weeby_Testimony_Utilities_class();
 }

?>