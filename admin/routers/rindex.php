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
require_once(STARTPATH.DATAMODELPATH.'/number.php');
require_once(STARTPATH.DATAMODELPATH.'/category.php');
require_once(STARTPATH.DATAMODELPATH.'/page.php');
require_once(STARTPATH.UTILSPATH.'/social.php');

class IndexRouter extends Router {

    private $number;
    public $pages;
    private $numbers;
    public $metadescritpion;
    public $metakeywords;
    public $title;
    public $categories;

    function loadData(){
        $this->number = Number::findLastPublished();
        $this->numbers = Number::findLastNPublished(10);
        $this->categories = Category::findAllPublishedOrderedByIndexNumber();
        $this->pages = Page::findAllPublishedOrdered();
        $this->metadescritpion = $this->number->getMetadescription();
        $this->metakeywords = $this->number->getMetakeyword();
        $this->title = Magazine::getMagazineTitle().': '.$this->number->getTitle();
    }

    function applyTemplate(){
        $this->getRemote()->executeCommandBeforeIndex();

		// There is no need for a 404 page, the index page MUST exist
        if (file_exists(TEMPLATEPATH.'index.php')) {
            include (TEMPLATEPATH.'index.php');
        }

        $this->getRemote()->executeCommandAfterIndex();
    }

    function applyMobileTemplate(){
        $this->getRemote()->executeCommandBeforeIndex();

		// There is no need for a 404 page, the index page MUST exist
        if (file_exists(MOBILETEMPLATEPATH.'index.php')) {
            include (MOBILETEMPLATEPATH.'index.php');
        }

        $this->getRemote()->executeCommandAfterIndex();
    }

    function createCachePath() {
        return STARTPATH.'cached/'.'index.cache';
    }

    function createMobileCachePath() {
        return STARTPATH.'cached/'.'mindex.cache';
    }

    function isCachable() {
        return true;
    }

}

?>
