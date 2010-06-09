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

require_once(STARTPATH.DATAMODELPATH.'/article.php');
require_once(STARTPATH.DATAMODELPATH.'/page.php');
require_once(STARTPATH.DATAMODELPATH.'/number.php');
require_once(STARTPATH.UTILSPATH.'/paginator.php');

require_once('router.php');

class ResultsRouter extends Router {

    public $pages;
    private $numbers;
    public $metadescritpion;
    public $metakeywords;
    public $advice;
    public $title;
    public $number;
    public $categories;
    public $querystring;

    function loadData() {
        $arURI = $this->getArrayURI();
        $this->number = Number::findLastPublished();
        $this->numbers = Number::findLastNPublished(10);
        $this->categories = Category::findAllPublishedOrderedByIndexNumber();
        $this->pages = Page::findAllPublishedOrdered();

        if (isset($_POST['s']) && $_POST['s']!='') {
            $collection = Article::findInAllTextFieldsInPublishedArticles($_POST['s']);
            $_SESSION['paginator'] = new Paginator($collection, 10, 5);
            $this->articles = $_SESSION['paginator']->rowsToShow(1);
            $_SESSION['s'] = $_POST['s'];
            $this->querystring = $_POST['s'];
            $this->title = LANG_ROUTER_SEARCH_RESULTS_FOR.$_POST['s'];
            $this->metadescritpion = LANG_ROUTER_SEARCH_RESULTS_FOR.$_POST['s'];
            $this->metakeywords = LANG_ROUTER_SEARCH_RESULTS_FOR.$_POST['s'];
            $resultsNumber = count($this->articles);
        } else {
            if (isset($_SESSION['paginator']) && isset($_GET['page'])) {
                $this->articles = $_SESSION['paginator']->rowsToShow($_GET['page']);
                $this->title = LANG_ROUTER_SEARCH_RESULTS_FOR.$_SESSION['s'];
                $this->metadescritpion = LANG_ROUTER_SEARCH_RESULTS_FOR.$_SESSION['s'];
                $this->metakeywords = LANG_ROUTER_SEARCH_RESULTS_FOR.$_SESSION['s'];
                $this->querystring = $_SESSION['s'];
                $resultsNumber = count($this->articles);
            } else {
                $this->articles = array();
                $_SESSION['paginator'] = new Paginator(array(), 1);
                $this->title = LANG_ROUTER_SEARCH_NO_RESULTS;
                $this->metadescritpion = LANG_ROUTER_SEARCH_NO_RESULTS;
                $this->metakeywords = LANG_ROUTER_SEARCH_NO_RESULTS;
                $this->querystring = '';
                $resultsNumber = 0;
            }
        }

        if ($resultsNumber > 0) {
            $this->advice = LANG_ROUTER_SEARCH_RESULTS;
        }
        if ($resultsNumber == 0) {
            $this->advice = LANG_ROUTER_SEARCH_NO_MATCHES;
        }
    }

    function applyTemplate() {
        $this->getRemote()->executeCommandBeforeResults();
        if (file_exists(TEMPLATEPATH.'/results.php')) {
            include (TEMPLATEPATH.'/results.php');

        } else if (file_exists(TEMPLATEPATH.'/index.php')) {
                include (TEMPLATEPATH.'/index.php');

            }
        $this->getRemote()->executeCommandAfterResults();
    }

}

?>