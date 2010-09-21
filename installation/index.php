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
                <? if (isset($_GET['error']) && $_GET['error'] == 1) :?>
                <b>It is not possible to open a connection with the database, please
                check the data inserted.</b><br /><br />
                <? endif; ?>
                <form action="createconfig.php" method="post" id="login">
                    In order to install the application please be sure the following folders have the right permissions (0755):
                    <b>easymagazine/system</b> (and all contained files)<br />
                    <b>easymagazine/contents/feed</b><br />
                    <b>easymagazine/contents/epug</b><br />
                    <b>easymagazine/cache</b><br /><br />
                    Then rename the file htaccess in <b>.htaccess</b><br /><br />
                    Then fill the form:
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
                            <td>Administrator Email:</td>
                            <td><input type="text" name="email" value="" /></td>
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