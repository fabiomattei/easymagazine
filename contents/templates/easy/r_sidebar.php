<!-- begin r_sidebar -->

	<div id="r_sidebar">
	<ul id="r_sidebarwidgeted">
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
        </ul>
			
</div>

<!-- end r_sidebar -->