<?php include("sidebar.php");?>

<div id="content">

<div class="post">

    <h1><?PHP echo $this->tag ?></h1>

    <?PHPif (isset($this->advice)) :?>
        <p><?PHP echo $this->advice ?></p>
    <?PHPendif; ?>

    <?PHPforeach($this->articles  as $article) { ?>

    <h2>
        <?PHPecho '<a href="'.URIMaker::article($article).'"> '.$article->getTitle()." </a>"; ?>
    </h2>

    <div class="date"><small><?PHP echo $article->getCreatedFormatted() ?></small> by
            <?
        foreach ($article->users() as $user) {
             echo $user->getName().' ';
        }
        ?>
    </div>
    <div class="date"><small><?PHP echo Taghandler::tagsToLink($article->getTag()) ?></small>
    </div>

    <div class="entry">

        <?PHP echo $article->getSummary() ?>

    </div>

    <p class="date">
        <?PHPecho '<a href="'.URIMaker::comment($article).'"> comments ('.count($article->commentsPublished()).') </a>'; ?>
    </p>

    <?PHP} ?>

    <p>
        <?PHP echo $this->paginator->renderFullNav(URIMaker::result())  ?>
    </p>
</div>