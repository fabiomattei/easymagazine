<?php include("sidebar.php");?>
<div id="content">
    <div class="post">
        <h2><?= $this->article->getTitle() ?></h2>
        <div class="date"><small><?= $this->article->getCreatedFormatted() ?></small> by
            <?= $this->article->auhorsNamesConcatenation() ?>
        </div>
        <div class="date"><small><?= Taghandler::tagsToLink($this->article->getTag()) ?></small>
        </div>
        <p class="date">
        <? echo Social::createLinks(URIMaker::article($this->article), $this->article->getTitle(), '_blank', $this->article->getMetakeyword()); ?>
        </p>
        <div class="entry">
            <?= $this->article->getBody() ?>
        </div>
        <p class="date">
            <? echo '<a href="'.URIMaker::comment($this->article).'"> comments ('.count($this->article->commentsPublished()).') </a>'; ?>
        </p>
        <p class="date">
        <? echo Social::createLinks(URIMaker::article($this->article), $this->article->getTitle(), '_blank', $this->article->getMetakeyword()); ?>
        </p>
    </div>