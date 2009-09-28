<div id="sidebar">

    <h2>Search</h2>
    <form id="searchform" method="post" action="<?= URIMaker::result() ?>">
        <input type="text" name="s" id="s"  value=""/>
        <input type="submit" value="Search" name="Search" />
    </form>

    <br />
    <h2><?= $this->number->getTitle() ?></h2>

    <p class="news">
        <b><?= $this->number->getSubtitle() ?></b>
        <? if ($this->number->imageExists()) : ?>
    <div id="image">
        <img src="<?= URIMaker::fromBasePath($this->number->imagePath()) ?>" width="200" alt="<?= $this->number->getImgAlt()?>">
            <? if ($this->number->getImgCaption() != ''): ?>
        <div id="caption">
                    <?= $this->number->getImgCaption() ?>
        </div>
            <? endif; ?>
    </div>
    <? endif; ?>
    <!-- <?= $this->number->getSummary() ?> -->
    <? if ($this->number->epubExists()) : ?>
    <a href="<?= URIMaker::fromBasePath($this->number->epubPath()) ?>">Download Epub</a>
    <? endif; ?>
</p>

<h2>Categories</h2>
<ul>
    <? foreach ($this->categories as $cat) : ?>
    <li><a href="<?= URIMaker::category($cat) ?>"><?= $cat->getName() ?></a></li>
    <? endforeach; ?>
</ul>


<h2>Lasts Numbers</h2>
<ul>
    <? foreach ($this->numbers as $num) { ?>
    <li><a href="<?= URIMaker::number($num)?>"><?= $num->getTitle() ?></a></li>
    <?   }?>
</ul>
<h2>Admin</h2>
<ul>
    <li><a href="<?= URIMaker::loginPage() ?>">Login</a></li>
    <li><a href="http://www.easymagazine.org/">Easy Magazine</a></li>
</ul>

</div>