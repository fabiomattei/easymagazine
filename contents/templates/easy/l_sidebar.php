<!-- begin l_sidebar -->

<div id="l_sidebar">
    <ul id="l_sidebarwidgeted">

        <li id="Themes">
            <h2><?PHP echo $this->number->getTitle() ?></h2>
            <h3><?PHP echo $this->number->getSubtitle() ?></h3>
            <div id="numberDescription">
                <?PHP echo $this->number->getSummary() ?>
            </div>
            <?PHP if ($this->number->epubExists()) : ?>
            <div id="epub">
                <a href="<?PHP echo URIMaker::fromBasePath($this->number->epubPath()) ?>">Download Epub</a>
            </div>
            <?PHP endif; ?>
        </li>
        <br />

        <li id="Numbers">
            <h2>Last Numbers</h2>
            <ul>
                <?PHP foreach ($this->numbers as $num) {
                    echo '<li><a href="'.URIMaker::number($num).'">'.$num->getTitle().'</a></li>';
                }?>
            </ul>
        </li>

</div>

<!-- end l_sidebar -->