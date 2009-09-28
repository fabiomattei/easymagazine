<!-- begin l_sidebar -->

<div id="l_sidebar">
    <ul id="l_sidebarwidgeted">

        <li id="Themes">
            <h2><?= $this->number->getTitle() ?></h2>
            <h3><?= $this->number->getSubtitle() ?></h3>
            <div id="numberDescription">
                <? if ($this->number->imageExists()) : ?>
                <img src="<?= URIMaker::fromBasePath($this->number->imagePath()) ?>" alt="<?= $this->number->getImgAlt()?>">
                <? endif; ?>
                <?= $this->number->getSummary() ?>
            </div>
            <? if ($this->number->epubExists()) : ?>
            <div id="epub">
                <a href="<?= URIMaker::fromBasePath($this->number->epubPath()) ?>">Download Epub</a>
            </div>
            <? endif; ?>
        </li>
        <br />

        <li id="Numbers">
            <h2>Last Numbers</h2>
            <ul>
                <? foreach ($this->numbers as $num) {
                    echo '<li><a href="'.URIMaker::number($num).'">'.$num->getTitle().'</a></li>';
                }?>
            </ul>
        </li>

        <li id="Themes">
            <h2>Admin</h2>
            <ul>
                <li><a href="<?= URIMaker::loginPage() ?>">Login</a></li>
                <li><a href="http://www.easymagazine.org/">Easy Magazine</a></li>
            </ul>
        </li>

</div>

<!-- end l_sidebar -->