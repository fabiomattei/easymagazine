<div id="sidebar">


      <h2>About this Magazine</h2>

      <p class="news">
          A little something about you, the author. Nothing lengthy, just an overview.
      </p>

<h2>Lasts Numbers</h2>
<ul>
    <? foreach ($this->numbers as $num) {
           echo '<li><a href="'.URIMaker::number($num).'">'.$num->getTitle().'</a></li>';
       }?>
</ul>
</div>

<div id="content">

<div class="post">

    <h1>People</h1>

    <? foreach($this->people  as $user) { ?>

    <div class="date"><small><?= $user->getName() ?></small></div>

    <div class="entry">

               riassuntino

    </div>

    <? } ?>

</div>


<?php

echo "<img src=\"contents/templates/default/example.png\">";

?>
