<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">

        <? foreach($this->people  as $user) { ?>
        <div class="contenttitle">
            <h1><a href="<?= URIMaker::articlesperson($user) ?>"><?= $user->getName() ?></a></h1>
            <p>
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
            </p>
        </div>
        <? } ?>
    </div>

    <?php include("r_sidebar.php");?>

</div>