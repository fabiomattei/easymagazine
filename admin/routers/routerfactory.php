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

include('rindex.php');
include('comments.php');
include('page.php');
include('article.php');

class RouterFactory {

    public function createRouter($request) {
        $out = null;

        if ($request == "index") $out = new IndexRouter();

        if ($request == "comments") $out = new CommentsRouter();

        if ($request == "page") $out = new PagesRouter();

        if ($request == "article") $out = new ArticlesRouter();

        return $out;
    }
    
}

?>
