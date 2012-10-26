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

require_once(STARTPATH.PREVIEWPATH.'page.php');
require_once(STARTPATH.PREVIEWPATH.'article.php');
require_once(STARTPATH.PREVIEWPATH.'number.php');

class RouterFactory {

    public function createRouter($request) {
        $out = null;

        if ($request['Router'] == "page") $out = new PagesRouter($request);

        if ($request['Router'] == "article") $out = new ArticlesRouter($request);

        if ($request['Router'] == "number") $out = new NumberRouter($request);

        return $out;
    }

}

?>
