<div id="content">

    <?php include("l_sidebar.php");?>

    <div id="contentmiddle">

        <?PHPforeach($this->people  as $user) { ?>
        <div class="contenttitle">
            <h1><a href="<?PHP echo URIMaker::articlesperson($user) ?>"><?PHP echo $user->getName() ?></a></h1>
            <p>

                <?PHP echo $user->getBody() ?>
            </p>
        </div>
        <?PHP} ?>
    </div>

    <?php include("r_sidebar.php");?>

</div>