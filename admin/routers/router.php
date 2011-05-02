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

require_once(STARTPATH . COMMANDPATH . '/remote.php');
require_once(STARTPATH . DATAMODELPATH . '/magazine.php');
require_once(STARTPATH . UTILSPATH . '/taghandler.php');

if (URLTYPE == 'optimized') {
    require_once(STARTPATH . URIPATH . '/urimakeroptimized.php');
} else {
    require_once(STARTPATH . URIPATH . '/urimakerstandard.php');
}

abstract class Router {

    private $remote;
    private $arrayURY;
    private $cachePath;

    public function __construct($arrayURI) {
        session_start();

        $this->arrayURY = $arrayURI;
        $this->remote = Remote::getInstance();
    }

    public abstract function applyTemplate();

    public abstract function loadData();

    public abstract function createCachePath();

    public abstract function isCachable();

    public function isCacheStillValid() {
        $timeout = 3600; // Seconds
        return file_exists($this->cachePath) and filemtime($this->cachePath) + $timeout > time();
    }

    public function show() {
        if ($this->isCachable()) {
            $this->cachePath = $this->createCachePath();
            if ($this->isCacheStillValid()) {
                $result = readfile($this->cachePath);
            } else {
                $this->builtPage();
            }
        } else {
            $this->builtPageNoCache();
        }
    }

    /**
     * It builds tha page and save the correspondig cache file
     */
    public function builtPage() {
        ob_start();

        $this->builtPageNoCache();

        $output = ob_get_flush();

        $fp = fopen($this->cachePath, "w");
        fwrite($fp, $output, strlen($output));
        fclose($fp);
    }

    /**
     * It builds tha page and save the correspondig cache file
     */
    public function builtPageNoCache() {
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
        if (file_exists(TEMPLATEPATH . 'header.php')) {
            include (TEMPLATEPATH . 'header.php');
        }
    }

    public function footer() {
        if (file_exists(TEMPLATEPATH . 'footer.php')) {
            include (TEMPLATEPATH . 'footer.php');
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