<?php include("sidebar.php");?>

<div id="content">

    <div class="post">

        <? foreach($this->numberslist  as $nu) : ?>

        <h2><a href="<?= URIMaker::number($nu) ?>"><?= $nu->getTitle() ?></a></h2>
        <h3><?= $nu->getSubtitle() ?></h3>
        <div class="entry">

                <?= $nu->getSummary() ?>

        </div>
            <? if ($nu->epubExists()) : ?>
        <div class="entry">
            <a href="<?= URIMaker::fromBasePath($nu->epubPath()) ?>">Download Epub</a>
        </div>
            <? endif; ?>

        <? endforeach; ?>
        <p>
            <?= $this->paginator->renderFullNav(URIMaker::numberslist())  ?>
        </p>
    </div>

