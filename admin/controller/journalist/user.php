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

define('STARTPATH', '../../../');

require_once(STARTPATH.'costants.php');
require_once(STARTPATH.SYSTEMPATH.'config.php');
require_once(STARTPATH.DBPATH.'db.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');

session_start();

function edit($id) {
    $out = array();

    $userp = User::findById($id);
    $out['userp'] = $userp;

    return $out;
}

function save($toSave) {
    $out = array();

    $user_old = User::findById($_SESSION['user']->getId());

    $userp = new User(
        $_SESSION['user']->getId(),
        $toSave['Name'],
        $toSave['Username'],
        $toSave['Password'],
        $toSave['Body'],
        $user_old->getRole(),
        $user_old->getToshow(),
        $toSave['Email'],
        $toSave['MSN'],
        $toSave['Skype'],
        $toSave['created'],
        $toSave['updated']);
    $userp->save();

    $out['userp'] = User::findById($userp->getId());

    return $out;
}

function savePassword($toSave) {
    $out = array();

    $userp = User::findById($toSave['id']);

    if ($toSave['NewPassword1'] == $toSave['NewPassword2']) {
        $userp->updatePassword($toSave['NewPassword1'], $toSave['OldPassword']);
    }

    $out['userp'] = User::findById($userp->getId());

    return $out;
}

if (isset($_SESSION['user'])) {

    if (!isset($_GET["action"])) { $out = edit($_SESSION['user']->getId()); }
    else {
        switch ($_GET["action"]) {
            case  'save':          $out = save($_POST); break;
            case  'savePassword':  $out = savePassword($_POST, $_FILES); break;
            case  'edit':          $out = edit($_SESSION['user']->getId()); break;
        }
    }

} else {
    header("Location: ../../loginError.php");
}

$userp = $out['userp'];

$infoarray = array();
$warningarray = array();
$questionarray = array();
$errorarray = array();

if (isset($out['info'])) { $infoarray[] = $out['info']; }
if (isset($out['warning'])) { $warningarray[] = $out['warning']; }
if (isset($out['question'])) { $questionarray[] = $out['question']; }
if (isset($out['error'])) { $errorarray[] = $out['error']; }

include('../../view/journalist/users.php');

?>