<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">

        <? foreach($this->numberslist  as $nu) : ?>
        <div class="contenttitle">
            <h1><a href="<?= URIMaker::number($nu) ?>"><?= $nu->getTitle() ?></a></h1>
            <p><?= $nu->getSubtitle() ?></p>
            <p>
                <?= $nu->getSummary() ?>
            </p>
                <? if ($nu->epubExists()) : ?>
            <p>
                <a href="<?= URIMaker::fromBasePath($nu->epubPath()) ?>">Download Epub</a>
            </p>
                <? endif; ?>
        </div>
        <? endforeach; ?>
        <div class="contenttitle">
            <p>
                <?= $this->paginator->renderFullNav(URIMaker::numberslist())  ?>
            </p>
        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>