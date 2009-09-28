<?php include("sidebar.php");?>
<div id="content">
    <div class="post">
        <h2><?= $this->article->getTitle() ?></h2>
        <div class="date"><small><?= $this->article->getCreatedFormatted() ?></small> by
            <?
            foreach ($this->article->users() as $user) {
                echo $user->getName().' ';
            }
            ?>
        </div>
        <div class="entry">
            <? if ($this->article->imageExists()) : ?>
            <div id="image">
                <img src="<?= URIMaker::fromBasePath($this->article->imagePath()) ?>" width="100" alt="<?= $this->article->getImgAlt()?>">
                    <? if ($this->article->getImgCaption() != ''): ?>
                <div id="caption">
                            <?= $this->article->getImgCaption() ?>
                </div>
                    <? endif; ?>
            </div>
            <? endif; ?>
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