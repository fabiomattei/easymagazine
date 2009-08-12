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
$SQL = 'insert into links (title, text, url) values (?, ?, ?)';
$array_str = array($post['title'], $post['text'], $post['url']);
$array_int = array();

$rs = DB::getInstance()->execute(
    $SQL,
    $array_str,
    $array_int,
    $tables);

    $title = $post['title'];
    $text = $post['text'];
    $url = $post['url'];

echo '<a href="'.STARTPATH.ADMINCONTROLLERPUBLISHERPATH.'plugin.php?action=general&pluginname=linkmanager&destiantionfilename=new.php">New</a>';


?>

<form name="form1" enctype="multipart/form-data" method="post" action="<?=STARTPATH.ADMINCONTROLLERPUBLISHERPATH.'plugin.php?action=general&pluginname=linkmanager&destiantionfilename=admin.php'?>">
    <table class="listing form" cellpadding="0" cellspacing="0">
        <tr>
            <th class="full" colspan="2">Data Inserted</th>
        </tr>
        <tr>
            <td class="first" width="172"><strong>Title</strong></td>
            <td class="last"><?=$title?></td>
        </tr>
        <tr class="bg">
            <td class="first"><strong>Text</strong></td>
            <td class="last"><?=$text?></td>
        </tr>
        <tr class="bg">
            <td class="first"><strong>Url</strong></td>
            <td class="last"><?=$url?></td>
        </tr>
        <tr class="bg">
            <td class="first"><strong>&nbsp;</strong></td>
        <td class="last"><input type="submit" value="Ok" name="Ok" /></td>
        </tr>
    </table>
</form>