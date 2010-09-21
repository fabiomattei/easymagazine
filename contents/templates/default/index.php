<?php include("sidebar.php");?>

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
    <div class="date"><small><?= Taghandler::tagsToLink($article->getTag()) ?></small>
    </div>

    <div class="entry">

        <?= $article->getSummary() ?>

    </div>

    <p class="date">
        <? echo '<a href="'.URIMaker::comment($article).'"> comments ('.count($article->commentsPublished()).') </a>'; ?>
    </p>
    <p class="date">
        <? echo Social::createLinks(URIMaker::article($article), $article->getTitle(), '_blank', $article->getMetakeyword()); ?>
    </p>

    <? } ?>

</div>