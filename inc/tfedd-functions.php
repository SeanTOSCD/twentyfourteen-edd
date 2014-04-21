<?php
/** ===============
 * Register EDD sidebar if EDD is activated
 */
function tfedd_widgets_init() {	
	register_sidebar( array(
		'name'          => __( 'EDD Sidebar', 'tfedd' ),
		'id'            => 'sidebar-edd',
		'description'   => __( 'Additional sidebar that appears on the right of the content on single download pages.', 'tfedd' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
if ( class_exists( 'Easy_Digital_Downloads' ) ) add_action( 'widgets_init', 'tfedd_widgets_init' );


/** ===============
 * add body class based on page templates
 */
function tfedd_body_classes( $classes ) {
	
	// add body classes based on EDD page templates
	if ( is_page_template( 'page-templates/edd-store-front.php' ) || is_post_type_archive( 'download' ) ) :		
		$classes[] = 'store-front-template';
	elseif ( is_page_template( 'page-templates/edd-checkout.php' ) ) :		
		$classes[] = 'checkout-template edd-template no-sidebar-content';	
	elseif ( is_page_template( 'page-templates/edd-confirmation.php' ) ) :		
		$classes[] = 'confirmation-template edd-template no-sidebar-content';
	elseif ( is_page_template( 'page-templates/edd-history.php' ) ) :		
		$classes[] = 'history-template edd-template no-sidebar-content';
	elseif ( is_page_template( 'page-templates/edd-members.php' ) ) :		
		$classes[] = 'members-template edd-template no-sidebar-content';
	elseif ( is_page_template( 'page-templates/edd-failed.php' ) ) :		
		$classes[] = 'failed-template edd-template no-sidebar-content';	
	endif;
		
	return $classes;
}
add_filter( 'body_class', 'tfedd_body_classes');

	
/** ===============
 * product image thumbnail size
 */
function tfedd_setup() {
	// hard crop store front and taxonomy product images for downloads
	add_image_size( 'product-img', 540, 360, true );
}
add_action( 'after_setup_theme', 'tfedd_setup' );


/** ===============
 * Allow comments on downloads
 */
function tfedd_edd_add_comments_support( $supports ) {
	$supports[] = 'comments';
	return $supports;	
}
add_filter( 'edd_download_supports', 'tfedd_edd_add_comments_support' );

	
/** ===============
 * No purchase button below download content
 */
remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );


/** ===============
 * Adjust store front/download archive excerpt length
 */
function tfedd_custom_excerpt_length( $length ) {
	return 22;
}
add_filter( 'excerpt_length', 'tfedd_custom_excerpt_length', 999 );


/** ===============
 * Replace excerpt ellipses with new ellipses only on store front/download archive
 */
function tfedd_excerpt_more( $more ) {
	if ( is_page_template( 'page-templates/edd-store-front.php' ) || is_post_type_archive( 'download' ) ) {
		return '...';
	} 
}
add_filter( 'excerpt_more', 'tfedd_excerpt_more' );