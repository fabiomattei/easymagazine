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
                <form action="createconfig.php" method="post" id="login">
                    In order to install the application please fill the form.
                    <table>
                        <tr>
                            <td>MySql DB host:</td>
                            <td><input type="text" name="dbhost" value="" /></td>
                        </tr>
                        <tr>
                            <td>MySql DB name:</td>
                            <td><input type="text" name="dbname" value="" /></td>
                        </tr>
                        <tr>
                            <td>MySql DB tables prefix:</td>
                            <td><input type="text" name="tbprefix" value="" /></td>
                        </tr>
                        <tr>
                            <td>MySql DB Username:</td>
                            <td><input type="text" name="username" value="" /></td>
                        </tr>
                        <tr>
                            <td>MySql DB Password:</td>
                            <td><input type="password" name="password" value="" /></td>
                        </tr>
                        <tr>
                            <td>SubFolder: <br />(Ex. in www.mydomain.org/mymag)<br />folder is mymag</td>
                            <td valign="top"><input type="text" name="folder" value="" /></td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Ok" /></td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                    <br />
                </form>
            </div>
        </div>
        <div id="corpo">&nbsp;
        </div>
    </body>
</html>