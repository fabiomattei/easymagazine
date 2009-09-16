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

class ArticlesPersonRouter extends Router {

    private $person;
    public $pages;
    private $numbers;
    public $metadescritpion;
    public $metakeywords;
    public $title;
    public $number;

    function loadData() {
        $arURI = $this->getArrayURI();
        $this->person = User::findById($arURI['id']);
        $this->pages = Page::findAllPublishedOrdered();
        $this->numbers = Number::findAllPublishedOrderedByIndexNumber();
        $this->number = Number::findLastPublished();
        foreach ($this->person as $person) {
            $this->metadescritpion .= $person->getName().', ';
            $this->metakeywords .= $person->getName().', ';
        }
        $this->metadescritpion = substr($this->metadescritpion, 0, strlen($this->metadescritpion)-2);
        $this->metakeywords = substr($this->metakeywords, 0, strlen($this->metakeywords)-2);
        $this->title = Magazine::getMagazineTitle().': '.$this->person->getName();
    }

    function applyTemplate() {
        $this->getRemote()->executeCommandBeforeArticle();
        if (file_exists(TEMPLATEPATH.'/articlesperson.php')) {
            include (TEMPLATEPATH.'/articlesperson.php');
        } else if (file_exists(TEMPLATEPATH.'/index.php')) {
                include (TEMPLATEPATH.'/index.php');
            }
        $this->getRemote()->executeCommandAfterArticle();
    }

}

?>