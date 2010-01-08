<div id="sidebar">
	<div id="sidebar-top"></div>
	<div id="sidebar-content">
		<div id="subcolumn">
    
			<div class="widget">
				<div id="search">
					<form id="searchform" method="get" action="<?php bloginfo('home'); ?>/">
						<div id="search-inputs">
							<?php get_search_form(); ?>
						</div> <!-- #search-inputs -->
					</form>	
				</div> <!-- #search -->
			</div>
         
			<ul><li>
				<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>		
		
					<div class="widget">			
						<h2 class="widget-title"><?php _e('Calendar', 'shades'); ?></h2>
						<div align="center">
							<?php get_calendar(0); ?> 
						</div>
					</div>
		
					<div class="widget">
						<?php wp_list_bookmarks('title_li=&title_before=<h2 class="widget-title">&title_after=</h2>&category_before=&category_after='); ?>
					</div>
				
					<div class="widget">			
						<h2 class="widget-title"><?php _e('Categories', 'shades'); ?></h2>
						<ul>
							<?php wp_list_categories('title_li=&show_count=1'); ?>
						</ul>
					</div>
		
					<div class="widget">			
						<h2 class="widget-title"><?php _e('Archives', 'shades'); ?></h2>
						<ul>
							<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
						</ul>
					</div>
      
					<div class="widget">
						<h2 class="widget-title"><?php _e('Meta', 'shades'); ?></h2>
						<ul>
							<?php wp_register(); ?>
							<li><?php wp_loginout(); ?></li>
							<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
							<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
							<li><a href="http://wordpress.org/" title="Powered by WordPress.">WordPress</a></li>
							<?php wp_meta(); ?>
						</ul>
					</div>

				<?php endif; ?>
			
				<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar(2)) : else : ?><?php endif; ?>
								
			</li></ul>
		</div> <!-- #subcolumn --> 
	</div> <!--#sidebar-content -->
    <div id="sidebar-bottom"></div>
</div> <!-- #sidebar -->