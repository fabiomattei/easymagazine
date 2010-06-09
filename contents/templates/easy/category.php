<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <h1>All articles related to the category: <?= $this->category->getName() ?></h1><br />
        <div class="contenttitle"><?= $this->category->getDescription() ?></div>
        
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
            <?= $this->paginator->renderFullNav(URIMaker::category($this->category))  ?>
        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>