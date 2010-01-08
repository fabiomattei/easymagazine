    <div id="bottom">
        <p> <!-- to change to three credit lines be sure to change the #bottom CSS padding-top element to 90px -->
        <?php _e('Copyright', 'shades'); ?> &copy; <?php echo date("Y"); ?>  <strong><?php bloginfo('name'); ?></strong> <?php _e('All rights reserved', 'shades'); ?>.<br />
        <?php
            $blog_css_url = get_stylesheet_directory() . '/style.css';
            $my_theme_data = get_theme_data($blog_css_url);
            echo $my_theme_data['Name']; ?>
             v<?php echo $my_theme_data['Version']; ?>
             <?php
              $parent_blog_css_url = get_template_directory() . '/style.css';
              $parent_theme_data = get_theme_data($parent_blog_css_url);
              if ($blog_css_url != $parent_blog_css_url) {
              _e(' a child of the ', 'shades');
               echo $parent_theme_data['Name']; ?>
                v<?php echo $parent_theme_data['Version'];
          } ?>
             <?php _e('theme from', 'shades'); ?>
             <a href="http://buynowshop.com/" title="BuyNowShop.com">BuyNowShop.com</a>.
          <?php wp_footer(); ?>
        </p>        
      </div> <!-- #bottom -->
    </div> <!-- #mainwrap -->
  </body>
</html>
