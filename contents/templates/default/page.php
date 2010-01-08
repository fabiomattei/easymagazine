<?php include("sidebar.php");?>

<div id="content">

    <div class="post">

        <h2><?= $this->page->getTitle() ?></h2>

        <div class="entry">
            
            <?= $this->page->getBody() ?>

        </div>

    </div>
