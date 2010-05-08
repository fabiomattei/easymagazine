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

require_once(STARTPATH.DATAMODELPATH.'/user.php');
require_once(STARTPATH.DATAMODELPATH.'/page.php');

require_once('router.php');

class ArticlesPersonRouter extends Router {

    private $person;
    public $pages;
    private $numbers;
    public $metadescritpion;
    public $metakeywords;
    public $title;
    public $number;
    public $categories;

    function loadData() {
        $arURI = $this->getArrayURI();
        $this->person = User::findById($arURI['id']);
        $this->pages = Page::findAllPublishedOrdered();
        $this->numbers = Number::findLastNPublished(10);
        $this->categories = Category::findAllPublishedOrderedByIndexNumber();
        $this->number = Number::findLastPublished();
        $this->metadescritpion = $this->person->getName();
        $this->metakeywords = $this->person->getName();

        $collection = $this->person->articles();
        $this->paginator = new Paginator($collection, 10, 5);
        if (isset($_GET['page']) && $_GET['page'] > 0){
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $this->articles = $this->paginator->rowsToShow($page);

        $this->metadescritpion = substr($this->metadescritpion, 0, strlen($this->metadescritpion)-2);
        $this->metakeywords = substr($this->metakeywords, 0, strlen($this->metakeywords)-2);
        $this->title = Magazine::getMagazineTitle().': '.$this->person->getName();
    }

    function applyTemplate() {
        $this->getRemote()->executeCommandBeforeArticlesPerson();
        if (file_exists(TEMPLATEPATH.'/articlesperson.php')) {
            include (TEMPLATEPATH.'/articlesperson.php');
        } else if (file_exists(TEMPLATEPATH.'/index.php')) {
                include (TEMPLATEPATH.'/index.php');
            }
        $this->getRemote()->executeCommandAfterArticlesPerson();
    }

}

?>