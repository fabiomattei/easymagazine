<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <div class="contenttitle">
            <h1><a href="<?PHP echo URIMaker::page($this->page)?>" rel="bookmark"><?PHP echo $this->page->getTitle() ?></a></h1>
            <p>
            <?PHP echo $this->page->getSummary() ?>
            </p>
            <p>
                <?PHP echo $this->page->getBody() ?>
            </p>

        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>
