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

require_once(STARTPATH.DATAMODELPATH.'/article.php');
require_once(STARTPATH.DATAMODELPATH.'/page.php');
require_once(STARTPATH.LIBPATH.'/securimage/securimage.php');

require_once('router.php');

class CommentsRouter extends Router {

    private $article;
    public $pages;
    private $numbers;
    public $metadescritpion;
    public $metakeywords;
    public $advice;
    public $title;
    public $number;
    public $categories;

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
                        $this->advice = 'Comment saved, it will be checked then published';
                    }
                    if ($cont < 3 && $cont > 0) {
                        $this->advice = 'Fill all the fields please';
                    }
                    if ($cont == 0) {
                        $this->advice = '';
                    }
                } else {
                    $this->advice = 'Please type the right Captcha';
                }
            }
        } else {
            $this->advice = 'Comments not allowed';
        }
    }

    function applyTemplate() {
        $this->getRemote()->executeCommandBeforeComments();
        if (file_exists(TEMPLATEPATH.'/comments.php')) {
            include (TEMPLATEPATH.'/comments.php');

        } else if (file_exists(TEMPLATEPATH.'/index.php')) {
                include (TEMPLATEPATH.'/index.php');

            }
        $this->getRemote()->executeCommandAfterComments();
    }

}

?>