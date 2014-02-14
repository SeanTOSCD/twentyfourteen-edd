<?php
/**
 * download taxonomies template... matches the store front template
 * all changes made here should also be made to the store front template
 * found at - content/content-store-front.php
 */
?>

<div id="main-content" class="main-content">
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) : $i = 1; ?>
			<div class="store-info">
				<?php if ( get_theme_mod( 'tfedd_edd_store_archives_title' ) ) : ?>
					<h1 class="store-title"><?php echo get_theme_mod( 'tfedd_edd_store_archives_title' ); ?></h1>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'tfedd_edd_store_archives_description' ) ) : ?>
					<div class="store-description">
						<?php echo wpautop( get_theme_mod( 'tfedd_edd_store_archives_description' ) ); ?>
					</div>
				<?php endif; ?>
			</div>
			<div id="store-grid" class="store-front clear-tfedd">
				<?php while ( have_posts() ) : the_post(); ?>
					
					<div class="threecol product">
						<div class="product-image">
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'product-img' ); ?>
								</a>
							<?php } ?>
						</div>
						<div class="product-description">
							<a class="product-title" href="<?php the_permalink(); ?>">
								<h3><?php the_title(); ?></h3>
							</a>
							<div class="product-info">
								<?php the_excerpt(); ?>
							</div>
						</div>
						<?php if ( get_theme_mod( 'tfedd_product_view_details' ) ) : ?>
							<a class="view-details" href="<?php the_permalink(); ?>"><?php echo get_theme_mod( 'tfedd_product_view_details' ); ?></a>
						<?php endif; ?>
					</div>
		
					<?php $i+=1; ?>
				<?php endwhile; ?>
			</div>			
			<div class="store-pagination">
				<?php 					
					$big = 999999999; // need an unlikely intege					
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, $current_page ),
						'total' => $wp_query->max_num_pages
					) );
				?>
			</div>
		<?php else : ?>
		
			<h2 class="center"><?php _e( 'Not Found', 'tfedd' ); ?></h2>
			<p class="center"><?php _e( 'Sorry, but you are looking for something that isn\'t here.', 'tfedd' ); ?></p>
			<?php get_search_form(); ?>
		
		<?php endif; ?>
		</div>
	</div>
</div>