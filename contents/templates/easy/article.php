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
                    <? echo '<a href="'.URIMaker::comment($this->article).'"> comments ('.count($this->article->comments()).') </a>'; ?>
            </p>
            <p>
                    <? if ($this->article->imageExists()) { ?>
                <img src="<?= URIMaker::fromBasePath($this->article->imagePath()) ?>" width="100" align="left">
                    <? } ?>
                    <?= $this->article->getSummary() ?>
            </p>
            <p>
                    <?= $this->article->getBody() ?>
            </p>

        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>
