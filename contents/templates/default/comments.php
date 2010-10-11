<?php include("sidebar.php");?>

<div id="content">

    <div class="post">

        <h2>
            <?PHP echo $this->article->getTitle(); ?>
        </h2>

        <div class="date"><small><?PHP echo $this->article->getCreatedFormatted() ?></small> by
            <?
            foreach ($this->article->users() as $user) {
                echo $user->getName().' ';
            }
            ?>
        </div>

        <div class="entry">

            <?PHP echo $this->article->getSummary() ?>

        </div>

        <h3>Comments</h3>

        <?
        if (isset($this->advice)) {
            echo '<b>'.$this->advice.'</b>';
        }
        ?>

        <?PHPforeach($this->article->commentsPublished()  as $comment) { ?>

        <div class="date"><small><?PHP echo $comment->getCreatedFormatted() ?></small> by
                <?PHP echo $comment->getSignature() ?>
        </div>
        <div class="date"><small><?PHP echo Taghandler::tagsToLink($this->article->getTag()) ?></small>
        </div>

        <div class="entry">

                <?PHP echo $comment->getTitle() ?><br />

                <?PHP echo $comment->getBody() ?>

        </div>

        <?PHP} ?>

        <?PHPif ($this->article->getCommentsallowed() && $this->article->number()->getCommentsallowed()): ?>
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
        <?PHPendif; ?>
    </div>