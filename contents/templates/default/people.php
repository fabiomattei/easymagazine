<?php include("sidebar.php");?>

<div id="content">

    <div class="post">

        <h1>People</h1>

        <?PHP foreach($this->people  as $user) { ?>

        <div class="date"><h4><a href="<?PHP echo URIMaker::articlesperson($user) ?>"><?PHP echo $user->getName() ?></a></h4></div>

        <div class="entry">

                <?PHP echo $user->getBody() ?>
        </div>

        <?PHP } ?>

    </div>


    <?php

    echo "<img src=\"contents/templates/default/example.png\">";

?>
