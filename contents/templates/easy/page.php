<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <div class="contenttitle">
            <h1><a href="<?=URIMaker::page($this->page)?>" rel="bookmark"><?= $this->page->getTitle() ?></a></h1>
            <p>
                    <? if ($this->page->imageExists()) { ?>
                <img src="<?= URIMaker::fromBasePath($this->article->imagePath()) ?>" alt="<?=$this->page->getImgAlt()?>" width="100" align="left">
                    <? } ?>
                    <?= $this->page->getSummary() ?>
            </p>
            <p>
                    <?= $this->page->getBody() ?>
            </p>

        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>
