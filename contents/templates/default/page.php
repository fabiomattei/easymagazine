<?php include("sidebar.php");?>

<div id="content">

<div class="post">

    <h2><?= $this->page->getTitle() ?></h2>

    <div class="entry">
        <? if ($this->page->imageExists()) { ?>
        <img src="<?= URIMaker::fromBasePath($this->page->imagePath()) ?>"  alt="<?=$this->page->getImgdescription()?>" align="left">
        <? } ?>
         <?= $this->page->getBody() ?>

    </div>

</div>
