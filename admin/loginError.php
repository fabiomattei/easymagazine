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
        <title>Easy Magazine: Login Error Page</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta name="MSSmartTagsPreventParsing" content="TRUE" />
        <link href="resources/css/stylelogin.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div id="corpoalto">&nbsp;
        </div>
        <div id="intestazione">
            <p class="logo">&nbsp;</p>
            <div class="menu">

                Username or password wrong!<br />
                <a href="login.php">Try again</a>. <br /><br />
                If you lost your password please type your username and
                email and you will recevive a new password. <br />
                <form action="mailPassword.php" method="post">
                    <table>
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="username" value="" /></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
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
