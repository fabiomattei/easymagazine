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

class URIMaker {
    static function article($article) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'articles/'.$article->getTitle().'/'.$article->getId();
    }

    static function number($number) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'numbers/'.$number->getTitle().'/'.$number->getId();
    }

    static function comment($article) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'comments/'.$article->getTitle().'/'.$article->getId();
    }

    static function result() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'results/';
    }

    static function page($page) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'pages/'.$page->getTitle().'/'.$page->getId();
    }

    static function articlesperson($person) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'articlesperson/'.$person->getName().'/'.$person->getId();
    }

    static function people() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.'people/';
    }

    static function index() {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER;
    }

    static function fromBasePath($path) {
        return 'http://'.$_SERVER['HTTP_HOST'].FOLDER.$path;
    }
}

?>