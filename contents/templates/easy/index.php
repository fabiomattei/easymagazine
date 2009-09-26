<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <? foreach($this->number->articlesPublished()  as $article) { ?>
        <div class="contenttitle">
            <h1><a href="<?=URIMaker::article($article)?>" rel="bookmark"><?= $article->getTitle() ?></a></h1>
            <p>
                    <?= $article->getCreatedFormatted() ?>  by
                    <?
                    foreach ($article->users() as $user) {
                        echo $user->getName().' ';
                    }
                    ?> |
                    <? echo '<a href="'.URIMaker::comment($article).'"> comments ('.count($article->commentsPublished()).') </a>'; ?>
            </p>
            <p>
                    <? if ($article->imageExists()) { ?>
                <img src="<?= URIMaker::fromBasePath($article->imagePath()) ?>" alt="<?=$article->getImgdescription()?>" width="100" align="left">
                    <? } ?>
                    <?= $article->getSummary() ?>
            </p>
        </div>
        <? } ?>
    </div>

    <?php include("r_sidebar.php");?>

</div>