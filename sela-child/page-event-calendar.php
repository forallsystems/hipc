<?php
/**
 * Template name: Event Calendar Template
 *
 * @package Sela
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>
			<?php query_posts( 'post_type=post&meta_key=start_date&orderby=meta_value&order=DSC',
				(           array (
			                'key'=>'start_date',
			                'value'=>date('mdY'),
			                'compare' => '='
			            )
			        )
				);
/*			$myposts = query_posts (
			    array(
			        'orderby'=>'meta_value',
			        'meta_key'=>'start_date',
			        'order'=>'DSC',

			        'meta_query'=> array(
			            array(
			                'key'=>'start_date',
			                'value'=>date('mdY'),
			                'compare' => '='
			            )
			        )

			    )
			);
			query_posts($myposts); */ ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>


			<?php endwhile; ?>

			<?php sela_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>