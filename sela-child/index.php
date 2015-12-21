<?php

/**
 * Template Name: Home
 */

get_header(); 

?>

<div id="primary">
	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<h1><?php the_field('event_name'); ?></h1>
			<strong>Single or Multi Day: </strong><?php the_field('single_or_multi_day'); ?></p>
			<strong>Start Date: </strong><?php the_field('start_date'); ?></p>
			<?php

			if(get_field('end_date'))
			{
				echo '<strong>End Date: </strong>' . get_field('end_date') . '</p>';
			}

			?>
			<strong>Event Description: </strong><?php the_field('event_description'); ?></p>
			<strong>Start Time: </strong><?php the_field('start_time'); ?></p>
			<strong>End Time: </strong><?php the_field('end_time'); ?></p>
			<strong>Cost: $</strong><?php the_field('cost'); ?></p>
			<strong>Location: </strong><?php the_field('location'); ?></p>
			<strong>Notes: </strong><?php the_field('notes'); ?></p>

			<p><?php the_content(); ?></p>

		<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>