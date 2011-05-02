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

class PeopleRouter extends Router {

    private $people;
    public $pages;
    private $numbers;
    public $metadescritpion;
    public $metakeywords;
    public $number;
    public $categories;

    function loadData() {
        $arURI = $this->getArrayURI();
        $this->people = User::findAllToShow();
        $this->pages = Page::findAllPublishedOrdered();
        $this->numbers = Number::findLastNPublished(10);
        $this->categories = Category::findAllPublishedOrderedByIndexNumber();
        $this->number = Number::findLastPublished();
        
        foreach ($this->people as $person) {
            /* @var $person User */
            $this->metadescritpion .= $person->getName().', ';
            $this->metakeywords .= $person->getName().', ';
        }
        $this->metadescritpion = substr($this->metadescritpion, 0, strlen($this->metadescritpion)-2);
        $this->metakeywords = substr($this->metakeywords, 0, strlen($this->metakeywords)-2);
        $this->title = Magazine::getMagazineTitle().': People';
    }

    function applyTemplate() {
        $this->getRemote()->executeCommandBeforePeople();

		// There is no need for a 404 page, in the worse case system return an empty page
        if (file_exists(TEMPLATEPATH.'people.php')) {
            include (TEMPLATEPATH.'people.php');
        } else if (file_exists(TEMPLATEPATH.'index.php')) {
            include (TEMPLATEPATH.'index.php');
        }

        $this->getRemote()->executeCommandAfterPeople();
    }

    function  createCachePath() {
        return STARTPATH.'cached/'.'people.cache';
    }

    function isCachable() {
        return true;
    }

}

?>