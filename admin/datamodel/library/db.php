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

require_once(STARTPATH.SYSTEMPATH.'config.php');
require_once(STARTPATH.DBPATH.'strfunction.php');

class DB {
    private static $instance = null;
    private $connection;
    private $error;
    private $countLastQueryResults = 0;

    private function __construct() {
        $this->connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
        mysql_select_db(DB_NAME, $this->connection);
    }

    public static function getInstance() {
        if(self::$instance == null) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }

    public function execute($SQL, $array_str, $array_int , $tables) {
        $toSQL = StrHelper::formatQRY($SQL, $array_str, $array_int, $tables);
        $result = mysql_query($toSQL, $this->connection);
        if (!$result) {
            $this->countLastQueryResults = 0;
            $this->error=mysql_error();
            throw new Exception('Error in DB.'.$toSQL);
        } else {
            $this->error='';
            if (strlen(strstr(strtolower($toSQL),'select'))>0) {
                $this->countLastQueryResults = mysql_num_rows($result);
            } else {
                $this->countLastQueryResults = 0;
            }
        }
        return $result;
    }

    public function getErrorMsg() {
        return $this->error;
    }

    public function getTablePrefix() {
        return TBPREFIX;
    }

    public function getCountLastQueryResults() {
        return $this->countLastQueryResults;
    }

}

?>