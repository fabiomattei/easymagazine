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
    $out['pluginsindb'] = $pluginsindb;

    $plugins = DirectoryRunner::retrivePlugInList();
    $out['plugins'] = $plugins;

    $out['toshow'] = '';

    return $out;
}

function info($id) {
    $out = array();

    $pluginsindb = Option::findByType('plugin');
    $out['pluginsindb'] = $pluginsindb;

    $plugins = DirectoryRunner::retrivePlugInList();
    $out['plugins'] = $plugins;

    $out['toshow'] = $id.'/info.php';

    return $out;
}

function activate($id) {
    $out = array();

    $plugin = Option::findById($id);
    $out['plugin'] = $plugin;

    $plugins = Option::findAll();
    $out['plugins'] = $plugins;

    return $out;
}

function deactivate($id) {
    $out = array();

    $plugin = Option::findById($id);
    $plugin->delete();
    $plugin = new Option();
    $out['plugin'] = $plugin;

    $plugins = Option::findAll();
    $out['plugins'] = $plugins;

    return $out;
}

function admin($id) {
    $out = array();

    $pluginsindb = Option::findByType('plugin');
    $out['pluginsindb'] = $pluginsindb;

    $plugins = DirectoryRunner::retrivePlugInList();
    $out['plugins'] = $plugins;

    $out['toshow'] = $id.'/admin.php';

    return $out;
}

if (!isset($_GET["action"])) { $out = index(); }
else {
    switch ($_GET["action"]) {
        case  'index':       $out = index(); break;
        case  'activate':    $out = activate($_POST); break;
        case  'deactivate':  $out = deactivate($_GET['id']); break;
        case  'info':        $out = info($_GET['id']); break;
        case  'admin':       $out = admin($_GET['id']); break;
    }
}

$pluginsindb = $out['pluginsindb'];
$plugins = $out['plugins'];
$toshow = $out['toshow'];

include('../../view/publisher/plugin.php');

?>
