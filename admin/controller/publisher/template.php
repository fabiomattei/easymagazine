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

    $template = new Option();
    $out['template'] = $template;

    $templatesindb = Option::findByType('template');
    $out['templatesindb'] = $templatesindb;

    $templates = DirectoryRunner::retriveTemplatesList();
    $out['templates'] = $templates;

    return $out;
}

function activate($id) {
    $out = array();

    $template = Option::findById($id);
    $out['template'] = $template;

    $templates = Option::findAll();
    $out['templates'] = $templates;

    return $out;
}

function deactivate($id) {
    $out = array();

    $template = Option::findById($id);
    $template->delete();
    $template = new Option();
    $out['template'] = $template;

    $templates = Option::findAll();
    $out['templates'] = $templates;

    return $out;
}

function install($id) {
    $out = array();

    $template_to_be_replayed = Option::findById($id);

    $template = new Option();
    $template->setArticle_id($template_to_be_replayed->getArticle_id());
    $template->setTitle('Re: '.$template_to_be_replayed->getTitle());
    $template->setSignature($_SESSION['user']->getName());
    $out['template'] = $template;

    $templates = Option::findAll();
    $out['templates'] = $templates;

    return $out;
}

function unistall($toSave) {
    $out = array();

    if (!isset($toSave['Published'])) { $toSave['Published'] = 0; }

    $template = new Option(
        $toSave['id'],
        $toSave['article_id'],
        $toSave['Title'],
        $toSave['Published'],
        $toSave['Body'],
        $toSave['Signature'],
        $toSave['created'],
        $toSave['updated']);
    $template->save();
    $out['template'] = $template_to_be_replayed = Option::findById($template->getId());

    $templates = Option::findAll();
    $out['templates'] = $templates;

    return $out;
}

if (!isset($_GET["action"])) { $out = index(); }
else {
    switch ($_GET["action"]) {
        case  'index':         $out = index(); break;
        case  'activate':      $out = activate($_POST); break;
        case  'deactivate':    $out = deactivate($_GET['id']); break;
        case  'install':       $out = install($_GET['id']); break;
        case  'unistall':      $out = unistall($_GET['id']); break;
    }
}

$templates = $out['templates'];
$template = $out['template'];

include('../../view/publisher/templates.php');

?>
