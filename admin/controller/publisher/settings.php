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

require_once(STARTPATH.'costants.php');
require_once(STARTPATH.SYSTEMPATH.'config.php');
require_once(STARTPATH.DATAMODELPATH.'option.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');
require_once(STARTPATH.UTILSPATH.'fileWriter.php');
require_once(STARTPATH.UTILSPATH.'directoryrunner.php');

session_start();

function index() {
    $out = array();

    $settingsindb = Option::findByType('settings');

    $out['settingsindb'] = array();
    foreach ($settingsindb as $stdb) {
        $name = $stdb->getName();
        $out['settingsindb']["$name"] = $stdb;
    }

    return $out;
}

function update($get, $post) {
    $out = array();

    Option::cleanType('settings');

    $toSave = new Option();
    $toSave->setName('title');
    $toSave->setType('settings');
    $toSave->setValue($post['title']);
    $toSave->save();

    $toSave = new Option();
    $toSave->setName('description');
    $toSave->setType('settings');
    $toSave->setValue($post['description']);
    $toSave->save();

    $toSave = new Option();
    $toSave->setName('urltype');
    $toSave->setType('settings');
    $toSave->setValue($post['urltype']);
    $toSave->save();
    
    $settingsindb = Option::findByType('settings');

    $out['settingsindb'] = array();
    foreach ($settingsindb as $stdb) {
        $name = $stdb->getName();
        $out['settingsindb']["$name"] = $stdb;
    }

    FileWriter::writeSettingsFile($out['settingsindb']);

    return $out;
}

if (isset($_GET['action'])) { $action = $_GET['action']; }
else { $action = 'index'; }

if (isset($_SESSION['user'])) {
    switch ($action) {
        case  'index':       $out = index(); break;
        case  'update':      $out = update($_GET, $_POST); break;
    }
}

$settingsindb = $out['settingsindb'];

if (isset($out['get'])) { $get = $out['get']; }
if (isset($out['post'])) { $post = $out['post']; }
if (isset($out['files'])) { $files = $out['files']; }

$infoarray = array();
$warningarray = array();
$questionarray = array();
$errorarray = array();

if (isset($out['info'])) { $infoarray[] = $out['info']; }
if (isset($out['warning'])) { $warningarray[] = $out['warning']; }
if (isset($out['question'])) { $questionarray[] = $out['question']; }
if (isset($out['error'])) { $errorarray[] = $out['error']; }

include('../../view/publisher/settings.php');

?>