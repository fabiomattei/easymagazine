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

class NumberRouter extends Router {

    public $pages;
    private $number;
    private $numbers;
    public $metadescritpion;
    public $metakeywords;
    public $title;
    public $categories;

    function loadData(){
        $arURI = $this->getArrayURI();
        $this->number = Number::findById($arURI['id']);
        $this->numbers = Number::findLastNPublished(10);
        $this->categories = Category::findAllPublishedOrderedByIndexNumber();
        $this->pages = Page::findAllPublishedOrdered();
        $this->metadescritpion = $this->number->getMetadescription();
        $this->metakeywords = $this->number->getMetakeyword();
        $this->title = Magazine::getMagazineTitle().': '.$this->number->getTitle();
    }

    function applyTemplate(){
        $this->getRemote()->executeCommandBeforeNumber();

		if ($this->number->getId()==Number::NEW_NUMBER) {
			// There is no number to load, redirect to 404 page
			include (TEMPLATEPATH.'404.php');
		} else {
 	        if (file_exists(TEMPLATEPATH.'number.php')) {
	            include (TEMPLATEPATH.'number.php');
	        } else if (file_exists(TEMPLATEPATH.'index.php')) {
	            include (TEMPLATEPATH.'index.php');
	        }
		}

        $this->getRemote()->executeCommandAfterNumber();
    }

    function createCachePath() {
        $arURI = $this->getArrayURI();
        return STARTPATH.'cached/'.'number'.$arURI['id'].'.cache';
    }

    function isCachable() {
        return true;
    }

}

?>
