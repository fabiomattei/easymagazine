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

require_once(STARTPATH.DBPATH.'db.php');

$tables = array("links" => TBPREFIX."links");
$SQL = 'SELECT * FROM links ';
$array_str = array();
$array_int = array();

$rs = DB::getInstance()->execute(
    $SQL,
    $array_str,
    $array_int,
    $tables);

?>


<table class="listing form" cellpadding="0" cellspacing="0">
     <tr>
            <th class="full" colspan="2">Link list</th>
     </tr>
    <?
    if ($rs) {
        while ($row = mysql_fetch_array($rs)) { ?>
    <tr>
        <td class="first" width="172">
                    <?
                    echo $row['id'].' - '.$row['title'].' - '.$row['text'].' - '.$row['url'].' |
             <a href="'.STARTPATH.ADMINCONTROLLERPUBLISHERPATH.'plugin.php?action=general&pluginname=linkmanager&destiantionfilename=modify.php&id='.$row['id'].'">Modify</a> |
             <a href="'.STARTPATH.ADMINCONTROLLERPUBLISHERPATH.'plugin.php?action=general&pluginname=linkmanager&destiantionfilename=delete.php&id='.$row['id'].'">Delete</a><br />';
                    ?>

                <?     }
            }
            ?>
    <tr>
        <td class="first" width="172">
            <?
            echo '<a href="'.STARTPATH.ADMINCONTROLLERPUBLISHERPATH.'plugin.php?action=general&pluginname=linkmanager&destiantionfilename=new.php">New</a>';
            ?>
        </td>
    </tr>
</table>