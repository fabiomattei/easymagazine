<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php
        if ( is_single() ) { single_post_title(); _e(' | ', 'shades'); bloginfo('name');}       
        elseif ( is_home() || is_front_page() ) { bloginfo('name'); _e(' | ', 'shades'); bloginfo('description'); get_page_number(); }
        elseif ( is_page() ) { single_post_title(''); _e(' | ', 'shades'); bloginfo('name'); }
        elseif ( is_search() ) { bloginfo('name'); print __(' | Search results for ', 'shades') . wp_specialchars($s); get_page_number(); }
        elseif ( is_404() ) { bloginfo('name'); _e(' | Not Found', 'shades'); }
        else { bloginfo('name'); wp_title(__(' | ', 'shades')); get_page_number(); }
    ?></title>

	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>

<!--[if IE 6]>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/ie6.css" type="text/css" media="screen" />
<![endif]-->
</head>

<body>
	<div id="mainwrap">
		<div id="header-container">
			<div id="header">
				<div id="header-left"></div>
				<div id="header-center">
					<h2><a href="<?php bloginfo('siteurl'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h2> <!-- added URL code -->
					<p><?php bloginfo('description'); ?></p>
				</div> <!-- #header-center -->
			<div id="header-right"></div>
        	</div> <!-- #header -->
      		<div class="clear"></div>
  
			<div class="menu">
				<ul>
					<?php if (is_home() || is_front_page()) { ?>
						<?php wp_list_pages('title_li=&depth=1&include=2'); ?> <!-- Puts page 2, usually the "About" page, at the beginning of the menu -->
						<?php wp_list_pages('title_li=&depth=1&exclude=2'); ?> <!-- Only displays "parent" pages; and, excludes page 2 as it is included in the line above -->
					<?php } else { ?>
						<li><a href="<?php bloginfo('url'); ?>" class="active"><?php _e('Home') ?></a></li>
						<?php wp_list_pages('title_li=&depth=1'); ?> <!-- Only displays "parent" pages -->
					<?php } ?>
				</ul>
			</div> <!-- .menu -->
		</div> <!-- #header-container -->