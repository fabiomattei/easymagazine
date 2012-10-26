<?php

/*
    Copyright (C) 2009-2012  Fabio Mattei <burattino@gmail.com>

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

    $activetemplate = Option::findByType('mobiletemplate');
    $out['activetemplate'] = $activetemplate[0];

    $templates = DirectoryRunner::retriveMobileTemplatesList();
    $out['templates'] = $templates;

    $out['toshow'] = $out['activetemplate']->getName();

    return $out;
}

function activate($id) {
    $out = array();

    Option::cleanType('mobiletemplate');

    $toSave = new Option();
    $toSave->setName($id);
    $toSave->setType('mobiletemplate');
    $toSave->setValue('active');
    $toSave->save();

    FileWriter::writeMobileTemplateIncluder($id);

    $activetemplate = Option::findByType('mobiletemplate');
    $out['activetemplate'] = $activetemplate[0];

    $templates = DirectoryRunner::retriveMobileTemplatesList();
    $out['templates'] = $templates;

    $out['toshow'] = $out['activetemplate']->getName();

	// I need to delete the cache or the activated template will be invisible
	DirectoryRunner::cleanDir('cached');

    return $out;
}

function info($id) {
    $out = array();

    $activetemplate = Option::findByType('mobiletemplate');
    $out['activetemplate'] = $activetemplate[0];

    $templates = DirectoryRunner::retriveMobileTemplatesList();
    $out['templates'] = $templates;

    $out['toshow'] = $id;

    return $out;
}

if (isset($_GET['action'])) { $action = $_GET['action']; }
else { $action = 'index'; }

if (isset($_SESSION['user']))  {
    switch ($action) {
        case  'index':     $out = index(); break;
        case  'activate':  $out = activate($_GET['id']); break;
        case  'info':      $out = info($_GET['id']); break;
    }
}

$templates = $out['templates'];
$activetemplate = $out['activetemplate'];
$toshow = $out['toshow'];

$infoarray = array();
$warningarray = array();
$questionarray = array();
$errorarray = array();

if (isset($out['info'])) { $infoarray[] = $out['info']; }
if (isset($out['warning'])) { $warningarray[] = $out['warning']; }
if (isset($out['question'])) { $questionarray[] = $out['question']; }
if (isset($out['error'])) { $errorarray[] = $out['error']; }

include('../../view/publisher/mobiletemplates.php');

?>
