<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">
        <div class="contenttitle">
            <h1><a href="<?PHP echo URIMaker::article($this->article)?>" rel="bookmark"><?PHP echo $this->article->getTitle() ?></a></h1>
            <p>
                <?PHP echo $this->article->getCreatedFormatted() ?>  by
                <?
                foreach ($this->article->users() as $user) {
                    echo $user->getName().' ';
                }
                ?> |
                <?PHP echo '<a href="'.URIMaker::comment($this->article).'"> comments ('.count($this->article->commentsPublished()).') </a>'; ?>
                <br />
                <?PHP echo Taghandler::tagsToLink($this->article->getTag()) ?>
            </p>
            <p>
            <?PHP echo $this->article->getSummary() ?>
            </p>

            <h3>Comments</h3>

            <?
            if (isset($this->advice)) {
                echo '<b>'.$this->advice.'</b>';
            }
            ?>

            <?PHP foreach($this->article->commentsPublished()  as $comment) { ?>

            <p><small><?PHP echo $comment->getCreatedFormatted() ?></small> by
                    <?PHP echo $comment->getSignature() ?>
            </p>

            <p>

                    <?PHP echo $comment->getTitle() ?><br />

                    <?PHP echo $comment->getBody() ?>

            </p>

            <?PHP } ?>

            <?PHP if ($this->article->getCommentsallowed() && $this->article->number()->getCommentsallowed()): ?>
            <p>
            <form name="newcomment" method="post" action="<?PHP echo URIMaker::comment($this->article) ?>">
                Title<br />
                <input type="text" name="Title" value="<?PHP echo $this->postedtitle ?>"/><br />
                Body<br />
                <textarea name="Body" rows="4" cols="40"><?PHP echo $this->postedbody ?></textarea><br />
                Signature<br />
                <input type="text" name="Signature" value="<?PHP echo $this->postedsignature ?>"/><br /><br />
                <!-- pass a session id to the query string of the script to prevent ie caching -->
                <img src="<?PHP echo URIMaker::fromBasePath('lib/securimage/securimage_show.php?sid='.md5(uniqid(time())))?>"><br />
                <input type="text" name="code" /><br /><br />
                <input type="submit" value="Ok" name="Ok" />
            </form>
            </p>
            <?PHP endif; ?>

        </div>
    </div>

    <?php include("r_sidebar.php");?>

</div>
