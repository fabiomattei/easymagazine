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
require_once(STARTPATH.DATAMODELPATH.'number.php');
require_once(STARTPATH.UTILSPATH.'paginator.php');
require_once(STARTPATH.UTILSPATH.'epubcreator.php');
require_once(STARTPATH.UTILSPATH.'rssfeedcreator.php');
require_once(STARTPATH.CONTROLLERPATH.'all_controllers_commons.php');

session_start();
AllControllersCommons::loadlanguage();

function index($page) {
    $outList = array();

    $numbs = Number::findAllOrderedByIndexNumber();
    $outList['numbs'] = Paginator::paginate($numbs, $page);
    $outList['page_numbers'] = Number::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'index';

    return $outList;
}

function showPublished($page) {
    $outList = array();

    $numbs = Number::findAllPublishedOrderedByIndexNumber();
    $outList['numbs'] = Paginator::paginate($numbs, $page);
    $outList['page_numbers'] = Number::getPageNumbers();
    $outList['pageSelected'] = $page;

    $outList['lastList'] = 'showPublished';

    return $outList;
}

function showNotPublished($page) {
    $outList = array();

    $numbs = Number::findAllNotPublishedOrderedByIndexNumber();
    $outList['numbs'] = Paginator::paginate($numbs, $page);
    $outList['page_numbers'] = Number::getPageNumbers();
    $outList['pageSelected'] = $page;

    $outList['lastList'] = 'showNotPublished';

    return $outList;
}

function find($posts) {
    if (isset($posts['movinglist'])) {
        $page = $posts['page'];
        $string = $_SESSION['oldstring'];
    } else {
        $string = $posts['string'];
        $page = 1;
    }

    $outList = array();

    $numbs = Number::findInAllTextFields($string);
    $outList['numbs'] = Paginator::paginate($numbs, $page);
    $outList['page_numbers'] = Number::getPageNumbers();
    $outList['pageSelected'] = $page;

    $outList['lastList'] = 'find';

    if (count($numbs)==0) { $outList['warning'] = LANG_CON_NUMBER_NO_MACH;  }
    return $outList;
}

function newNumber() {
    $outAction = array();

    $numb = new Number();
    $outAction['numb'] = $numb;

    return $outAction;
}

function edit($id) {
    $outAction = array();

    $numb = Number::findById($id);
    $outAction['numb'] = $numb;

    return $outAction;
}

function epub($id) {
    $outAction = array();

    $numb = Number::findById($id);
    $outAction['numb'] = $numb;

    $epugcreator = new ePugCreator($numb);
    $epugcreator->writeEPubForNumber();

    $outAction['info'] = LANG_CON_NUMBER_EPUB_CREATED.'<i>'.$numb->getTitle().'</i>';

    return $outAction;
}

function requestdelete($id, $list, $pageSelected) {
    $outAction = array();

    $numb = Number::findById($id);
    $outAction['numb'] = $numb;

    $outAction['question'] = LANG_CON_NUMBER_DO_YOU_WANT_DELETE.$numb->getTitle().'? <br />
    <a href="number.php?action=dodelete&id='.$numb->getId().'&list='.$list.'&pageSelected='.$pageSelected.'">'.LANG_CON_GENERAL_YES.'</a>,
    <a href="number.php?list='.$list.'&pageSelected='.$pageSelected.'">'.LANG_CON_GENERAL_NO.'</a>';

    return $outAction;
}

function dodelete($id) {
    $outAction = array();

    $numb = Number::findById($id);
    $numb->delete();
    $numb = new Number();
    $outAction['numb'] = $numb;

    $outAction['info'] = LANG_CON_NUMBER_DELETED;

    return $outAction;
}

function up($id) {
    $outAction = array();

    $numb1 = Number::findById($id);
    $indexnumber = $numb1->getIndexNumber();
    $numb2 = Number::findUpIndexNumber($indexnumber);

    if ($numb2->getId()!=Number::NEW_NUMBER) {
        $numb1->setIndexNumber($numb2->getIndexNumber());
        $numb2->setIndexNumber($indexnumber);
        $numb1->save();
        $numb2->save();
    }

    $numb = Number::findById($id);
    $outAction['numb'] = $numb;

    return $outAction;
}

function down($id) {
    $outAction = array();

    $numb1 = Number::findById($id);
    $indexnumber = $numb1->getIndexNumber();
    $numb2 = Number::findDownIndexNumber($indexnumber);

    if ($numb2->getId()!=Number::NEW_NUMBER) {
        $numb1->setIndexNumber($numb2->getIndexNumber());
        $numb2->setIndexNumber($indexnumber);
        $numb1->save();
        $numb2->save();
    }

    $numb = Number::findById($id);
    $outAction['numb'] = $numb;

    return $outAction;
}

function save($toSave) {
    $outAction = array();

    if (!isset($toSave['Published'])) { $toSave['Published'] = 0; }
    if (!isset($toSave['commentsallowed'])) { $toSave['commentsallowed'] = 0; }

    $numb = new Number(
        $toSave['id'],
        $toSave['indexnumber'],
        $toSave['Published'],
        $toSave['Title'],
        $toSave['SubTitle'],
        $toSave['Summary'],
        $toSave['commentsallowed'],
        $toSave['MetaDescription'],
        $toSave['MetaKeyword'],
        $toSave['created'],
        $toSave['updated']);
    $numb->save();

    $numb = Number::findById($numb->getId()); // Necessary to reload date informations

    if ($toSave['Published'] != 0) {
        rssFeedCreator::updatefeed();
    }

    $outAction['numb'] = $numb;

    return $outAction;
}

if (isset($_GET['list'])) { $list = $_GET['list']; }
else { $list = 'index'; }
if (isset($_GET['pageSelected'])) { $page = $_GET['pageSelected']; }
elseif (isset($_POST['page'])) { $page = $_POST['page']; }
else { $page = '1'; }
if (isset($_GET['action'])) { $action = $_GET['action']; }
else { $action = 'newNumber'; }

if (isset($_SESSION['user'])) {
    switch ($action) {
        case  'newNumber':         $outAction = newNumber(); break;
        case  'save':              $outAction = save($_POST); break;
        case  'edit':              $outAction = edit($_GET['id']); break;
        case  'dodelete':          $outAction = dodelete($_GET['id']); break;
        case  'requestdelete':     $outAction = requestdelete($_GET['id'], $_GET['list'], $_GET['pageSelected']); break;
        case  'up':                $outAction = up($_GET['id']); break;
        case  'down':              $outAction = down($_GET['id']); break;
        case  'epub':              $outAction = epub($_GET['id']); break;
    }
    switch ($list) {
        case  'index':             $outList = index($page); break;
        case  'showPublished':     $outList = showPublished($page); break;
        case  'showNotPublished':  $outList = showNotPublished($page); break;
        case  'find':              $outList = find($_POST); break;
    }
} else {
    header("Location: ../../loginError.php");
}

$numbs = $outList['numbs'];
$page_numbers = $outList['page_numbers'];
$pageSelected = $outList['pageSelected'];
$lastList = $outList['lastList'];

$numb = $outAction['numb'];

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

include('../../view/publisher/numbers.php');

?>
