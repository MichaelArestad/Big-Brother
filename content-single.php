<?php
/**
 * @package big-brother
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php big_brother_posted_on(); ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'big-brother' ) );

				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', __( ', ', 'big-brother' ) );

				if ( ! big_brother_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( '<span class="entry-tags">%2$s</spam>', 'big-brother' );
					} else {
						$meta_text = __( '', 'big-brother' );
					}

				} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( '<span class="entry-categories">%1$s</span><span class="entry-tags">%2$s</span>', 'big-brother' );
					} else {
						$meta_text = __( '<span class="entry-categories">%1$s</span>', 'big-brother' );
					}

				} // end check for categories on this blog

				printf(
					$meta_text,
					$category_list,
					$tag_list,
					get_permalink()
				);
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'big-brother' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php edit_post_link( __( 'Edit', 'big-brother' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
