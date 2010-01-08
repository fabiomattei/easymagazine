<?php get_header(); ?>
<div id="maintop"></div><!--end maintop-->
<div id="wrapper">
	<div id="content">
		<div id="main-blog">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<div class="clear">&nbsp;</div>
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<h1><?php the_title(); ?></h1>
						<?php edit_post_link(__('Edit this page', 'shades'), __('&gt ', 'shades'), __('&lt;', 'shades')); ?>
						<?php the_content(__('Read more ...', 'shades')); ?>
				    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					</div> <!-- .post #post-ID -->
					<?php comments_template(); ?>
				<?php endwhile; ?>
			<?php else : ?>
				<h2 class="center"><?php _e('Not Found', 'shades'); ?></h2>
				<p class="center"><?php _e('Sorry, but you are looking for something that is not here.', 'shades'); ?></p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
			<?php endif; ?>
		</div><!-- #main blog -->
		<?php get_sidebar(); ?>
	</div><!-- #content -->
</div><!-- #wrapper -->
<?php get_footer();?>