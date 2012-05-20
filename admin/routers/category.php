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

require_once('router.php');

class CategoryRouter extends Router {

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
        $this->category = Category::findById($arURI['id']);

        $collection = $this->category->articlesPublished();
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
        $this->metadescritpion = $this->category->getdescription();
        $this->metakeywords = $this->category->getName();
        $this->title = Magazine::getMagazineTitle().': '.$this->category->getName();
    }

    function applyTemplate() {
        $this->getRemote()->executeCommandBeforeCategory();

		if ($this->category->getId()==Category::NEW_CATEGORY) {
			// There is no category to load, redirect to 404 page
			include (TEMPLATEPATH.'404.php');
		} else {
	        if (file_exists(TEMPLATEPATH.'category.php')) {
	            include (TEMPLATEPATH.'category.php');
	        } else if (file_exists(TEMPLATEPATH.'index.php')) {
	                include (TEMPLATEPATH.'index.php');
	        }
		}

        $this->getRemote()->executeCommandAfterCategory();
    }

    function applyMobileTemplate() {
        $this->getRemote()->executeCommandBeforeCategory();

		if ($this->category->getId()==Category::NEW_CATEGORY) {
			// There is no category to load, redirect to 404 page
			include (MOBILETEMPLATEPATH.'404.php');
		} else {
	        if (file_exists(MOBILETEMPLATEPATH.'category.php')) {
	            include (MOBILETEMPLATEPATH.'category.php');
	        } else if (file_exists(MOBILETEMPLATEPATH.'index.php')) {
	                include (MOBILETEMPLATEPATH.'index.php');
	        }
		}

        $this->getRemote()->executeCommandAfterCategory();
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