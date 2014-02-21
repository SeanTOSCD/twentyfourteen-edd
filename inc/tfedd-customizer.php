<?php
/** ===============
 * build EDD customizer options
 */
function tfedd_customize_register( $wp_customize ) {

	/** ===============
	 * Extends CONTROLS class to add textarea
	 */
	class tfedd_customize_textarea_control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() { ?>
	
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
	
	<?php
		}
	}	

	/** ===============
	 * Easy Digital Downloads Options
	 */
	// only if EDD is activated
	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		$wp_customize->add_section( 'tfedd_edd_options', array(
	    	'title'       	=> __( 'Easy Digital Downloads', 'tfedd' ),
			'description' 	=> __( 'All other EDD options are under Dashboard => Downloads.', 'tfedd' ),
			'priority'   	=> 60,
		) );
		// store front/downloads archive headline
		$wp_customize->add_setting( 'tfedd_edd_store_archives_title', array( 'default' => null ) );
		$wp_customize->add_control( 'tfedd_edd_store_archives_title', array(
			'label'		=> __( 'Store/Download Archives Main Title', 'tfedd' ),
			'section'	=> 'tfedd_edd_options',
			'settings'	=> 'tfedd_edd_store_archives_title',
			'priority'	=> 10,
		) );
		// store front/downloads archive description
		$wp_customize->add_setting( 'tfedd_edd_store_archives_description', array( 'default' => null ) );
		$wp_customize->add_control( new tfedd_customize_textarea_control( $wp_customize, 'tfedd_edd_store_archives_description', array(
			'label'		=> __( 'Store/Download Archives Description', 'tfedd' ),
			'section'	=> 'tfedd_edd_options',
			'settings'	=> 'tfedd_edd_store_archives_description',
			'priority'	=> 20,
		) ) );
		// read more link
		$wp_customize->add_setting( 'tfedd_product_view_details', array( 'default' => __( 'View Details', 'tfedd' ) ) );	
		$wp_customize->add_control( 'tfedd_product_view_details', array(
		    'label' 	=> __( 'Store Item Link Text', 'tfedd' ),
		    'section' 	=> 'tfedd_edd_options',
			'settings' 	=> 'tfedd_product_view_details',
			'priority'	=> 30,
		) );
		// store front/archive item count
		$wp_customize->add_setting( 'tfedd_store_front_count', array( 'default' => 9 ) );		
		$wp_customize->add_control( 'tfedd_store_front_count', array(
		    'label' 	=> __( 'Store Front Item Count', 'tfedd' ),
		    'section' 	=> 'tfedd_edd_options',
			'settings' 	=> 'tfedd_store_front_count',
			'priority'	=> 40,
		) );
		// show comments on downloads?
		$wp_customize->add_setting( 'tfedd_download_comments', array( 'default' => 0 ) );
		$wp_customize->add_control( 'tfedd_download_comments', array(
			'label'		=> __( 'Comments on Downloads?', 'tfedd' ),
			'section'	=> 'tfedd_edd_options',
			'priority'	=> 50,
			'type'      => 'checkbox',
		) );
	}
}
add_action( 'customize_register', 'tfedd_customize_register' );

/** ===============
 * Add Customizer UI styles to the <head> only on Customizer page
 */
function tfedd_customizer_styles() { ?>
	<style type="text/css">
		#customize-control-tfedd_store_front_count input[type="text"] { width: 50px; }
	</style>
<?php }
add_action('customize_controls_print_styles', 'tfedd_customizer_styles');