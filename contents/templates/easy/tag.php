<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <h1><?PHP echo $this->tag ?></h1><br />

        <?PHPif (isset($this->advice)) :?>
        <div class="contenttitle"><?PHP echo $this->advice ?></div>
        <?PHPendif; ?>

        <?PHPforeach($this->articles as $article) { ?>
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
        </div>
        <?PHP} ?>
        <div class="contenttitle">
            <?PHP echo $this->paginator->renderFullNav(URIMaker::result())  ?>
        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>
