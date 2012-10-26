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

require_once(STARTPATH.DBPATH.'db.php');

$tables = array("links" => TBPREFIX."links");
$SQL = 'CREATE TABLE '.TBPREFIX.'links (
           id int(11) NOT NULL auto_increment,
           title varchar(255),
           text varchar(255),
           url text,
           PRIMARY KEY (id));';
$array_str = array();
$array_int = array();

$rs = DB::getInstance()->execute(
    $SQL,
    $array_str,
    $array_int,
    $tables);


$SQL = "insert into ".TBPREFIX."links (id, title, text, url)
        values (0, 'My link', 'My link', 'http://www.easymagazine.org')";

$rs = DB::getInstance()->execute(
    $SQL,
    $array_str,
    $array_int,
    $tables);

echo 'Database activated';


?>
