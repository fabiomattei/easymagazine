<div id="sidebar">

      <h2>Search</h2>
            <form id="searchform" method="post" action="<?= URIMaker::result() ?>">
                <input type="text" name="s" id="s"  value=""/>
                <input type="submit" value="Search" name="Search" />
            </form>

      <br />
      <h2><?= $this->number->getTitle() ?></h2>

      <p class="news">
          <b><?= $this->number->getSubtitle() ?></b>
          <? if ($this->number->imageExists()) : ?>
                <img src="<?= URIMaker::fromBasePath($this->number->imagePath()) ?>" width="200" alt="<?= $this->number->getImgdescription()?>">
          <? endif; ?>
          <!-- <?= $this->number->getSummary() ?> -->
          <? if ($this->number->epubExists()) : ?>
                <a href="<?= URIMaker::fromBasePath($this->number->epubPath()) ?>">Download Epub</a>
          <? endif; ?>
       </p>

            <h2>Categories</h2>
            <ul>
                <? foreach ($this->categories as $cat) : ?>
                <li><a href="<?= URIMaker::category($cat) ?>"><?= $cat->getName() ?></a></li>
                <? endforeach; ?>
            </ul>


<h2>Lasts Numbers</h2>
<ul>
    <? foreach ($this->numbers as $num) { ?>
           <li><a href="<?= URIMaker::number($num)?>"><?= $num->getTitle() ?></a></li>
    <?   }?>
</ul>
            <h2>Admin</h2>
            <ul>
                <li>login logout</li>
                <li><a href="http://www.wordpress.org/">hello</a></li>
                <li><a href="http://validator.w3.org/check?uri=referer">hello</a></li>
            </ul>

</div>