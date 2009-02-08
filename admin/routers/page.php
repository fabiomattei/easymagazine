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

include('router.php');

class PagesRouter extends Router {

    function loadData(){
        if (file_exists(CONTROLLERPATH.'/index.php')) {
            include (CONTROLLERPATH.'/index.php');
        }
    }

    function applyTemplate(){
        if (file_exists(TEMPLATEPATH.'/page.php')) {
            include (TEMPLATEPATH.'/page.php');
        }

        if (file_exists(TEMPLATEPATH.'/index.php')) {
            include (TEMPLATEPATH.'/index.php');
        }
    }

}

?>
