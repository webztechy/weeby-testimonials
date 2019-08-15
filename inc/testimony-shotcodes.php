<?php
 /**
 * Call shortcode class and functions
 *
 */
 if( !class_exists('Weeby_Testimony_Shortcodes_class') ) {
	 

	class Weeby_Testimony_Shortcodes_class{	

		public function __construct() {
			add_shortcode('weeby_testimonials', array($this, 'weeby_testimonial_func') );
		}
		
		public function weeby_testimonial_func($atts, $content) {
			extract( shortcode_atts( array('taxonomy_category'=>'', 'style_layout'=>'', 'list_style'=>'', 'list_style_cols'=>'', 'no_of_posts'=>'', 'sort_date'=>'' ), $atts ));

			if (empty($sort_date)){ $sort_date = 'DESC'; }
			if (empty($style_layout)){ $style_layout = 'grid'; }
			if (empty($list_style)){ $list_style = 'one'; }
			if (empty($list_style_cols)){ $list_style_cols = 'two'; }
			if (empty($no_of_posts)){ $no_of_posts = 6; }

			
			$args = array(
				'post_type'		 => WEEBY_POST_TYPE_TESTIMONY,
				
				'meta_key'       =>  WEEBY_TESTIMONY_VAR_PREFIX.'posted', 
				'orderby'        =>  WEEBY_TESTIMONY_VAR_PREFIX.'posted', 
				'order'          =>  $sort_date ,
				'posts_per_page' => $no_of_posts,
				'paged' 		 => 1,
				'post_status'    => 'publish'
			);
			
			if (!empty($taxonomy_category) || $taxonomy_category!=0 ){
				$args['tax_query'] = array(
									   array(
												'taxonomy' => WEEBY_TESTIMONY_TAXONOMY_NAME,
												'field'	   => 'slug', 
												'terms'    => $taxonomy_category
											)
									);
			}
			
			
			
			$str =  '<div class="weeby-testimonial weeby-tstmnl-wrap">
						<div class="weeby-tstmnl-list col-'.$list_style_cols.' style-grid-'.$list_style.' weeby-testimonial-layout-'.$style_layout.'">
					';
					$the_query = new WP_Query( $args );
					if ( $the_query->have_posts() ) {	
						
						while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$testimony_id = get_the_ID();
						$testimony_name = get_the_title();
						$testimony_name = ucwords( strtolower($testimony_name) );
							
							$testimony_message = get_the_excerpt();
							
							$testimony_position = get_post_meta($testimony_id, WEEBY_TESTIMONY_VAR_PREFIX.'position', true);
							$testimony_position = ucwords( strtolower($testimony_position) );
							
							$testimony_posted = get_post_meta($testimony_id, WEEBY_TESTIMONY_VAR_PREFIX.'posted', true);
							if (!empty($testimony_posted) ){
								$testimony_posted = date('d M Y',  strtotime($testimony_posted) );
							}
							
							$social_facebook = get_post_meta($testimony_id, WEEBY_TESTIMONY_VAR_PREFIX.'social_facebook', true);
							$social_twitter = get_post_meta($testimony_id, WEEBY_TESTIMONY_VAR_PREFIX.'social_twitter', true);
							$social_linkedin = get_post_meta($testimony_id, WEEBY_TESTIMONY_VAR_PREFIX.'social_linkedin', true);
							$social_youtube = get_post_meta($testimony_id, WEEBY_TESTIMONY_VAR_PREFIX.'social_youtube', true);
							$social_google_plus = get_post_meta($testimony_id, WEEBY_TESTIMONY_VAR_PREFIX.'social_google_plus', true);
							
									
								// Social Network Sites
								$socal_netword_sites_url = '';
								if ( !empty($social_facebook) ){
									$socal_netword_sites_url .= '<a href="'.$social_facebook.'" class="facebook" target="_blank"><span class="fa fa-facebook-f"></span></a>';
								}
								if ( !empty($social_twitter) ){
									$socal_netword_sites_url .= '<a href="'.$social_twitter.'" class="twitter" target="_blank"><span class="fa fa-twitter"></span></a>';
								}
								if ( !empty($social_linkedin) ){
									$socal_netword_sites_url .= '<a href="'.$social_linkedin.'" class="linkedin" target="_blank"><span class="fa fa-linkedin"></span></a>';
								}
								if ( !empty($social_youtube) ){
									$socal_netword_sites_url .= '<a href="'.$social_youtube.'" class="youtube" target="_blank"><span class="fa fa-youtube"></span></a>';
								}
								if ( !empty($social_google_plus) ){
									$socal_netword_sites_url .= '<a href="'.$social_google_plus.'" class="google" target="_blank"><span class="fa fa-google-plus"></span></a>';
								}
									
									
							$testimony_ratings = get_post_meta($testimony_id, WEEBY_TESTIMONY_VAR_PREFIX.'ratings', true);
							
							$testimony_image = Weeby_Testimony_Utilities_class::defaut_image();
							if ( has_post_thumbnail() ) {
								$testimony_image = wp_get_attachment_url( get_post_thumbnail_id($testimony_id), WEEBY_TESTIMONY_VAR_PREFIX.'profile_image_md' );
							}
							 
							ob_start();	
							$template_dir = WEEBY_TESTIMONY_DIR.'view/testimonies/style-'.$list_style.'.php';
							include($template_dir);
							$str .= ob_get_contents();
							ob_end_flush();
						}
						
						ob_get_clean();
						
					}
					

			$str .= '	</div>
					 </div>';
				
				
				if ($style_layout=='slider'){
					$col_item_num = Weeby_Testimony_Utilities_class::testimonial_column_list($list_style_cols);
					$str .= '<script>
								jQuery(function (){
									jQuery(".weeby-testimonial-layout-slider").slick({
										dots: true,
										infinite: false,
										speed: 500,
										slidesToShow: '.$col_item_num.',
										slidesToScroll: 1,
										responsive: [{
											breakpoint: 1400,
											settings: {
												slidesToShow: '.$col_item_num.',
												slidesToScroll: 1,
												infinite: true,
												dots: true
											}
										},{
											breakpoint: 990,
											settings: {
												slidesToShow: 2,
												slidesToScroll: 1,
												infinite: true,
												dots: true
											}
										}, {
											breakpoint: 668,
											settings: {
												slidesToShow: 2,
												slidesToScroll: 1
											}
										}, {
											breakpoint: 568,
											settings: {
												slidesToShow: 1,
												slidesToScroll: 1
											}
										}]
									});
								});
								</script>';
				}
							
			echo $str;
			
			return ob_get_clean();
		}


	}
	
	new Weeby_Testimony_Shortcodes_class();
 }

?>