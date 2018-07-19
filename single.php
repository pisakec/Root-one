<?php get_header(); ?>


<h1>Single</h1>
<main id="single">
	<section class="content">
		<div class="wrapper">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>			
			<h2 class="header-m header-500"> <?php the_title(); ?> </h2>
				<div class="entry">				
					<?php the_content(); ?>
				</div>
			</article>
			<?php endwhile; endif; ?>
		</div>
		<?php //get_sidebar(); ?>
	</section>
</main>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>


