<!-- begin l_sidebar -->

<div id="l_sidebar">
    <ul id="l_sidebarwidgeted">

        <li id="Themes">
            <h2><?PHP echo $this->number->getTitle() ?></h2>
            <h3><?PHP echo $this->number->getSubtitle() ?></h3>
            <div id="numberDescription">
                <?PHP echo $this->number->getSummary() ?>
            </div>
            <?PHPif ($this->number->epubExists()) : ?>
            <div id="epub">
                <a href="<?PHP echo URIMaker::fromBasePath($this->number->epubPath()) ?>">Download Epub</a>
            </div>
            <?PHPendif; ?>
        </li>
        <br />

        <li id="Numbers">
            <h2>Last Numbers</h2>
            <ul>
                <?PHPforeach ($this->numbers as $num) {
                    echo '<li><a href="'.URIMaker::number($num).'">'.$num->getTitle().'</a></li>';
                }?>
            </ul>
        </li>

</div>

<!-- end l_sidebar -->