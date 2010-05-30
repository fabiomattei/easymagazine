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

define('STARTPATH', '../');

require_once(STARTPATH.'costants.php');
require_once(STARTPATH.SYSTEMPATH.'config.php');
require_once(STARTPATH.DBPATH.'db.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');
require_once(STARTPATH.DATAMODELPATH.'magazine.php');
require_once(STARTPATH.CONTROLLERPATH.'all_controllers_commons.php');

AllControllersCommons::loadlanguage();

$username = $_POST['username'];
$email = $_POST['email'];

$usr = User::findByUsernameAndEmail($username, $email);

if ($usr->getUsername() == $username) {
    $newpassword = $usr->setNewRandomPassword();
    $object = LANG_LOGIN_NEW_PASSWORD_FROM.' ['.Magazine::getWebSiteURL().']';
    $message = LANG_LOGIN_DEAR.' '.$username.', '.LANG_LOGIN_NEW_PASSWORD_IS.': '.$newpassword;
    mail($email, $object, $message, 'From: '.Magazine::getAdministrationEmail());
} else {
    header('Location: loginError.php');
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" dir="ltr">
    <head>
        <title><?PHP echo LANG_LOGIN_TITLE_PASSWORD_SEND; ?></title>
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
                <?PHP echo LANG_LOGIN_NEW_PASSWORD_SENT; ?>
                <form action="openSession.php" method="post" id="login">
                    <table>
                        <tr>
                            <td><?PHP echo LANG_ADMIN_TABLE_USERNAME; ?>:</td>
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
