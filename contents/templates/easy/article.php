<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <div class="contenttitle">
            <h1><a href="<?=URIMaker::article($this->article)?>" rel="bookmark"><?= $this->article->getTitle() ?></a></h1>
            <p>
                <?= $this->article->getCreatedFormatted() ?>  by
                <?= $this->article->auhorsNamesConcatenation() ?> |
                <? echo '<a href="'.URIMaker::comment($this->article).'"> comments ('.count($this->article->commentsPublished()).') </a>'; ?>
                <br />
                <?= Taghandler::tagsToLink($this->article->getTag()) ?>
            </p>
            <p>

            <?= $this->article->getSummary() ?>
            </p>
            <p>
                <?= $this->article->getBody() ?>
            </p>

        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>
