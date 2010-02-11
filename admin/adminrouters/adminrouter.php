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

require_once(STARTPATH.COMMANDPATH.'/remote.php');
require_once(STARTPATH.ROUTERPATH.'/router.php');


class AdminRouter extends Router{

    private $remote;

    public function  __construct() {
        $this->remote = Remote::getInstance();
    }

    public function data() {
    }

    public function show(){
        $this->remote->executeCommandBeforeIndex();
        $this->applyTemplate();
    }

    public function header() {
        if (file_exists(ADMINPATH.'/header.php')) {
            include (ADMINPATH.'/header.php');
        }
    }

    public function footer() {
        if (file_exists(ADMINPATH.'/footer.php')) {
            include (ADMINPATH.'/footer.php');
        }
    }

}

?>

