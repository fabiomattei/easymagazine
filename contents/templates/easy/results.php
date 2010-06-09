<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <h1>Search results for: <?= $this->querystring ?></h1><br />

        <? if (isset($this->advice)) :?>
        <div class="contenttitle"><?= $this->advice ?></div>
        <? endif; ?>

        <? foreach($this->articles as $article) { ?>
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
                    <?= $article->getSummary() ?>
            </p>
        </div>
        <? } ?>
        <div class="contenttitle">
            <?= $_SESSION['paginator']->renderFullNav(URIMaker::result())  ?>
        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>
