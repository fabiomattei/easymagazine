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
require_once(STARTPATH.LIBPATH.'/securimage/securimage.php');

require_once('router.php');

require_once(STARTPATH.CONTROLLERPATH.'all_controllers_commons.php');
AllControllersCommons::loadlanguage();

class CommentsRouter extends Router {

    public $article;
    public $pages;
    public $numbers;
    public $metadescritpion;
    public $metakeywords;
    public $advice;
    public $title;
    public $number;
    public $categories;

    public $postedsignature;
    public $postedtitle;
    public $postedbody;

    function loadData() {
        $arURI = $this->getArrayURI();
        $this->article = Article::findById($arURI['id']);
        $this->number = $this->article->number();
        $this->numbers = Number::findLastNPublished(10);
        $this->categories = Category::findAllPublishedOrderedByIndexNumber();
        $this->pages = Page::findAllPublishedOrdered();
        $this->metadescritpion = $this->article->getMetadescription();
        $this->metakeywords = $this->article->getMetakeyword();
        $this->title = Magazine::getMagazineTitle().': '.$this->article->getTitle();

        $this->postedsignature = '';
        $this->postedtitle = '';
        $this->postedbody = '';

        if ($this->article->getCommentsallowed() && $this->article->number()->getCommentsallowed()) {

            $img = new Securimage();
            if (isset($_POST['code'])) {
                $valid = $img->check($_POST['code']);
                if($valid == true) {
                    $cont = 0;
                    if (isset($_POST['Title']) && $_POST['Title']!='') $cont++;
                    if (isset($_POST['Body']) && $_POST['Body']!='') $cont++;
                    if (isset($_POST['Signature']) && $_POST['Signature']!='') $cont++;

                    if ($cont == 3) {
                        $published = 0;
                        $com = new Comment(
                            Comment::NEW_COMMENT,
                            $arURI['id'],
                            $_POST['Title'],
                            $published,
                            $_POST['Body'],
                            $_POST['Signature']);
                        $com->save();
                        $this->advice = LANG_ROUTER_COMMENT_COMSAVED;
                    }
                    if ($cont < 3 && $cont >= 0) {
                        $this->advice = LANG_ROUTER_COMMENT_FILL_ALL_FIELDS;
                        $this->postedsignature = $_POST['Signature'];
                        $this->postedtitle = $_POST['Title'];
                        $this->postedbody = $_POST['Body'];
                    }
                } else {
                    $this->advice = LANG_ROUTER_COMMENT_WRITE_CAPTCHA;
                    $this->postedsignature = $_POST['Signature'];
                    $this->postedtitle = $_POST['Title'];
                    $this->postedbody = $_POST['Body'];
                }
            }
        } else {
            $this->advice = LANG_ROUTER_COMMENT_COM_NOT_ALLOWED;
        }
    }

    function applyTemplate() {
        $this->getRemote()->executeCommandBeforeComments();

		if ($this->article->getId()==Article::NEW_ARTICLE) {
			// There is no article to load, redirect to 404 page
			include (TEMPLATEPATH.'404.php');
		} else {
	        if (file_exists(TEMPLATEPATH.'comments.php')) {
	            include (TEMPLATEPATH.'comments.php');
	        } else if (file_exists(TEMPLATEPATH.'index.php')) {
	            include (TEMPLATEPATH.'index.php');
	        }
		}

        $this->getRemote()->executeCommandAfterComments();
    }

    function  createCachePath() {
        return '';
    }

    function isCachable() {
        return false;
    }

}

?>