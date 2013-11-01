<?php
/**
 * The Template for displaying all single posts.
 *
 * @package big-brother
 */

get_header(); ?>

	<div class="primary content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<div class="article-wrapper">
				<?php get_template_part( 'content', 'single' ); ?>
			</div>

			<?php big_brother_content_nav( 'nav-below' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>