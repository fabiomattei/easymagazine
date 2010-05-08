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
require_once(STARTPATH.DATAMODELPATH.'category.php');
require_once(STARTPATH.UTILSPATH.'paginator.php');
require_once(STARTPATH.CONTROLLERPATH.'all_controllers_commons.php');

session_start();
AllControllersCommons::loadlanguage();

function index($page) {
    $outList = array();

    $categories = Category::findAllOrderedByIndexNumber();
    $outList['categories'] = Paginator::paginate($categories, $page);
    $outList['page_categories'] = Category::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'index';

    return $outList;
}

function showPublished($page) {
    $outList = array();

    $categories = Category::findAllPublishedOrderedByIndexNumber();
    $outList['categories'] = Paginator::paginate($categories, $page);
    $outList['page_categories'] = Category::getPageNumbers();
    $outList['pageSelected'] = $page;

    $outList['lastList'] = 'showPublished';

    return $outList;
}

function showNotPublished($page) {
    $outList = array();

    $categories = Category::findAllNotPublishedOrderedByIndexNumber();
    $outList['categories'] = Paginator::paginate($categories, $page);
    $outList['page_categories'] = Category::getPageNumbers();
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

    $categories = Category::findInAllTextFields($string);
    $outList['categories'] = Paginator::paginate($categories, $page);
    $outList['page_numbers'] = Category::getPageNumbers();
    $outList['pageSelected'] = $page;

    $outList['lastList'] = 'find';

    if (count($categories)==0) { $outList['warning'] = 'No category corresponding to search criteria';  }
    return $outList;
}

function newCategory() {
    $outAction = array();

    $categ = new Category();
    $outAction['categ'] = $categ;

    return $outAction;
}

function edit($id) {
    $outAction = array();

    $categ = Category::findById($id);
    $outAction['categ'] = $categ;

    return $outAction;
}

function requestdelete($id, $list, $pageSelected) {
    $outAction = array();

    $categ = Category::findById($id);
    $outAction['categ'] = $categ;

    $outAction['question'] = 'Do you really want to delete the category: '.$categ->getName().'? <br />
    <a href="category.php?action=dodelete&id='.$categ->getId().'&list='.$list.'&pageSelected='.$pageSelected.'">yes</a>,
    <a href="category.php?list='.$list.'&pageSelected='.$pageSelected.'">no</a>';

    return $outAction;
}

function dodelete($id) {
    $outAction = array();

    $categ = Category::findById($id);
    $categ->delete();
    $categ = new Category();
    $outAction['categ'] = $categ;

    $outAction['info'] = 'Category deleted';

    return $outAction;
}

function up($id) {
    $outAction = array();

    $cat1 = Category::findById($id);
    $indexnumber = $cat1->getIndexNumber();
    $cat2 = Category::findUpIndexNumber($indexnumber);

    if ($cat2->getId()!=Category::NEW_CATEGORY) {
        $cat1->setIndexNumber($cat2->getIndexNumber());
        $cat2->setIndexNumber($indexnumber);
        $cat1->save();
        $cat2->save();
    }

    $categ = Category::findById($id);
    $outAction['categ'] = $categ;

    return $outAction;
}

function down($id) {
    $outAction = array();

    $cat1 = Category::findById($id);
    $indexnumber = $cat1->getIndexNumber();
    $cat2 = Category::findDownIndexNumber($indexnumber);

    if ($cat2->getId()!=Category::NEW_CATEGORY) {
        $cat1->setIndexNumber($cat2->getIndexNumber());
        $cat2->setIndexNumber($indexnumber);
        $cat1->save();
        $cat2->save();
    }

    $categ = Category::findById($id);
    $outAction['categ'] = $categ;

    return $outAction;
}

function save($toSave) {
    $outAction = array();

    if (!isset($toSave['Published'])) { $toSave['Published'] = 0; }

    $categ = new Category(
        $toSave['id'],
        $toSave['indexnumber'],
        $toSave['Published'],
        $toSave['Name'],
        $toSave['Description'],
        $toSave['created'],
        $toSave['updated']);
    $categ->save();

    $outAction['categ'] = Category::findById($categ->getId());

    return $outAction;
}

if (isset($_GET['list'])) { $list = $_GET['list']; }
else { $list = 'index'; }
if (isset($_GET['pageSelected'])) { $page = $_GET['pageSelected']; }
elseif (isset($_POST['page'])) { $page = $_POST['page']; }
else { $page = '1'; }
if (isset($_GET['action'])) { $action = $_GET['action']; }
else { $action = 'newCategory'; }

if (isset($_SESSION['user'])) {
    switch ($action) {
        case  'newCategory':       $outAction = newCategory(); break;
        case  'save':              $outAction = save($_POST); break;
        case  'edit':              $outAction = edit($_GET['id']); break;
        case  'dodelete':          $outAction = dodelete($_GET['id']); break;
        case  'requestdelete':     $outAction = requestdelete($_GET['id'], $_GET['list'], $_GET['pageSelected']); break;
        case  'deleteimg':         $outAction = deleteimg($_GET['id']); break;
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

$categories = $outList['categories'];
$page_numbers = $outList['page_categories'];
$pageSelected = $outList['pageSelected'];
$lastList = $outList['lastList'];

$categ = $outAction['categ'];

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

include('../../view/publisher/categories.php');

?>
