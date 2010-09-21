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
        return '#';
    }

    static function number($number) {
        return '#';
    }

    static function category($category) {
        return '#';
    }

    static function tag($tag) {
        return '#';
    }

    static function comment($article) {
        return '#';
    }

    static function result() {
        return '#';
    }

    static function page($page) {
        return '#';
    }

    static function people() {
        return '#';
    }

    static function numberslist() {
        return '#';
    }

    static function articlesperson($person) {
        return '#';
    }

    static function index() {
        return '#';
    }

    static function loginPage() {
        return '#';
    }

    static function fromBasePath($path) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.$path;
    }

    static function templatePath($path) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.TEMPLATEPATH.$path;
    }

    static function rssFeed() {
        return '#';
    }

    static function pluginPage($plugin, $script, $variablesGet = '') {
        return '#';
    }

}

?>