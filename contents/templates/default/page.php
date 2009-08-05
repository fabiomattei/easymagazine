<div id="sidebar">


      <h2>About this Magazine</h2>

      <p class="news">
          A little something about you, the author. Nothing lengthy, just an overview.
      </p>

<h2>Lasts Numbers</h2>
<ul>
    <? foreach ($this->numbers as $num) {
           echo '<li><a href="'.URIMaker::number($num).'">'.$num->getTitle().'</a></li>';
       }?>
</ul>
</div>

<div id="content">

<div class="post">

    <h2><?= $this->page->getTitle() ?></h2>

    <div class="entry">
        <? if ($this->page->imageExists()) { ?>
        <img src="<?= URIMaker::fromBasePath($this->page->imagePath()) ?>" align="left">
        <? } ?>
         <?= $this->page->getBody() ?>

    </div>

</div>
