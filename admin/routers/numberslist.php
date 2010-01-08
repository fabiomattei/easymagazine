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

require_once(STARTPATH.DATAMODELPATH.'/user.php');
require_once(STARTPATH.DATAMODELPATH.'/page.php');

require_once('router.php');

class NumberListRouter extends Router {

    public $pages;
    private $numbers;
    public $metadescritpion;
    public $metakeywords;
    public $number;
    public $categories;
    public $numberslist;

    function loadData() {
        $arURI = $this->getArrayURI();
        $collection = Number::findAllPublishedOrderedByIndexNumber();
        $this->paginator = new Paginator($collection, 10, 5);
        if (isset($_GET['page']) && $_GET['page'] > 0){
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $this->numberslist = $this->paginator->rowsToShow($page);
        $this->pages = Page::findAllPublishedOrdered();
        $this->numbers = Number::findLastNPublished(10);
        $this->categories = Category::findAllPublishedOrderedByIndexNumber();
        $this->number = Number::findLastPublished();
        $this->metadescritpion = $this->numberslist[0]->getMetadescription();
        $this->metakeywords = $this->numberslist[0]->getMetakeyword();
        $this->title = Magazine::getMagazineTitle().': Numbers List';
    }

    function applyTemplate() {
        $this->getRemote()->executeCommandBeforeArticle();
        if (file_exists(TEMPLATEPATH.'/numberslist.php')) {
            include (TEMPLATEPATH.'/numberslist.php');
        } else if (file_exists(TEMPLATEPATH.'/index.php')) {
                include (TEMPLATEPATH.'/index.php');
            }
        $this->getRemote()->executeCommandAfterArticle();
    }

}

?>
