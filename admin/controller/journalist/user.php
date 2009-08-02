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

define('STARTPATH', '../../../');

require_once(STARTPATH.'config.php');
require_once(STARTPATH.'costants.php');
require_once(STARTPATH.DBPATH.'db.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');

session_start();

function index() {
    $out = array();

    $userp = new User();
    $out['userp'] = $userp;

    $userps = User::findAll();
    $out['userps'] = $userps;

    return $out;
}

function edit($id) {
    $out = array();

    $userp = User::findById($id);
    $out['userp'] = $userp;

    $userps = User::findAll();
    $out['userps'] = $userps;

    return $out;
}

function requestdelete($id) {
    $out = array();

    $userp = User::findById($id);
    $out['userp'] = $userp;

    $userps = User::findAll();
    $out['userps'] = $userps;
    
    $out['question'] = 'Do you really want to delete the user: '.$userp->getName().' - '.$userp->getUsername().'? <br />
    <a href="user.php?action=dodelete&id='.$userp->getId().'">yes</a>,
    <a href="user.php">no</a>';

    return $out;
}

function dodelete($id) {
    $out = array();

    $userp = User::findById($id);
    $userp->delete();
    $userp = new User();
    $out['userp'] = $userp;

    $userps = User::findAll();
    $out['userps'] = $userps;

    $out['info'] = 'User deleted';

    return $out;
}

function save($toSave) {
    $out = array();

    $userp = new User(
        $toSave['id'],
        $toSave['Name'],
        $toSave['Username'],
        $toSave['Password'],
        $toSave['Role'],
        $toSave['Email'],
        $toSave['MSN'],
        $toSave['Skype'],
        $toSave['created'],
        $toSave['updated']);
    $userp->save();
    $out['userp'] = User::findById($userp->getId());

    $userps = User::findAll();
    $out['userps'] = $userps;

    return $out;
}

function savePassword($toSave) {
    $out = array();

    $userp = User::findById($toSave['id']);

    if ($toSave['NewPassword1'] == $toSave['NewPassword2']) {
        $userp->updatePassword($toSave['NewPassword1'], $toSave['OldPassword']);
    }

    $out['userp'] = User::findById($userp->getId());

    $userps = User::findAll();
    $out['userps'] = $userps;

    return $out;
}

if (!isset($_GET["action"])) { $out = index(); }
else {
    switch ($_GET["action"]) {
        case  'index':         $out = index(); break;
        case  'save':          $out = save($_POST); break;
        case  'savePassword':  $out = savePassword($_POST); break;
        case  'edit':          $out = edit($_GET['id']); break;
        case  'dodelete':      $out = dodelete($_GET['id']); break;
        case  'requestdelete': $out = requestdelete($_GET['id']); break;
    }
}

$userps = $out['userps'];
$userp = $out['userp'];

if (isset($out['info'])) { $info = $out['info']; }
if (isset($out['warning'])) { $warning = $out['warning']; }
if (isset($out['question'])) { $question = $out['question']; }
if (isset($out['error'])) { $error = $out['error']; }

include('../../view/publisher/users.php');

?>
