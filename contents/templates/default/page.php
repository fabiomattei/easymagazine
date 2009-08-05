<div id="sidebar">


      <h2>About this Magazine</h2>

      <p class="news">
          A little something about you, the author. Nothing lengthy, just an overview.
      </p>

<h2>Lasts Numbers</h2>
<ul>
<li><a href='http://wp-themes.com/?p=19'>Worth A Thousand Words</a></li>
<li><a href='http://wp-themes.com/?p=36'>Elements</a></li>
<li><a href='http://wp-themes.com/?p=14'>More Tags</a></li>
<li><a href='http://wp-themes.com/?p=8'>HTML</a></li>
<li><a href='http://wp-themes.com/?p=6'>Links</a></li>
<li><a href='http://wp-themes.com/?p=4'>Category Hierarchy</a></li>
<li><a href='http://wp-themes.com/?p=1'>Hello world!</a></li>
</ul>
</div>

<div id="content">

<div class="post">

    <h2><?= $this->page->getTitle() ?></h2>

    <div class="date"><small>autore data </small></div>

    <div class="entry">

         <?= $this->page->getBody() ?>

    </div>

</div>

<?php

echo "<br><br>Pages<br>";
foreach($this->pages  as $one) {
    echo '<a href="'.URIMaker::page($one).'"> '.$one->getTitle()." </a><br>";
}

?>
