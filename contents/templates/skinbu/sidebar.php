<!-- SIDEBAR -->
<div id="sidebar" >
    <form method="get" id="searchform" action="<?= URIMaker::result() ?>/">
        <input type="text" value="search" name="s" id="search" />
        <input type="submit" id="submitsearch" value="" alt="" title="" />
    </form>

    <div id="box" style="margin-left:auto;margin-right:auto;">
        <h2>Number</h2>
        <h5><?= $this->number->getTitle() ?></h5>
        <h6><?= $this->number->getSubtitle() ?></h6>
        <?= $this->number->getSummary() ?>
        <? if ($this->number->epubExists()) : ?>
        <a href="<?= URIMaker::fromBasePath($this->number->epubPath()) ?>">Download Epub</a>
        <? endif; ?>
    </div>

    <div id="box" style="margin-left:auto;margin-right:auto;">
        <h2>Last Numbers</h2>
        <ul>
            <? foreach ($this->numbers as $num) : ?>
            <li><a href="<?= URIMaker::number($num) ?>"><?= $num->getTitle() ?></a></li>
            <? endforeach; ?>
        </ul>
    </div>

    <div id="box" style="margin-left:auto;margin-right:auto;">
        <h2>Categories</h2>
        <ul>
            <? foreach ($this->categories as $cat) : ?>
            <li><a href="<?= URIMaker::category($cat) ?>"><?= $cat->getName() ?></a></li>
            <? endforeach; ?>
        </ul>
    </div>

    <div id="box" style="margin-left:auto;margin-right:auto;">
        <h2>Admin</h2>
        <ul>
            <li><a href="<?= URIMaker::loginPage() ?>">Login</a></li>
            <li><a href="http://www.easymagazine.org/">Easy Magazine</a></li>
        </ul>
    </div>

</div>
<!-- END SIDEBAR -->
