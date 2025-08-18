<?php

// more widgets in the (near) future...

// Register widgetized locations
if(  !function_exists('montoya_widgets_init') ){

    function montoya_widgets_init(){

		$args = 			array( 'name'		=> esc_html__( 'Blog Sidebar', 'montoya' ),
								'id'           	=> 'montoya-blog-sidebar',
								'description'  	=> '',
								'class'        	=> '',
								'before_widget'	=> '<div id="%1$s" class="widget clapat-sidebar-widget %2$s">',
								'after_widget'  => '</div>',
								'before_title'  => '<h6 class="widgettitle clapat-widgettitle">',
								'after_title'   => '</h6>' );
		
		register_sidebar( $args );
		
		if( function_exists( "is_woocommerce" ) ){
			
			$args = 			array( 'name'		=> esc_html__( 'Shop Sidebar', 'montoya' ),
									'id'           	=> 'montoya-shop-sidebar',
									'description'  	=> '',
									'class'        	=> '',
									'before_widget'	=> '<div id="%1$s" class="widget clapat-shop-sidebar-widget %2$s">',
									'after_widget'  => '</div>',
									'before_title'  => '<h6 class="widgettitle clapat-shop-widgettitle">',
									'after_title'   => '</h6>' );
			
			register_sidebar( $args );
		}
		        
    }
}

add_action( 'widgets_init', 'montoya_widgets_init' );

?>