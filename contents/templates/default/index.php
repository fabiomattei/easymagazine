<div id="sidebar">

      <h2>About this Magazine</h2>

      <p class="news">
          A little something about the magazine and the authors. Nothing lengthy, just an overview.
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

    <h1><?= $this->number->getTitle() ?></h1>

    <? foreach($this->number->articlesPublished()  as $article) { ?>

    <h2>
        <? echo '<a href="'.URIMaker::article($article).'"> '.$article->getTitle()." </a>"; ?>
    </h2>

    <div class="date"><small><?= $article->getCreatedFormatted() ?></small> by
            <?
        foreach ($article->users() as $user) {
             echo $user->getName().' ';
        }
        ?>
    </div>

    <div class="entry">

         <? if ($article->imageExists()) { ?>
        <img src="<?= URIMaker::fromBasePath($article->imagePath()) ?>" width="100" align="left">
         <? } ?>

        <?= $article->getSummary() ?>

    </div>

    <p class="date">
        <? echo '<a href="'.URIMaker::comment($article).'"> comments ('.count($article->commentsPublished()).') </a>'; ?>
    </p>

    <? } ?>

</div>