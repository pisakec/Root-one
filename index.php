<?php
/*
Template Name: Homepage
*/
get_header();
?>
<h1>index</h1>
<main id="index">
	<section class="wrapper">
		<div class="content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_post_thumbnail('full', array('class' => 'news-img-lg full-width')); ?>
				<div class="entry">
					<h2 class="header-m header-500"> <?php the_title(); ?> </h2>
					<p><?php echo wp_trim_words( get_the_content(), 20, '...' ); ?> </p>
				</div>
				<a href="<?php the_permalink()?>" class="read-more btn"><i class="icon-eye"></i></a>
			</article>
			<?php endwhile; endif; ?>
		</div>
		<?php //get_sidebar(); ?>
	</section>
</main>
<?php get_footer(); ?>
