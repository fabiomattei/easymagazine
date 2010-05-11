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

class URIMaker {
    static function article($article) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'index.php?p=article&id='.$article->getId();
    }

    static function number($number) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'index.php?p=number&id='.$number->getId();
    }

    static function category($category) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'index.php?p=category&id='.$category->getId();
    }

    static function comment($article) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'index.php?p=comments&id='.$article->getId();
    }

    static function result() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'index.php?p=results';
    }

    static function page($page) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'index.php?p=page&id='.$page->getId();
    }

    static function people() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'index.php?p=people';
    }

    static function numberslist() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'index.php?p=numberslist';
    }

    static function articlesperson($person) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'index.php?p=articlesperson&id='.$person->getId();
    }

    static function index() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'index.php';
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
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'index.php?plugin='.$plugin.'&script='.$script.$variablesGet;
    }

}

?>