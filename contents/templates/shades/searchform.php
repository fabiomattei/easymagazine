<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<div id="search-container">
		<input type="text" value="<?php _e('Looking for something?', 'shades'); ?>" onblur="if(this.value == '') {this.value = '<?php _e('Looking for something?', 'shades'); ?>';}" onfocus="if(this.value == '<?php _e('Looking for something?', 'shades'); ?>') {this.value = '';}" name="s" id="s" />
		<input type="submit" class="hidden" id="search-submit" value="<?php _e('Search' , 'shades'); ?>" />
	</div> <!-- #search-container -->
</form>
