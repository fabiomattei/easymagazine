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
        <h1>#<?= $this->number->getIndexnumber() ?>. <?= $this->number->getTitle() ?></h1>
        <h3><?= $this->number->getSubtitle() ?></h3>
        <? foreach($this->number->articlesPublished()  as $article) : ?>
        <h4><a href="<?=URIMaker::article($article)?>" rel="bookmark"><?= $article->getTitle() ?></a></h4>

        <div id="articleSummary">
                <?= $article->getCreatedFormatted() ?>  by
                <?
                foreach ($article->users() as $user) :
                    echo $user->getName().' ';
                endforeach;
                ?> |
                <? echo '<a href="'.URIMaker::comment($article).'"> comments ('.count($article->commentsPublished()).') </a>'; ?>
        </div>

        <div id="articleBody">
                <?= $article->getSummary() ?>
        </div>
        <? endforeach; ?>
    </div>

</div>
