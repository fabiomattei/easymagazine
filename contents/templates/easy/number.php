<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <?PHP foreach($this->number->articlesPublished()  as $article) { ?>
        <div class="contenttitle">
            <h1><a href="<?PHP echo URIMaker::article($article)?>" rel="bookmark"><?PHP echo $article->getTitle() ?></a></h1>
            <p>
                    <?PHP echo $article->getCreatedFormatted() ?>  by
                    <?
                    foreach ($article->users() as $user) {
                        echo $user->getName().' ';
                    }
                    ?> |
                    <?PHP echo '<a href="'.URIMaker::comment($article).'"> comments ('.count($article->commentsPublished()).') </a>'; ?>
                    <br />
                    <?PHP echo Taghandler::tagsToLink($article->getTag()) ?>
            </p>
            <p>
                <?PHP echo $article->getSummary() ?>
            </p>
        </div>
        <?PHP } ?>
    </div>

    <?php include("r_sidebar.php");?>

</div>
