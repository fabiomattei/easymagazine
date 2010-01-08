<?php

// Make theme available for translation
// Translations can be filed in the /languages/ directory

load_theme_textdomain( 'shades', TEMPLATEPATH . '/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);

// Get the page number
function get_page_number() {
    if ( get_query_var('paged') ) {
        print ' | ' . __( 'Page ' , 'shades') . get_query_var('paged');
    }
} // end get_page_number

if ( function_exists('register_sidebar') )

  register_sidebars(2,array(
      'before_widget' => '<div class="widget">',
      'after_widget' => '</div><!--/widget-->',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',
      ));

function show_avatar($comment, $size)
  {				
    $email=strtolower(trim($comment->comment_author_email));
    $rating = "G"; // [G | PG | R | X]
    if (function_exists('get_avatar')) {
      echo get_avatar($email, $size);
    } else {
      $grav_url = "http://www.gravatar.com/avatar.php?gravatar_id=" . md5($emaill) . "&size=" . $size."&rating=".$rating;
    echo "<img src='$grav_url'/>";
    }		
  }
?>
