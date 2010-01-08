<!-- LEFTBAR -->
<div id="leftbar">
    <h2>All articles by <?= $this->person->getName() ?></h2>
    <? foreach($this->articles as $article) : ?>
    <div id="post">
        <h1><a href="<?=URIMaker::article($article)?>"><?= $article->getTitle() ?></a></h1>
        <h2>By <span style="color:#0066FF">
                    <?
                    foreach ($article->users() as $user) :
                        echo $user->getName().' ';
                    endforeach;
                    ?>
            </span>
            <a href="'.URIMaker::comment($article).'"> comments (<?= count($article->commentsPublished()) ?>) </a>
        </h2>
        <div id="postcontent"><p> <?= $article->getSummary() ?> </p></div>
    </div>
    <? endforeach; ?>
    <div id="links">
        <?= $this->paginator->renderFullNav(URIMaker::articlesperson($this->person))  ?>
    </div>
</div>
<!-- END LEFTBAR -->

<?php include("sidebar.php");?>