<!-- begin r_sidebar -->

	<div id="r_sidebar">
	<ul id="r_sidebarwidgeted">
            
        <li class="Themes">
            <a href="<?PHP echo URIMaker::rssFeed()?>"><img src="<?PHP echo URIMaker::templatePath('images/rss-icon.png') ?>" border="0"> RSS Feed</a>
        </li>
        <br />

	<li class="Themes">
        <h2>Search</h2>
            <form id="searchform" method="post" action="<?PHP echo URIMaker::result() ?>">
                <input type="text" name="s" id="s" size="30" value=""/>
                <input type="submit" value="Search" name="Search" />
            </form>
		
        </li>
        <br />

        <li class="Themes">
	<h2>Categories</h2>
            <ul>
                <?PHPforeach ($this->categories as $cat) : ?>
                <li><a href="<?PHP echo URIMaker::category($cat) ?>"><?PHP echo $cat->getName() ?></a></li>
                <?PHPendforeach; ?>
            </ul>
        </li>
        <br />

        <li class="Themes">
        <h2>Admin</h2>
            <ul>
                <li><a href="<?PHP echo URIMaker::loginPage() ?>">Login</a></li>
                <li><a href="http://www.easymagazine.org/">Easy Magazine</a></li>
            </ul>
        </li>
        </ul>
			
</div>

<!-- end r_sidebar -->