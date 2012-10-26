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

require_once(STARTPATH.UTILSPATH.'stringfilters.php');

class URIMaker {
    static function article($article) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'articles/'.StringFilter::cleanStringForUrl($article->getTitle()).'/'.$article->getId();
    }

    static function category($category) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'category/'.StringFilter::cleanStringForUrl($category->getName()).'/'.$category->getId();
    }

    static function tag($tag) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'tag/'.StringFilter::cleanStringForUrl($tag).'/';
    }

    static function number($number) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'numbers/'.StringFilter::cleanStringForUrl($number->getTitle()).'/'.$number->getId();
    }

    static function comment($article) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'comments/'.StringFilter::cleanStringForUrl($article->getTitle()).'/'.$article->getId();
    }

    static function result() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'results/';
    }

    static function numberslist() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'numberslist/';
    }

    static function page($page) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'pages/'.StringFilter::cleanStringForUrl($page->getTitle()).'/'.$page->getId();
    }

    static function articlesperson($person) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'articlesperson/'.StringFilter::cleanStringForUrl($person->getName()).'/'.$person->getId();
    }

    static function people() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'people/';
    }

    static function index() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER;
    }

    static function loginPage() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'admin/login.php';
    }

    static function fromBasePath($path) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.$path;
    }

    static function templatePath($path) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.TEMPLATEPATH.$path;
    }

    static function rssFeed() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'contents/feed/feed.xml';
    }

    static function pluginPage($plugin, $script, $variablesGet = '') {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'plugin/'.$plugin.'/'.$script.$variablesGet;
    }

}

?>