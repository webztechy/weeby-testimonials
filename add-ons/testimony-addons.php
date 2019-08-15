<?php
 /**
 * Add add-on to visual studio
 *
 */
if( !class_exists('WEEBY_testimonial_class') ) {

	define('weeby_plugin_name_testimonial', 'Weeby Widgets' );
	
	class WEEBY_testimonial_class{	
	
		var $testimony_categories = array();
		
		public function __construct() {
			add_action('init',  array($this,'push_js_option') );
		}
		
		
		public function push_js_option(){
			
			$categories_array = get_terms(WEEBY_TESTIMONY_TAXONOMY_NAME, array('hide_empty' => 0, 'parent' =>0) );
			
			$categories_array_list = array();
			$categories_array_list[0] =  'All Categories';
			if (count($categories_array)>0){
				foreach($categories_array as $cat){
					$key_name = $cat->name;
					$categories_array_list[$key_name] =  $cat->slug;
				}
			}

			vc_map( array(
			   "name" => __("Weeby Testimonial", weeby_plugin_name_testimonial),
			   "description" => __( 'A list of testimony posts.', weeby_plugin_name_testimonial ),
			   "base" => "weeby_testimonials",
			   "class" => "",
			   "icon" => '',
			   "category" => weeby_plugin_name_testimonial,
			   "params" => array(
								
								array(
									"type" => "dropdown",
									"heading" => __("Category", weeby_plugin_name_testimonial),
									"param_name" => "taxonomy_category",
									"value" => $categories_array_list,												
									"description" => __("Select your category.",  weeby_plugin_name_testimonial),
									"admin_label" => true
								),
								
								array(
									"type" => "dropdown",
									"heading" => __("Style Layout", weeby_plugin_name_testimonial),
									"param_name" => "style_layout",
									"value" => array(
													__( "Grid",  weeby_plugin_name_testimonial )	=>	'grid',
													__( "Slider",  weeby_plugin_name_testimonial )	=>	'slider',
												),
													
									"description" => __("Select layout style.",  weeby_plugin_name_testimonial),
									"admin_label" => true
								),

								array(
									"type" => "dropdown",
									"heading" => __("Style Available", weeby_plugin_name_testimonial),
									"param_name" => "list_style",
									"value" => array(
													__( "Style One",  weeby_plugin_name_testimonial )	=>	'one',
													__( "Style Two",  weeby_plugin_name_testimonial )	=>	'two',
													__( "Style Three",  weeby_plugin_name_testimonial )	=>	'three',
													__( "Style Four",  weeby_plugin_name_testimonial )	=>	'four',
													__( "Style Five",  weeby_plugin_name_testimonial )	=>	'five',
													__( "Style Six",  weeby_plugin_name_testimonial )	=>	'six',
													__( "Style Seven",  weeby_plugin_name_testimonial )	=>	'seven',
													__( "Style Eight",  weeby_plugin_name_testimonial )	=>	'eight',
													__( "Style Nine",  weeby_plugin_name_testimonial )	=>	'nine',
													__( "Style Ten",  weeby_plugin_name_testimonial )	=>	'ten',
													__( "Style Eleven",  weeby_plugin_name_testimonial )=>	'eleven'
												),
													
									"description" => __("Select list style.",  weeby_plugin_name_testimonial),
									"admin_label" => true
								),
								
								array(
									"type" => "dropdown",
									"heading" => __("No. of Columns", weeby_plugin_name_testimonial),
									"param_name" => "list_style_cols",
									"value" => array(
													__( "Two Columns", 	 weeby_plugin_name_testimonial )	=>	'two',
													__( "Three Columns",  weeby_plugin_name_testimonial )	=>	'three',
													__( "Four Columns",  weeby_plugin_name_testimonial )	=>	'four',
												),
													
									"description" => __("Select number of columns.",  weeby_plugin_name_testimonial),
									"admin_label" => true
								),
								
								array(
									"type" => "textfield",
									"heading" => __("No. of post to show", weeby_plugin_name_testimonial),
									"param_name" => "no_of_posts",
									"value" => '',			
									"description" => __("Enter number of post to show.( -1 All testimonies )",  weeby_plugin_name_testimonial),
									"admin_label" => true
								),
								
								array(
									"type" => "dropdown",
									"heading" => __("Sort Date", weeby_plugin_name_testimonial),
									"param_name" => "sort_date",
									"value" => array(
													__( "Latest to oldest",  weeby_plugin_name_testimonial )	=>	'DESC',
													__( "Oldest to latest",  weeby_plugin_name_testimonial )	=>	'ASC',
												),
															
									"description" => __("Select asc or desc",  weeby_plugin_name_testimonial),
									"admin_label" => true
								),
				  
							)
							
			 ));
			 
		}
		
	}
	
	new WEEBY_testimonial_class;


}

?>
