<?php include("sidebar.php");?>

<div id="content">

    <div class="post">

        <h1>People</h1>

        <? foreach($this->people  as $user) { ?>

        <div class="date"><h4><a href="<?= URIMaker::articlesperson($user) ?>"><?= $user->getName() ?></a></h4></div>

        <div class="entry">

                <?= $user->getBody() ?>
        </div>

        <? } ?>

    </div>


    <?php

    echo "<img src=\"contents/templates/default/example.png\">";

?>
