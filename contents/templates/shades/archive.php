<?php get_header(); ?>
<div id="maintop"></div><!--end maintop-->
<div id="wrapper">
	<div id="content">
		<div id="main-blog">
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post(); ?>

					<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
						<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent Link to', 'shades'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						<div class="postdata">
							<?php _e('Posted by ', 'shades'); ?><?php the_author() ?><?php _e(' on ', 'shades');?><?php the_time('M j, Y') ?><?php _e(' in ', 'shades');?><?php the_category(', ') ?> <?php edit_post_link(__('Edit', 'shades'), __('&#124; ', 'shades'), __('', 'shades')); ?>
						</div>
						<div class="post-comments">
							<?php comments_popup_link(__('No Comments', 'shades'), __('1 Comment', 'shades'), __('% Comments', 'shades'), '',__('Closed', 'shades')); ?>
						</div>
						<?php the_excerpt(__('Read more... ', 'shades')); ?>
						<p class="tags"><?php the_tags(); ?></p>
					</div> <!-- .post #post-ID -->

				<?php endwhile; ?>
		  
					<div id="nav-global" class="navigation">
						<div class="left">
							<?php next_posts_link(__('&laquo; Previous entries ', 'shades')); ?>
						</div>
						<div class="right">
							<?php previous_posts_link(__(' Next entries &raquo;', 'shades')); ?>
						</div>
					</div>
					
			<?php else : ?>
			
				<h2 class="center"><?php _e('Not Found', 'shades'); ?></h2>
				<p class="center"><?php _e('Sorry, but you are looking for something that is not here.', 'shades'); ?></p>
				<?php include (TEMPLATEPATH . "/searchform.php"); ?>
				
			<?php endif; ?>
		</div><!--end main blog-->
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div><!--end content-->
</div><!--end wrapper-->
<?php get_footer();?>