<div id="sidebar">


    <h2>About this Magazine</h2>

    <p class="news">
        A little something about you, the author. Nothing lengthy, just an overview.
    </p>

    <h2>Lasts Numbers</h2>
    <ul>
        <? foreach ($this->numbers as $num) {
            echo '<li><a href="'.URIMaker::number($num).'">'.$num->getTitle().'</a></li>';
        }?>
    </ul>
</div>

<div id="content">

    <div class="post">

        <h2>
            <?= $this->article->getTitle(); ?>
        </h2>

        <div class="date"><small><?= $this->article->getCreatedFormatted() ?></small> by
            <?
            foreach ($this->article->users() as $user) {
                echo $user->getName().' ';
            }
            ?>
        </div>

        <div class="entry">

            <?= $this->article->getSummary() ?>

        </div>

        <h3>Comments</h3>

        <?
        if (isset($this->advice)) {
            echo '<b>'.$this->advice.'</b>';
        }
        ?>

        <? foreach($this->article->commentsPublished()  as $comment) { ?>

        <div class="date"><small><?= $comment->getCreatedFormatted() ?></small> by
                <?= $comment->getSignature() ?>
        </div>

        <div class="entry">

                <?= $comment->getTitle() ?><br />

                <?= $comment->getBody() ?>

        </div>

        <? } ?>

        <p>
        <form name="newcomment" method="post" action="<?= URIMaker::comment($this->article) ?>">
            Title<br />
            <input type="text" name="Title" value=""/><br />
            Body<br />
            <textarea name="Body" rows="4" cols="40"></textarea><br />
            Signature<br />
            <input type="text" name="Signature" value=""/><br /><br />
            <input type="submit" value="Ok" name="Ok" />
        </form>
        </p>

    </div>