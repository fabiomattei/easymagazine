<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <div class="contenttitle">
            <h1><a href="<?=URIMaker::page($this->page)?>" rel="bookmark"><?= $this->page->getTitle() ?></a></h1>
            <p>
            <?= $this->page->getSummary() ?>
            </p>
            <p>
                <?= $this->page->getBody() ?>
            </p>

        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>
