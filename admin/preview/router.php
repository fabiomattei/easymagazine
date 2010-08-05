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

require_once(STARTPATH.URIPATH.'/urimakerfake.php');

require_once(STARTPATH.COMMANDPATH.'/remote.php');
require_once(STARTPATH.DATAMODELPATH.'/magazine.php');
require_once(STARTPATH.UTILSPATH.'/taghandler.php');
require_once(STARTPATH.SYSTEMPATH.'templateIncluder.php');
require_once(STARTPATH.SYSTEMPATH.'settings.php');
require_once(STARTPATH.SYSTEMPATH.'config.php');
#require_once(STARTPATH.SYSTEMPATH.'pluginIncluder.php');

abstract class Router {
    private $remote;
    private $arrayURY;

    public function  __construct($arrayURI) {
        $this->arrayURY = $arrayURI;
        $this->remote = Remote::getInstance();
    }

    public abstract function applyTemplate();

    public abstract function loadData();

    public function show(){
        $this->loadData();

        $this->remote->executeCommandBeforeHeader();
        $this->header();
        $this->remote->executeCommandAfterHeader();

        $this->applyTemplate();

        $this->remote->executeCommandBeforeFooter();
        $this->footer();
        $this->remote->executeCommandAfterFooter();
    }

    public function header() {
        include(STARTPATH.'admin/view/common/toppreview.php');
        if (file_exists(STARTPATH.TEMPLATEPATH.'header.php')) {
            include (STARTPATH.TEMPLATEPATH.'header.php');
        }
    }

    public function footer() {
        if (file_exists(STARTPATH.TEMPLATEPATH.'footer.php')) {
            include (STARTPATH.TEMPLATEPATH.'footer.php');
        }
    }

    public function getArrayURI() {
        return $this->arrayURY;
    }

    public function getRemote() {
        return $this->remote;
    }
}

?>