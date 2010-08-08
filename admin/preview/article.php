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

require_once(STARTPATH.DATAMODELPATH.'article.php');
require_once(STARTPATH.DATAMODELPATH.'page.php');

require_once('router.php');

class ArticlesRouter extends Router {

    private $article;
    public $pages;
    private $numbers;
    public $metadescritpion;
    public $metakeywords;
    public $title;
    public $number;
    public $categories;

    function loadData(){
        $arURI = $this->getArrayURI();
        $this->article = Article::findById($arURI['id']);
        $this->numbers = Number::findLastNPublished(10);
        $this->categories = Category::findAllPublishedOrderedByIndexNumber();
        $this->number = $this->article->number();
        $this->pages = Page::findAllPublishedOrdered();
        $this->metadescritpion = $this->article->getMetadescription();
        $this->metakeywords = $this->article->getMetakeyword();
        $this->title = Magazine::getMagazineTitle().': '.$this->article->getTitle();
    }

    function applyTemplate(){
        $this->getRemote()->executeCommandBeforeArticle();
        if (file_exists(STARTPATH.TEMPLATEPATH.'article.php')) {
            include (STARTPATH.TEMPLATEPATH.'article.php');
        }
        $this->getRemote()->executeCommandAfterArticle();
    }

}

?>
