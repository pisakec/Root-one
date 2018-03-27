<?php

get_header();
?>
<h1>Category</h1>
<main id="category">
	<section class="wrapper has-sidebar">
		<div class="content sidebar">
			<?php the_post_thumbnail('full', array('class' => 'news-img-lg full-width')); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h2 class="header-m header-500">
					<?php the_title(); ?>
				</h2>
				<div class="entry">
					<?php the_content(); ?>
				</div>
				<a href="<?php the_permalink()?>" class="read-more btn">read more</a>
			</article>
			<?php endwhile; endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</section>
</main>
<?php get_footer(); ?>