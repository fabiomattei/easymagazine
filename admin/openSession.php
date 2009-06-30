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
$password = $_POST['password'];

$usr = User::checkUsrPsw($username, $password);

if ($usr->getName() != '') {
    if ($usr->getRole()=='publisher') {
        session_start();
        $_SESSION['user'] = $usr;
        header("Location: controller/publisher/dashboard.php");
    } else {
        session_start();
        $_SESSION['user'] = $usr;
        header("Location: controller/journalist/dashboard.php");
    }
} else {
    header("Location: loginError.php");
}

?>
