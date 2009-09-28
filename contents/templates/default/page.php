<?php include("sidebar.php");?>

<div id="content">

    <div class="post">

        <h2><?= $this->page->getTitle() ?></h2>

        <div class="entry">
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
            <?= $this->page->getBody() ?>

        </div>

    </div>
