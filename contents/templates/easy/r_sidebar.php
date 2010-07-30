<!-- begin r_sidebar -->

	<div id="r_sidebar">
	<ul id="r_sidebarwidgeted">
            
        <li id="Themes">
            <a href="<?= URIMaker::rssFeed()?>"><img src="<?= URIMaker::fromBasePath('contents/templates/easy/images/rss-icon.png') ?>" border="0"> RSS Feed</a>
        </li>
        <br />

	<li id="Themes">
        <h2>Search</h2>
            <form id="searchform" method="post" action="<?= URIMaker::result() ?>">
                <input type="text" name="s" id="s" size="30" value=""/>
                <input type="submit" value="Search" name="Search" />
            </form>
		
        </li>
        <br />

        <li id="Themes">
	<h2>Categories</h2>
            <ul>
                <? foreach ($this->categories as $cat) : ?>
                <li><a href="<?= URIMaker::category($cat) ?>"><?= $cat->getName() ?></a></li>
                <? endforeach; ?>
            </ul>
        </li>
        <br />

        <li id="Themes">
        <h2>Admin</h2>
            <ul>
                <li><a href="<?= URIMaker::loginPage() ?>">Login</a></li>
                <li><a href="http://www.easymagazine.org/">Easy Magazine</a></li>
            </ul>
        </li>
        </ul>
			
</div>

<!-- end r_sidebar -->