<?php
/**
 * @package big-brother
 */
?>

<div class="article-wrapper">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php big_brother_posted_on(); ?>

					<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'big-brother' ) );
						if ( $categories_list && big_brother_categorized_blog() ) :
					?>
					<?php printf( __( '<span class="entry-categories">%1$s</span>', 'big-brother' ), $categories_list ); ?>
					<?php endif; // End if categories ?>

					<?php
						/* translators: used between list items, there is a space after the comma */
						$tags_list = get_the_tag_list( '', __( ', ', 'big-brother' ) );
						if ( $tags_list ) :
					?>
					<?php printf( __( '<span class="entry-tags">%1$s</span>', 'big-brother' ), $tags_list ); ?>
					<?php endif; // End if $tags_list ?>
				<?php endif; // End if 'post' == get_post_type() ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'big-brother' ) ); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'big-brother' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'big-brother' ), __( '1 Comment', 'big-brother' ), __( '% Comments', 'big-brother' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'big-brother' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post-## -->
</div>