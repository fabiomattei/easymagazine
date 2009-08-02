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

require_once(STARTPATH.'config.php');
require_once(STARTPATH.'costants.php');
require_once(STARTPATH.'costants.php');
require_once(STARTPATH.DBPATH.'db.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');

$username = $_POST['username'];
$email = $_POST['email'];

$usr = User::findByUsernameAndEmail($username, $email);

if ($usr->getName() != '') {
    $newpassword = $usr->setNewRandomPassword();
    mail($email, 'New Password', 'Your new passwrod is: '.$newpassword);
} else {
    header("Location: loginError.php");
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" dir="ltr">
    <head>
        <title>Easy Magazine: Administration Login Page</title>
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
                New password sent to your email, check it and try again.
                <form action="openSession.php" method="post" id="login">
                    <table>
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" class="theInput" name="username" value="" /></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" class="theInput" name="password" value="" /></td>
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
