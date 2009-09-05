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
require_once(STARTPATH.DATAMODELPATH.'option.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');
require_once(STARTPATH.UTILSPATH.'fileWriter.php');
require_once(STARTPATH.UTILSPATH.'directoryrunner.php');

session_start();

function index() {
    $out = array();

    $pluginsindb = Option::findByType('plugin');

    $out['pluginsindb'] = array();
    foreach ($pluginsindb as $pldb) {
        $name = $pldb->getName();
        $out['pluginsindb']["$name"] = $pldb;
    }

    $plugins = DirectoryRunner::retrivePlugInList();
    $out['plugins'] = $plugins;

    $out['toshow'] = '';

    return $out;
}

function update($get, $post) {
    $out = array();

    $pluginsindb = Option::findByName($pluginname);

    $toSave = new Option();
    $toSave->setName($pluginname);
    $toSave->setType('plugin');
    $toSave->setValue('active');
    $toSave->save();

    $pluginsindb = Option::findByType('plugin');

    $out['pluginsindb'] = array();
    foreach ($pluginsindb as $pldb) {
        $name = $pldb->getName();
        $out['pluginsindb']["$name"] = $pldb;
    }

    $dirList = array();
    foreach ($pluginsindb as $pldb) {
        $name = $pldb->getName();
        $dirList["$name"] = $name;
    }

    FileWriter::writePlugInIncluder($dirList);

    $plugins = DirectoryRunner::retrivePlugInList();
    $out['plugins'] = $plugins;

    $out['toshow'] = $pluginname.'/activate.php';

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

$pluginsindb = $out['pluginsindb'];
$plugins = $out['plugins'];
$toshow = $out['toshow'];

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