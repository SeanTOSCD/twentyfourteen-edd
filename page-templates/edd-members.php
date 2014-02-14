<?php
/*
 * Template Name: EDD Members
 */
get_header(); ?>
	<div id="main-content" class="main-content">
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header>' ); ?>
						<div class="entry-content">
							<?php the_content(); ?>
							<?php echo do_shortcode( '[purchase_history]' ); ?>		
							<?php echo do_shortcode( '[edd_profile_editor]' ); ?>
							<?php edit_post_link( __( 'Edit', 'tfedd' ), '<span class="edit-link">', '</span>' ); ?>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
<?php
get_sidebar();
get_footer();