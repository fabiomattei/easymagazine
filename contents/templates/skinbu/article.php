<!-- LEFTBAR -->
<div id="leftbar">
    <div id="post">
        <h1><a href="<?=URIMaker::article($this->article)?>"><?= $this->article->getTitle() ?></a></h1>
        <h2>By <span style="color:#0066FF">
                <?
                foreach ($this->article->users() as $user) :
                    echo $user->getName().' ';
                endforeach;
                ?>
            </span></h2>
        <div id="postcontent"><p> <?= $this->article->getSummary() ?> </p></div>
        <div id="postcontent"><p> <?= $this->article->getBody() ?> </p></div>
    </div>
</div>
<!-- END LEFTBAR -->

<?php include("sidebar.php");?>