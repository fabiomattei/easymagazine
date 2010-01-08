<?php // Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die (__('Please do not load this page directly. Thanks!', 'shades'));
if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'shades'); ?></p>
<?php
	return;
}

// add a microid to all the comments
function comment_add_microid($classes) {
	$c_email=get_comment_author_email();
	$c_url=get_comment_author_url();
	if (!empty($c_email) && !empty($c_url)) {
		$microid = 'microid-mailto+http:sha1:' . sha1(sha1('mailto:'.$c_email).sha1($c_url));
		$classes[] = $microid;
	}
	return $classes;	
}
add_filter('comment_class','comment_add_microid');

/* add a userid (if exists) to all the comments */
function comment_add_userid($classes) {
	global $comment;
	if ($comment->user_id == 1 ) { /* Administrator */
		$userid = "administrator user-id-1";
	} else { /* All other users - NB: user-id-0 -> non-registered user */
		$userid = "user-id-" . ($comment->user_id);
	}
	$classes[] = $userid;
	return $classes;	
}
add_filter('comment_class','comment_add_userid');
?>

<div id="comments-main">
<?php // show the comments
	if ( have_comments() ) : ?>
    
		<h4 id="comments"><?php comments_number(__('No Comments', 'shades'), __('One Comment', 'shades'), __('% Comments', 'shades') );?></h4>
		<ul class="commentlist" id="singlecomments">
			<?php wp_list_comments(array('avatar_size'=>60, 'reply_text'=>__('&raquo; Reply to this Comment &laquo;', 'shades'))); ?>
		</ul>
		<div class="navigation">
    		<div class="alignleft"><?php previous_comments_link() ?></div>
		    <div class="alignright"><?php next_comments_link() ?></div>
		</div>
      
	<?php else : // this is displayed if there are no comments so far ?>

		<?php if ('open' == $post->comment_status) :
			// If comments are open, but there are no comments.
		else : 
			// comments are closed 
		endif;
	
	endif; 

	if ('open' == $post-> comment_status) : 
		// show the form
		?>
  
		<div id="respond"><h3><?php comment_form_title(); ?></h3>
			<div id="cancel-comment-reply">
				<small><?php cancel_comment_reply_link(); ?></small>
			</div>

			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

				<p><?php _e('You must be ', 'shades'); ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e('logged in', 'shades'); ?></a> <?php _e('to post a comment.', 'shades'); ?></p>

			<?php else : ?>

				<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

					<?php if ( $user_ID ) : ?>

						<p><?php _e('Logged in as', 'shades'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.
						<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="<?php _e('Log out of this account', 'shades'); ?>"><?php _e('Logout &raquo;', 'shades'); ?></a></p>

					<?php else : ?>

						<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
						<label for="author"><small><?php _e('Name', 'shades'); ?> <?php if ($req) _e('(required)', 'shades'); ?></small></label></p>
						<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
						<label for="email"><small><?php _e('Email', 'shades'); ?> <?php if ($req) _e('(required)', 'shades'); ?></small></label></p>
						<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
						<label for="url"><small><?php _e('Website', 'shades'); ?></small></label></p>

					<?php endif; ?>

					<div>
						<?php comment_id_fields(); ?>
						<input type="hidden" name="redirect_to" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" />
					</div>

					<p><small><strong>XHTML:</strong> <?php _e('You can use these tags:', 'shades'); ?>' <?php echo allowed_tags(); ?></small></p>

					<p><textarea name="comment" id="comment" cols="10" rows="10" tabindex="4"></textarea></p>

					<?php if (get_option("comment_moderation") == "1") { ?>
						<p><small><strong><?php _e('Please note:', 'shades'); ?></strong> <?php _e('Comment moderation is enabled and may delay your comment. There is no need to resubmit your comment.', 'shades'); ?></small></p>
					<?php } ?>

					<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" /></p>
					<?php do_action('comment_form', $post->ID); ?>

				</form>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div> <!-- #comments-main -->