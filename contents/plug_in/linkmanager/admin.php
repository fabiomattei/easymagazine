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

require_once(STARTPATH.DBPATH.'db.php');

$tables = array("links" => TBPREFIX."links");
$SQL = 'SELECT * FROM '.TBPREFIX.'links ';
$array_str = array();
$array_int = array();

$rs = DB::getInstance()->execute(
    $SQL,
    $array_str,
    $array_int,
    $tables);

if ($rs) {
    while ($row = mysql_fetch_array($rs)) {
        echo $row['id'].' - '.$row['title'].' - '.$row['text'].' - '.$row['url'].'<br />';
    }
}

echo 'Database activated';


?>
