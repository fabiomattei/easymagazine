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

class UserFilterRemote {

    private static $instance = null;

    public function __construct() {
        $this->filtersGetBody = array();
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

    public function addFiltersGetBody($filterCommand) {
        $this->filtersGetBody[] = $filterCommand;
    }

    public function executeFiltersBody($string){
        foreach ($this->filtersGetBody as $filterCommand) {
            $string = $filterCommand->execute($string);
        }
        return $string;
    }
}
?>
