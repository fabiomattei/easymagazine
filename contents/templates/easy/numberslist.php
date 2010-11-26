<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">

        <?PHP foreach($this->numberslist  as $nu) : ?>
        <div class="contenttitle">
            <h1><a href="<?PHP echo URIMaker::number($nu) ?>"><?PHP echo $nu->getTitle() ?></a></h1>
            <p><?PHP echo $nu->getSubtitle() ?></p>
            <p>
                <?PHP echo $nu->getSummary() ?>
            </p>
                <?PHP if ($nu->epubExists()) : ?>
            <p>
                <a href="<?PHP echo URIMaker::fromBasePath($nu->epubPath()) ?>">Download Epub</a>
            </p>
                <?PHP endif; ?>
        </div>
        <?PHP endforeach; ?>
        <div class="contenttitle">
            <p>
                <?PHP echo $this->paginator->renderFullNav(URIMaker::numberslist())  ?>
            </p>
        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>