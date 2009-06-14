<?php

/*
    Copyright (C) 2009  Fabio Mattei

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

echo $this->number->getTitle()."<br>";

echo "<br><br>Articles of easytemplate<br>";

foreach($this->number->articles()  as $article) {
    echo '<a href="'.URIMaker::article($article).'"> '.$article->getTitle()." </a><br>";
}

echo "<br><br>Pages<br>";
foreach($this->pages  as $page) {
    echo '<a href="'.URIMaker::page($page).'"> '.$page->getTitle()." </a><br>";
}


?>
