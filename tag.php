<?php

get_header();
?>
<main class="isflex category-page">
<?php get_sidebar(); ?>
<section class="content">

<h1><?php single_cat_title(''); ?></h1>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
<?php static $count = 0; if ($count == "20") { break; } else { ?>
				
				<article>
				<a href="<?php the_permalink() ?>" rel="bookmark">
					<div class="entry">
						<h3>
							<?php the_title(); ?>
						</h3>
						<div class="img-crop">
						<?php if(get_option( 'thumbnail_size_w')> 100 && get_option('thumbnail_crop') == 1) { the_post_thumbnail('full'); }else{ the_post_thumbnail(array(100,100)); } ?>
						
						</div>
<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
					</div>
					</a>
				</article>
				<?php $count++; } ?>

				<?php endwhile; endif; ?>
					<?php echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="20" category="amateur" pause="true" scroll="false" transition="fade" images_loaded="true" button_label="Show More Videos" button_loading_label="Loading Videos"]'); ?>
</section>





</main>
<?php get_footer(); ?>