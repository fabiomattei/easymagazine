<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <div class="contenttitle">
            <h1><a href="<?=URIMaker::article($this->article)?>" rel="bookmark"><?= $this->article->getTitle() ?></a></h1>
            <p>
                <?= $this->article->getCreatedFormatted() ?>  by
                <?
                foreach ($this->article->users() as $user) {
                    echo $user->getName().' ';
                }
                ?> |
                <? echo '<a href="'.URIMaker::comment($this->article).'"> comments ('.count($this->article->commentsPublished()).') </a>'; ?>
            </p>
            <p>
                <? if ($this->article->imageExists()) : ?>
            <div id="image">
                <img src="<?= URIMaker::fromBasePath($this->article->imagePath()) ?>" width="200" alt="<?= $this->article->getImgAlt()?>">
                    <? if ($this->article->getImgCaption() != ''): ?>
                <div id="caption">
                            <?= $this->article->getImgCaption() ?>
                </div>
                    <? endif; ?>
            </div>
            <? endif; ?>
            <?= $this->article->getSummary() ?>
            </p>
            <p>
                <?= $this->article->getBody() ?>
            </p>

        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>
