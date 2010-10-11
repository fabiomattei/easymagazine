<?php include("sidebar.php");?>

<div id="content">

    <div class="post">

        <?PHPforeach($this->numberslist  as $nu) : ?>

        <h2><a href="<?PHP echo URIMaker::number($nu) ?>"><?PHP echo $nu->getTitle() ?></a></h2>
        <h3><?PHP echo $nu->getSubtitle() ?></h3>
        <div class="entry">

                <?PHP echo $nu->getSummary() ?>

        </div>
            <?PHPif ($nu->epubExists()) : ?>
        <div class="entry">
            <a href="<?PHP echo URIMaker::fromBasePath($nu->epubPath()) ?>">Download Epub</a>
        </div>
            <?PHPendif; ?>

        <?PHPendforeach; ?>
        <p>
            <?PHP echo $this->paginator->renderFullNav(URIMaker::numberslist())  ?>
        </p>
    </div>

