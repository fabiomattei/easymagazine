<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <div class="contenttitle">
            <h1><a href="<?=URIMaker::page($this->page)?>" rel="bookmark"><?= $this->page->getTitle() ?></a></h1>
            <p>
                <? if ($this->page->imageExists()) : ?>
            <div id="image">
                <img src="<?= URIMaker::fromBasePath($this->page->imagePath()) ?>" width="100" alt="<?= $this->page->getImgAlt()?>">
                    <? if ($this->page->getImgCaption() != ''): ?>
                <div id="caption">
                            <?= $this->page->getImgCaption() ?>
                </div>
                    <? endif; ?>
            </div>
            <? endif; ?>
            <?= $this->page->getSummary() ?>
            </p>
            <p>
                <?= $this->page->getBody() ?>
            </p>

        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>
