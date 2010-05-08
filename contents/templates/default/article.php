<?php include("sidebar.php");?>
<div id="content">
    <div class="post">
        <h2><?= $this->article->getTitle() ?></h2>
        <div class="date"><small><?= $this->article->getCreatedFormatted() ?></small> by
            <?= $this->article->auhorsNamesConcatenation() ?>
        </div>
        <div class="entry">
            <?= $this->article->getBody() ?>
        </div>
        <p class="date">
            <? echo '<a href="'.URIMaker::comment($this->article).'"> comments ('.count($this->article->commentsPublished()).') </a>'; ?>
        </p>
    </div>
    <br><br>Pages<br>
    <?
    foreach($this->pages  as $page) {
        echo '<a href="'.URIMaker::page($page).'"> '.$page->getTitle()." </a><br>";
    }
?>