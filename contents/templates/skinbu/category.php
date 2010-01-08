<!-- LEFTBAR -->
<div id="leftbar">
    <h2><?= $this->category->getName() ?></h2>
    <div id="post">
        <?= $this->category->getDescription() ?>
    </div>
    <? foreach($this->articles as $article) : ?>
    <div id="post">
        <h1><a href="<?=URIMaker::article($article)?>"><?= $article->getTitle() ?></a></h1>
        <h2>By <span style="color:#0066FF">
                    <?
                    foreach ($article->users() as $user) :
                        echo $user->getName().' ';
                    endforeach;
                    ?>
                    </span></h2>
        <div id="postcontent"><p> <?= $article->getSummary() ?> </p></div>
        <div id="tagsbar">
            <span id="tbarelement"><img alt="categoria" src="<?= URIMaker::fromBasePath('contents/templates/skinbu/images/categoria.png') ?>" /><?= $article->category()->getName() ?></span>
            <span id="tbarelement"><img alt="commento" src="<?= URIMaker::fromBasePath('contents/templates/skinbu/images/comment.png') ?>" /><a href="'.URIMaker::comment($article).'"> comments (<?= count($article->commentsPublished()) ?>) </a></span>
            <span id="tbarelement"><img alt="data" src="<?= URIMaker::fromBasePath('contents/templates/skinbu/images/data.png') ?>" /><?= $article->getCreatedFormatted() ?></span>
            <div id="readmore"><a href="<?=URIMaker::article($article)?>"><img alt="Read All" src="<?= URIMaker::fromBasePath('contents/templates/skinbu/images/readmore1.png') ?>" onmouseover="<?= URIMaker::fromBasePath('contents/templates/skinbu/images/readmore2.png') ?>" onmouseout="<?= URIMaker::fromBasePath('contents/templates/skinbu/images/readmore1.png') ?>" /></a></div>
        </div>
    </div>
    <?php endforeach; ?>
    <div id="links">
        <?= $this->paginator->renderFullNav(URIMaker::category($this->category))  ?>
    </div>
</div>
<!-- END LEFTBAR -->
<?php include("sidebar.php");?>