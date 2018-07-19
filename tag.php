<?php

get_header();
?>
<h1>Tag</h1>
<main id="category">
	<section class="wrapper has-sidebar">
		<div class="content sidebar">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>					
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>				
				<a href="<?php the_permalink()?>" class=""><?php the_post_thumbnail('full', array('class' => 'news-img-lg col-30')); ?></a>
					<div class="entry">
						<h2 class="header-m header-500"><a href="<?php the_permalink()?>" class=""><?php the_title(); ?></a> </h2>
						<p><?php echo wp_trim_words( get_the_content(), 40, '...' ); ?> </p>
					</div>
					<a href="<?php the_permalink()?>" class="read-more btn"><i class="icon-eye"></i></a>
				</article>
			   <?php endwhile; endif; ?>
		</div>
		<?php get_sidebar(); ?>
	</section>
</main>
<?php get_footer(); ?>