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
require_once(STARTPATH.DATAMODELPATH.'option.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');
require_once(STARTPATH.UTILSPATH.'fileWriter.php');
require_once(STARTPATH.UTILSPATH.'directoryrunner.php');
require_once(STARTPATH.CONTROLLERPATH.'all_controllers_commons.php');

session_start();
AllControllersCommons::loadlanguage();

function index() {
    $out = array();

    $settingsindb = Option::findByType('settings');

    $out['settingsindb'] = array();
    foreach ($settingsindb as $stdb) {
        $name = $stdb->getName();
        $out['settingsindb']["$name"] = $stdb;
    }

    if (!isset($out['settingsindb']['title'])) { $out['settingsindb']['title'] = new Option(Option::NEW_OPTION, 'title', 'settings', ''); }
    if (!isset($out['settingsindb']['description'])) { $out['settingsindb']['description'] = new Option(Option::NEW_OPTION, 'description', 'settings', ''); }
    if (!isset($out['settingsindb']['urltype'])) { $out['settingsindb']['urltype'] = new Option(Option::NEW_OPTION, 'urltype', 'settings', 'optimized'); }
    if (!isset($out['settingsindb']['publisher'])) { $out['settingsindb']['publisher'] = new Option(Option::NEW_OPTION, 'publisher', 'settings', ''); }
    if (!isset($out['settingsindb']['rights'])) { $out['settingsindb']['rights'] = new Option(Option::NEW_OPTION, 'rights', 'settings', ''); }
    if (!isset($out['settingsindb']['email'])) { $out['settingsindb']['email'] = new Option(Option::NEW_OPTION, 'email', 'settings', ''); }
    if (!isset($out['settingsindb']['language'])) { $out['settingsindb']['language'] = new Option(Option::NEW_OPTION, 'language', 'settings', 'en'); }
    if (!isset($out['settingsindb']['epubname'])) { $out['settingsindb']['epubname'] = new Option(Option::NEW_OPTION, 'epubname', 'settings', 'easymagazine'); }
    if (!isset($out['settingsindb']['siteurl'])) { $out['settingsindb']['siteurl'] = new Option(Option::NEW_OPTION, 'siteurl', 'settings', 'http://www.easymagazine.org/'); }
    if (!isset($out['settingsindb']['facebookbutton'])) { $out['settingsindb']['facebookbutton'] = new Option(Option::NEW_OPTION, 'facebookbutton', 'settings', 'OFF'); }
    if (!isset($out['settingsindb']['twitterbutton'])) { $out['settingsindb']['twitterbutton'] = new Option(Option::NEW_OPTION, 'twitterbutton', 'settings', 'OFF'); }

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

    $toSave = new Option();
    $toSave->setName('publisher');
    $toSave->setType('settings');
    $toSave->setValue($post['publisher']);
    $toSave->save();

    $toSave = new Option();
    $toSave->setName('rights');
    $toSave->setType('settings');
    $toSave->setValue($post['rights']);
    $toSave->save();

    $toSave = new Option();
    $toSave->setName('email');
    $toSave->setType('settings');
    $toSave->setValue($post['email']);
    $toSave->save();

    $toSave = new Option();
    $toSave->setName('language');
    $toSave->setType('settings');
    $toSave->setValue($post['language']);
    $toSave->save();

    $toSave = new Option();
    $toSave->setName('epubname');
    $toSave->setType('settings');
    $toSave->setValue($post['epubname']);
    $toSave->save();

    $toSave = new Option();
    $toSave->setName('siteurl');
    $toSave->setType('settings');
    $toSave->setValue($post['siteurl']);
    $toSave->save();
    
    $toSave = new Option();
    $toSave->setName('facebookbutton');
    $toSave->setType('settings');
    $toSave->setValue($post['facebookbutton']);
    $toSave->save();

    $toSave = new Option();
    $toSave->setName('twitterbutton');
    $toSave->setType('settings');
    $toSave->setValue($post['twitterbutton']);
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