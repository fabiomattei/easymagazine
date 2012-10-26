<?php

/*
    Copyright (C) 2009-2012  Fabio Mattei <burattino@gmail.com>

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

require_once('router.php');

class TagRouter extends Router {

    public $pages;
    private $number;
    private $numbers;
    public $metadescritpion;
    public $metakeywords;
    public $title;
    public $categories;
    public $paginator;

    function loadData() {
        $arURI = $this->getArrayURI();
        $this->tag = $arURI['id'];

        if (isset($_GET['page']) && $_GET['page'] > 0){
            $page = $_GET['page'];
        } else {
            $page = 1;
        }

        $collection = Article::findByTag($this->tag);
        $this->paginator = new Paginator($collection, 10, 5);
        if (isset($_GET['page']) && $_GET['page'] > 0){
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $this->articles = $this->paginator->rowsToShow($page);

        $this->numbers = Number::findLastNPublished(10);
        $this->number = Number::findLastPublished();
        $this->categories = Category::findAllPublishedOrderedByIndexNumber();
        $this->pages = Page::findAllPublishedOrdered();
        $this->metadescritpion = $this->tag;
        $this->metakeywords = $this->tag;
        $this->title = Magazine::getMagazineTitle().': '.$this->tag;
    }

    function applyTemplate() {
        $this->getRemote()->executeCommandBeforeTag();

		// There is no need for a 404 page, in the worse case system return an empty page
        if (file_exists(TEMPLATEPATH.'tag.php')) {
            include (TEMPLATEPATH.'tag.php');
        } else if (file_exists(TEMPLATEPATH.'index.php')) {
                include (TEMPLATEPATH.'index.php');
        }

        $this->getRemote()->executeCommandAfterTag();
    }

    function applyMobileTemplate() {
        $this->getRemote()->executeCommandBeforeTag();

		// There is no need for a 404 page, in the worse case system return an empty page
        if (file_exists(MOBILETEMPLATEPATH.'tag.php')) {
            include (MOBILETEMPLATEPATH.'tag.php');
        } else if (file_exists(MOBILETEMPLATEPATH.'index.php')) {
                include (MOBILETEMPLATEPATH.'index.php');
        }

        $this->getRemote()->executeCommandAfterTag();
    }

    function  createCachePath() {
        return STARTPATH.'cached/'.'null.cache';
    }

    function  createMobileCachePath() {
        return STARTPATH.'cached/'.'null.cache';
    }

    function isCachable() {
        return false;
    }

}

?>