/**
 * @package     Weeby Grid Testimonial Addons - WPBakery Page Builder
 * @Version: 	1.0.0
 * @author      Weeby
 * @copyright   Copyright (c) 2018, Weeby Themes & Plugins
 *
 */
 
 
var WEEBY_TESTIMONY = {
	
	appear_elem : function (){
		weeby_testmonial_elem = jQuery('.weeby-tstmnl-wrap');
		if (weeby_testmonial_elem.length>0){
			var wscroll = jQuery(window).scrollTop();
			var show_here = jQuery('.weeby-tstmnl-wrap').offset().top - (jQuery(window).height() / 1.5 );
			if ( wscroll > show_here ){
				weeby_testmonial_elem.addClass('loaded');
			}else{
				weeby_testmonial_elem.removeClass('loaded');
			}
		}
	}
}
jQuery(function (){
	
	jQuery(window).scroll( function(){ 
		WEEBY_TESTIMONY.appear_elem();
	});
	WEEBY_TESTIMONY.appear_elem();
	
});