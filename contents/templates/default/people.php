<?php include("sidebar.php");?>

<div id="content">

    <div class="post">

        <h1>People</h1>

        <? foreach($this->people  as $user) { ?>

        <div class="date"><h4><a href="<?= URIMaker::articlesperson($user) ?>"><?= $user->getName() ?></a></h4></div>

        <div class="entry">
                <? if ($user->imageExists()) : ?>
            <div id="image">
                <img src="<?= URIMaker::fromBasePath($user->imagePath()) ?>" width="60" alt="<?= $user->getImgAlt()?>">
                        <? if ($user->getImgCaption() != ''): ?>
                <div id="caption">
                                <?= $user->getImgCaption() ?>
                </div>
                        <? endif; ?>
            </div>
                <? endif; ?>

                <?= $user->getBody() ?>
        </div>

        <? } ?>

    </div>


    <?php

    echo "<img src=\"contents/templates/default/example.png\">";

?>
