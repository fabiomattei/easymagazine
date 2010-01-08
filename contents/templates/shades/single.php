<?php get_header(); ?>
<div id="maintop"></div>
<div id="wrapper">
	<div id="content">
		<div id="main-blog">

			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>
					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'shades'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						<div class="postdata">
							<?php _e('Posted by ', 'shades'); ?><?php the_author() ?><?php _e(' on ', 'shades');?><?php the_time('M j, Y') ?><?php _e(' in ', 'shades');?><?php the_category(', ') ?> <?php edit_post_link(__('Edit', 'shades'), __('&#124; ', 'shades'), __('', 'shades')); ?> | <a class="rss" href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Subscribe to my feed', 'shades'); ?>"><?php _e('Subscribe', 'shades'); ?></a>          
						</div>
						<?php the_content(__('Read more ...', 'shades')); ?>
				    <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
						<div id="author_link"><?php _e('... other posts by ', 'shades'); ?><?php the_author_posts_link(); ?></div>
						<p class="tags"><?php the_tags(); ?></p>
					</div> <!-- .post #post-ID -->
					<?php comments_template(); ?>
				<?php endwhile; ?>
			<?php else : ?>
				<h2 class="center"><?php _e('Not Found', 'shades'); ?></h2>
				<p class="center"><?php _e('Sorry, but you are looking for something that is not here.', 'shades'); ?></p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
			<?php endif; ?>

		</div><!--end main blog-->
		<?php get_sidebar(); ?>
	</div><!--end content-->
</div><!--end wrapper-->
<?php get_footer();?>