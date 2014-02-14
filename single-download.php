<?php
/**
 * The Template for displaying all single downloads
 */
get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php
				while ( have_posts() ) : the_post();
					// content for single download pages
					get_template_part( 'content/content', 'download' );
					
					if ( get_theme_mod( 'tfedd_download_comments' ) ) : // show comments on downloads?
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					endif;
				endwhile;
			?>
		</div>
	</div>
<?php
get_sidebar( 'edd' ); // replace Content Sidebar
get_sidebar();
get_footer();
