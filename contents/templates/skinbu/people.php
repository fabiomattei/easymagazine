<!-- LEFTBAR -->
<div id="leftbar">
    <? foreach($this->people  as $user): ?>
    <div id="post">
        <h1><a href="<?= URIMaker::articlesperson($user) ?>"><?= $user->getName() ?></a></h1>
        <div id="postcontent"><p> <?= $user->getBody() ?> </p></div>
    </div>
    <? endforeach; ?>
</div>
<!-- END LEFTBAR -->

<?php include("sidebar.php");?>