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

define('STARTPATH', '../');
include ('dbCreator.php');
include ('../costants.php');
require_once(STARTPATH.DATAMODELPATH.'option.php');

// Create all the tables and fill it with dummy data
$dbCreator = new DbCreator();
$dbCreator->connect();
$out = $dbCreator->createSchema();
$out .= $dbCreator->populateSchema();
$dbCreator->closeConnection();

$toSave = new Option();
$toSave->setName('email');
$toSave->setType('settings');
$toSave->setValue($_POST['email']);
$toSave->save();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" dir="ltr">
    <head>
        <title>Easy Magazine: Installation Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="MSSmartTagsPreventParsing" content="TRUE" />
        <link href="../admin/resources/css/stylelogin.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="corpoalto">&nbsp;
        </div>
        <div id="intestazione">
            <p class="logo">&nbsp;</p>
            <div class="menu">
                <? echo $out; ?><br /><br />
                If there are no error the istallation is well done.<br />
                Please delete the "installation" folder and access to your new
                on-line magazine with the username "user" and password "psw" in the
                <a href="../admin/login.php">login page</a><br /><br />
            </div>
        </div>
        <div id="corpo">&nbsp;
        </div>
    </body>
</html>