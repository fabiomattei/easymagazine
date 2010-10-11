<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <?PHPforeach($this->number->articlesPublished()  as $article) { ?>
        <div class="contenttitle">
            <h1><a href="<?PHP echoURIMaker::article($article)?>" rel="bookmark"><?PHP echo $article->getTitle() ?></a></h1>
            <p>
                    <?PHP echo $article->getCreatedFormatted() ?>  by
                    <?
                    foreach ($article->users() as $user) {
                        echo $user->getName().' ';
                    }
                    ?> |
                    <?PHPecho '<a href="'.URIMaker::comment($article).'"> comments ('.count($article->commentsPublished()).') </a>'; ?>
                    <br />
                    <?PHP echo Taghandler::tagsToLink($article->getTag()) ?>
            </p>
            <p>
                <?PHP echo $article->getSummary() ?>
            </p>
            <div>
                <?PHPecho Social::createLinks(URIMaker::article($article), $article->getTitle(), '_blank', $article->getMetakeyword()); ?>
            </div>
        </div>
        <?PHP} ?>
    </div>

    <?php include("r_sidebar.php");?>

</div>