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

class PeopleRouter extends Router {

    private $people;
    private $pages;
    private $numbers;
    public $metadescritpion;
    public $metakeywords;

    function loadData() {
        $arURI = $this->getArrayURI();
        $this->people = User::findAll();
        $this->pages = Page::findAllPublished();
        $this->numbers = Number::findAllPublishedOrderedByIndexNumber();
        foreach ($this->people as $person) {
            $this->metadescritpion = $person->getName.', ';
            $this->metakeywords = $person->getName.', ';
        }
    }

    function applyTemplate() {
        $this->getRemote()->executeCommandBeforeArticle();
        if (file_exists(TEMPLATEPATH.'/people.php')) {
            include (TEMPLATEPATH.'/people.php');
        } else if (file_exists(TEMPLATEPATH.'/index.php')) {
                include (TEMPLATEPATH.'/index.php');
            }
        $this->getRemote()->executeCommandAfterArticle();
    }

}

?>
