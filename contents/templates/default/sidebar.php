<div id="sidebar">

    <h2>Search</h2>
    <form id="searchform" method="post" action="<?PHP echo URIMaker::result() ?>">
        <input type="text" name="s" id="s"  value=""/>
        <input type="submit" value="Search" name="Search" />
    </form>

    <br />
    <a href="<?PHP echo URIMaker::rssFeed()?>"><img src="<?PHP echo URIMaker::templatePath('images/rss-icon.png') ?>"></a>
    RSS Feed
    <br /><br />

    <h2><?PHP echo $this->number->getTitle() ?></h2>

    <div class="news">
        <b><?PHP echo $this->number->getSubtitle() ?></b>

     <?PHP echo $this->number->getSummary() ?> 
    <?PHP if ($this->number->epubExists()) : ?>
    <a href="<?PHP echo URIMaker::fromBasePath($this->number->epubPath()) ?>">Download Epub</a>
    <?PHP endif; ?>
</div>
<br />
<h2>Categories</h2>
<ul>
    <?PHP foreach ($this->categories as $cat) : ?>
    <li><a href="<?PHP echo URIMaker::category($cat) ?>"><?PHP echo $cat->getName() ?></a></li>
    <?PHP endforeach; ?>
</ul>


<h2>Lasts Numbers</h2>
<ul>
    <?PHP foreach ($this->numbers as $num) { ?>
    <li><a href="<?PHP echo URIMaker::number($num)?>"><?PHP echo $num->getTitle() ?></a></li>
    <?PHP  }?>
</ul>
<h2>Admin</h2>
<ul>
    <li><a href="<?PHP echo URIMaker::loginPage() ?>">Login</a></li>
    <li><a href="http://www.easymagazine.org/">Easy Magazine</a></li>
</ul>

</div>