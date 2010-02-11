<?php

/*
    Copyright (C) 2009-2010  Fabio Mattei <burattino@gmail.com>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

?>

<div id="content">

    <!-- 3. Sidebar -->

    <?php include("sidebar.php");?>
    <!-- 4. Magazine Main Content -->

    <div id="main_content">
        <? foreach($this->numberslist  as $nu) : ?>
        <h2><a href="<?= URIMaker::number($nu) ?>"><?= $nu->getTitle() ?></a></h2>
        <h3><?= $nu->getSubtitle() ?></h3>
        <div id="numberSummary">
                <?= $nu->getSummary() ?>
        </div>
            <? if ($nu->epubExists()) : ?>
        <div id="epub">
            <a href="<?= URIMaker::fromBasePath($nu->epubPath()) ?>">Download Epub</a>
        </div>
            <? endif; ?>
        <? endforeach; ?>

        <div id="paginator">
            <?= $this->paginator->renderFullNav(URIMaker::numberslist())  ?>
        </div>
    </div>

</div>