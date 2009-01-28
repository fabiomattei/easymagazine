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

include ('../../../config.php');
include ('strfunction.php');

class DB {
    private static $instance = null;
    private $connection;
    private $error;

    private function __construct() {
        $connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
        mysql_select_db(DB_NAME, $connection);
    }

    public static function getInstance() {
        if(self::$instance == null) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }

    public function execute($SQL, $array) {
        $toSQL = StrHelper::replaceOccorrences($SQL, $array);
        $result = mysql_query($toSQL, $this->connection);
        if (!$result) {
            $this->error=mysql_error();
        } else {
            $this->error='';
        }
        return $result;
    }

    public function getErrorMsg() {
        return $this->error;
    }

    public function getTablePrefix() {
        return $table_prefix;
    }
}


?>
