<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <div class="contenttitle">
            <h1><a href="<?PHP echoURIMaker::article($this->article)?>" rel="bookmark"><?PHP echo $this->article->getTitle() ?></a></h1>
            <p>
                <?PHP echo $this->article->getCreatedFormatted() ?>  by
                <?PHP echo $this->article->auhorsNamesConcatenation() ?> |
                <?PHPecho '<a href="'.URIMaker::comment($this->article).'"> comments ('.count($this->article->commentsPublished()).') </a>'; ?>
                <br />
                <?PHP echo Taghandler::tagsToLink($this->article->getTag()) ?>
            </p>
            <div>
                <?PHPecho Social::createLinks(URIMaker::article($this->article), $this->article->getTitle(), '_blank', $this->article->getMetakeyword()); ?>
            </div>

            <p>

            <?PHP echo $this->article->getSummary() ?>
            </p>
            <p>
                <?PHP echo $this->article->getBody() ?>
            </p>
            <div>
                <?PHPecho Social::createLinks(URIMaker::article($this->article), $this->article->getTitle(), '_blank', $this->article->getMetakeyword()); ?>
            </div>

        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>
