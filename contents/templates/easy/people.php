<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">

        <? foreach($this->people  as $user) { ?>
        <div class="contenttitle">
            <h1><a href="<?= URIMaker::articlesperson($user) ?>"><?= $user->getName() ?></a></h1>
            <p>
                    <? if ($user->imageExists()) { ?>
                <img src="<?= URIMaker::fromBasePath($user->imagePath()) ?>" alt="<?=$user->getImgdescription()?>" width="60" align="left">
                    <? } ?>

                    <?= $user->getBody() ?>
            </p>
        </div>
        <? } ?>
    </div>

    <?php include("r_sidebar.php");?>

</div>