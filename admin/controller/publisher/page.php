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
require_once(STARTPATH.DATAMODELPATH.'page.php');

session_start();

function index($posts) {
    $outList = array();

    $pags = Page::findAllOrderedByIndexNumber();
    $outList['pags'] = $pags;
    $outList['lastList'] = 'index';
    
    return $outList;
}

function newPage() {
    $outAction = array();

    $pag = new Page();
    $outAction['pag'] = $pag;

    return $outAction;
}

function find($post) {
    $outList = array();

    $pags = Page::findInAllTextFields($post['string']);
    $outList['pags'] = $pags;
    $outList['lastList'] = 'find';

    if (count($pags)==0) { $outList['warning'] = 'No pages corresponding to search criteria';  }
    return $outList;
}

function edit($id) {
    $outAction = array();

    $pag = Page::findById($id);
    $outAction['pag'] = $pag;

    return $outAction;
}


function requestdelete($id, $list) {
    $outAction = array();

    $pag = Page::findById($id);
    $outAction['pag'] = $pag;

    $outAction['question'] = 'Do you really want to delete the page: '.$pag->getTitle().'? <br />
    <a href="page.php?action=dodelete&id='.$pag->getId().'&list='.$list.'">yes</a>,
    <a href="page.php?list='.$list.'">no</a>';

    return $outAction;
}

function dodelete($id) {
    $outAction = array();

    $pag = Page::findById($id);
    $pag->delete();
    $pag = new Page();
    $outAction['pag'] = $pag;

    $outAction['info'] = 'Page deleted';

    return $outAction;
}

function deleteimg($id) {
    $outAction = array();

    $pag = Page::findById($id);
    $pag->deleteImg();
    $outAction['pag'] = $pag;

    $outAction['info'] = 'Image deleted';

    return $outAction;
}

function up($id) {
    $outAction = array();

    $pag1 = Page::findById($id);
    $indexnumber = $pag1->getIndexNumber();
    $pag2 = $pag1->findUpIndexNumber();

    if ($pag2->getId()!=Page::NEW_PAGE) {
        $pag1->setIndexNumber($pag2->getIndexNumber());
        $pag2->setIndexNumber($indexnumber);
        $pag1->save();
        $pag2->save();
    }

    $pag = new Page();
    $outAction['pag'] = $pag;

    return $outAction;
}

function down($id) {
    $Action = array();

    $pag1 = Page::findById($id);
    $indexnumber = $pag1->getIndexNumber();
    $pag2 = $pag1->findDownIndexNumber();

    if ($pag2->getId()!=Page::NEW_PAGE) {
        $pag1->setIndexNumber($pag2->getIndexNumber());
        $pag2->setIndexNumber($indexnumber);
        $pag1->save();
        $pag2->save();
    }

    $pag = new Page();
    $Action['pag'] = $pag;

    return $Action;
}

function save($toSave, $files) {
    $outAction = array();

    if (!isset($toSave['Published'])) { $toSave['Published'] = 0; }
    if (!isset($toSave['imagefilename'])) { $toSave['imagefilename'] = ''; }

    $pag = new Page(
        $toSave['id'],
        $toSave['indexnumber'],
        $toSave['Published'],
        $toSave['Title'],
        $toSave['SubTitle'],
        $toSave['Summary'],
        $toSave['Body'],
        $toSave['Tag'],
        $toSave['MetaDescription'],
        $toSave['MetaKeyword'],
        $toSave['imagefilename'],
        $toSave['ImageDescription'],
        $toSave['created'],
        $toSave['updated']);
    $pag->save();

    if (isset($files['Image']) && $files['Image']['size'] > 0) {
        $pag->deleteImg();
        $pag->saveImg($files['Image']);
    }
    $outAction['pag'] = $pag;

    return $outAction;
}

if (isset($_GET['list'])) { $list = $_GET['list']; }
else { $list = 'index'; }
if (isset($_GET['action'])) { $action = $_GET['action']; }
else { $action = 'newPage'; }

if (isset($_SESSION['user'])) {
    switch ($action) {
        case  'newPage':           $outAction = newPage(); break;
        case  'save':              $outAction = save($_POST, $_FILES); break;
        case  'edit':              $outAction = edit($_GET['id']); break;
        case  'dodelete':          $outAction = dodelete($_GET['id']); break;
        case  'requestdelete':     $outAction = requestdelete($_GET['id'], $_GET['list']); break;
        case  'up':                $outAction = up($_GET['id']); break;
        case  'down':              $outAction = down($_GET['id']); break;
        case  'deleteimg':         $outAction = deleteimg($_GET['id']); break;
    }
    switch ($list) {
        case  'index':             $outList = index($_POST); break;
        case  'find':              $outList = find($_POST); break;
    }
} else {
    header("Location: ../../loginError.php");
}

$pags = $outList['pags'];
$lastList = $outList['lastList'];

$pag = $outAction['pag'];

$infoarray = array();
$warningarray = array();
$questionarray = array();
$errorarray = array();

if (isset($outAction['info'])) { $infoarray[] = $outAction['info']; }
if (isset($outAction['warning'])) { $warningarray[] = $outAction['warning']; }
if (isset($outAction['question'])) { $questionarray[] = $outAction['question']; }
if (isset($outAction['error'])) { $errorarray[] = $outAction['error']; }

if (isset($outList['info'])) { $infoarray[] = $outList['info']; }
if (isset($outList['warning'])) { $warningarray[] = $outList['warning']; }
if (isset($outList['question'])) { $questionarray[] = $outList['question']; }
if (isset($outList['error'])) { $errorarray[] = $outList['error']; }

include('../../view/publisher/Pages.php');

?>
