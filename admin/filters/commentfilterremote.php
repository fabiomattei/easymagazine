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

class CommentFilterRemote {

    private static $instance = null;

    public function __construct() {
        $this->filtersGetTitle = array();
        $this->filtersGetBody = array();
        $this->filtersGetSignature = array();
    }

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    public function addFiltersGetTitle($filterCommand) {
        $this->filtersGetTitle[] = $filterCommand;
    }

    public function executeFiltersTitle($string){
        foreach ($this->filtersGetTitle as $filterCommand) {
            $string = $filterCommand->execute($string);
        }
        return $string;
    }

    public function addFiltersGetBody($filterCommand) {
        $this->filtersGetBody[] = $filterCommand;
    }

    public function executeFiltersBody($string){
        foreach ($this->filtersGetBody as $filterCommand) {
            $string = $filterCommand->execute($string);
        }
        return $string;
    }

    public function addFiltersGetSignature($filterCommand) {
        $this->filtersGetSignature[] = $filterCommand;
    }

    public function executeFiltersSignature($string){
        foreach ($this->filtersGetSignature as $filterCommand) {
            $string = $filterCommand->execute($string);
        }
        return $string;
    }
}

?>
