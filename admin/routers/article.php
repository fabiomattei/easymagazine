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

require_once(STARTPATH.DATAMODELPATH.'/article.php');
require_once(STARTPATH.DATAMODELPATH.'/page.php');
require_once(STARTPATH.UTILSPATH.'/social.php');

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

		if ($this->article->getId()==Article::NEW_ARTICLE) {
			// There is no article to load, redirect to 404 page
			include (TEMPLATEPATH.'404.php');
		} else {
            if (file_exists(TEMPLATEPATH.'article.php')) {
                include (TEMPLATEPATH.'article.php');
            } else if (file_exists(TEMPLATEPATH.'index.php')) {
                include (TEMPLATEPATH.'index.php');
            }
		}
		
        $this->getRemote()->executeCommandAfterArticle();
    }

    function applyMobileTemplate(){
        $this->getRemote()->executeCommandBeforeArticle();

		if ($this->article->getId()==Article::NEW_ARTICLE) {
			// There is no article to load, redirect to 404 page
			include (MOBILETEMPLATEPATH.'404.php');
		} else {
            if (file_exists(MOBILETEMPLATEPATH.'article.php')) {
                include (MOBILETEMPLATEPATH.'article.php');
            } else if (file_exists(MOBILETEMPLATEPATH.'index.php')) {
                include (MOBILETEMPLATEPATH.'index.php');
            }
		}
		
        $this->getRemote()->executeCommandAfterArticle();
    }

    function  createCachePath() {
        $arURI = $this->getArrayURI();
        return STARTPATH.'cached/'.'article'.$arURI['id'].'.cache';
    }

    function  createMobileCachePath() {
        $arURI = $this->getArrayURI();
        return STARTPATH.'cached/'.'marticle'.$arURI['id'].'.cache';
    }

    function isCachable() {
        return true;
    }

}

?>
