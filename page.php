<?php get_header(); ?>

<h1>Page</h1>
<main id="page">
	<section class="content">
		<div class="wrapper">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php the_post_thumbnail('full', array('class' => 'news-img-lg full-width')); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php //the_post_thumbnail('full', array('class' => 'news-img-lg full-width')); ?>
				<h2 class="header-m header-500">
					<?php the_title(); ?>
				</h2>
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
