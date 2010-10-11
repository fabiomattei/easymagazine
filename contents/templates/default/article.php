<?php include("sidebar.php");?>
<div id="content">
    <div class="post">
        <h2><?PHP echo $this->article->getTitle() ?></h2>
        <div class="date"><small><?PHP echo $this->article->getCreatedFormatted() ?></small> by
            <?PHP echo $this->article->auhorsNamesConcatenation() ?>
        </div>
        <div class="date"><small><?PHP echo Taghandler::tagsToLink($this->article->getTag()) ?></small>
        </div>
        <p class="date">
        <?PHPecho Social::createLinks(URIMaker::article($this->article), $this->article->getTitle(), '_blank', $this->article->getMetakeyword()); ?>
        </p>
        <div class="entry">
            <?PHP echo $this->article->getBody() ?>
        </div>
        <p class="date">
            <?PHPecho '<a href="'.URIMaker::comment($this->article).'"> comments ('.count($this->article->commentsPublished()).') </a>'; ?>
        </p>
        <p class="date">
        <?PHPecho Social::createLinks(URIMaker::article($this->article), $this->article->getTitle(), '_blank', $this->article->getMetakeyword()); ?>
        </p>
    </div>