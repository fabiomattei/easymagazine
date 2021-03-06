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
require_once(STARTPATH.DATAMODELPATH.'article.php');
require_once(STARTPATH.DATAMODELPATH.'number.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');
require_once(STARTPATH.DATAMODELPATH.'category.php');
require_once(STARTPATH.UTILSPATH.'paginator.php');
require_once(STARTPATH.UTILSPATH.'directoryrunner.php');
require_once(STARTPATH.CONTROLLERPATH.'all_controllers_commons.php');
require_once(STARTPATH.PREVIEWPATH.'routerfactory.php');

session_start();
AllControllersCommons::loadlanguage();


function commons() {
    $outCommons = array();
    $outCommons['numbs'] = Number::findAll();
    $outCommons['categories'] = Category::findAll();
    $outCommons['authors'] = User::findAll();

    return $outCommons;
}

function index($page) {
    $outList = array();

    $arts = Article::findAllOrderedByIndexNumber();
    $outList['arts'] = Paginator::paginate($arts, $page);
    $outList['page_numbers'] = Article::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'index';

    return $outList;
}

function newArticle() {
    $outAction = array();

    $art = new Article();
    $outAction['art'] = $art;

    return $outAction;
}

function articlenumber($get, $page) {
    $outList = array();

    if (isset($get['number_id'])) {
        $_SESSION['number_id'] = $get['number_id'];
        $number_id = $get['number_id'];
    } else {
        $number_id = $_SESSION['number_id'];
    }

    $num = Number::findById($number_id);
    $outList['arts'] = Paginator::paginate($num->articles(), $page);
    $outList['page_numbers'] = Article::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'articlenumber';

    return $outList;
}

function preview($id) {
    $outAction = array();

    $outAction['view'] = 'router';

    $arURI = array('Router' => 'article', 'id' => $id);
    $routerFactory = new RouterFactory();
    $router = $routerFactory->createRouter($arURI);
    $router->show();

    return $outAction;
}

function articlecategory($id, $page) {
    $outList = array();

    $cat = Category::findById($id);
    $outList['arts'] = Paginator::paginate($cat->articles(), $page);
    $outList['page_numbers'] = Article::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'articlecategory';

    return $outList;
}

function byuser($page) {
    $outList = array();

    $arts = $_SESSION['user']->articles();
    $outList['arts'] = Paginator::paginate($arts, $page);
    $outList['page_numbers'] = Article::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'byuser';

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

    $arts = Article::findInAllTextFields($posts['string']);
    $outList['arts'] = Paginator::paginate($arts, $page);
    $outList['page_numbers'] = Article::getPageNumbers();
    $outList['pageSelected'] = $page;

    $outList['lastList'] = 'find';

    if (count($arts)==0) { $outList['warning'] = LANG_CON_ARTICLE_NO_MACH;  }
    return $outList;
}

function edit($id) {
    $outAction = array();

    $art = Article::findById($id);
    $outAction['art'] = $art;

    return $outAction;
}

function requestdelete($id, $list, $pageSelected) {
    $outAction = array();

    $art = Article::findById($id);
    $outAction['art'] = $art;

    $outAction['question'] = LANG_CON_ARTICLE_DO_YOU_WANT_DELETE.$art->getTitle().'? <br />
    <a href="article.php?action=dodelete&id='.$art->getId().'&list='.$list.'&pageSelected='.$pageSelected.'">'.LANG_CON_GENERAL_YES.'</a>,
    <a href="article.php?list='.$list.'&pageSelected='.$pageSelected.'">'.LANG_CON_GENERAL_NO.'</a>';

    return $outAction;
}

function dodelete($id) {
    $outAction = array();

    $art = Article::findById($id);
    $art->delete();
    $art = new Article();
    $outAction['art'] = $art;

    $outAction['info'] = LANG_CON_ARTICLE_DELETED;

    return $outAction;
}

function requestunlinkauthor($idAuthor, $idArticle, $list, $pageSelected) {
    $outAction = array();

    $art = Article::findById($idArticle);
    $outAction['art'] = $art;

    $author = User::findById($idAuthor);

    $outAction['question'] = LANG_CON_ARTICLE_DO_YOU_WANT_UNLINK.$author->getName().' - '.$author->getUsername().
            LANG_CON_ARTICLE_FROM_ARTICLE.$art->getTitle().'? <br />
    <a href="article.php?action=dounlinkauthor&idauthor='.$idAuthor.'&idarticle='.$idArticle.'&list='.$list.'&pageSelected='.$pageSelected.'">'.LANG_CON_GENERAL_YES.'</a>,
    <a href="article.php?list='.$list.'&pageSelected='.$pageSelected.'">'.LANG_CON_GENERAL_NO.'</a>';

    return $outAction;
}

function dounlinkauthor($idAuthor, $idArticle) {
    $outAction = array();

    $art = Article::findById($idArticle);
    $art->unlinkUser($idAuthor);
    $outAction['art'] = $art;

    $outAction['info'] = LANG_CON_ARTICLE_AUTHOR_UNLINKED;

    return $outAction;
}

function linkauthor($idAuthor, $idArticle) {
    $outAction = array();

    if ($idArticle == Article::NEW_ARTICLE) {
        $outAction['error'] = LANG_CON_ARTICLE_BEFORE_LINK;
        $outAction['art'] = New Article();
    } else {
        $art = Article::findById($idArticle);
        $art->linkUser($idAuthor);
        $outAction['art'] = $art;

        $outAction['info'] = LANG_CON_ARTICLE_AUTHOR_LINKED;
    }
    
    return $outAction;
}

function up($id) {
    $outAction = array();

    $art1 = Article::findById($id);
    $indexnumber =$art1->getIndexNumber();
    $art2 = $art1->findUpIndexNumber();

    if ($art2->getId()!=Article::NEW_ARTICLE) {
        $art1->setIndexNumber($art2->getIndexNumber());
        $art2->setIndexNumber($indexnumber);
        $art1->save();
        $art2->save();
    }

    $outAction['art'] = Article::findById($id);

    $outAction['info'] = LANG_CON_ARTICLE_MOVED_UP;

    return $outAction;
}

function down($id) {
    $outAction = array();

    $art1 = Article::findById($id);
    $indexnumber =$art1->getIndexNumber();
    $art2 = $art1->findDownIndexNumber();

    if ($art2->getId()!=Article::NEW_ARTICLE) {
        $art1->setIndexNumber($art2->getIndexNumber());
        $art2->setIndexNumber($indexnumber);
        $art1->save();
        $art2->save();
    }

    $outAction['art'] = Article::findById($id);

    $outAction['info'] = LANG_CON_ARTICLE_MOVED_DOWN;

    return $outAction;
}

function save($toSave) {
    $page = 1;
    $outAction = array();

    if (!isset($toSave['Published'])) { $toSave['Published'] = 0; }
    if (!isset($toSave['commentsallowed'])) { $toSave['commentsallowed'] = 0; }
    if (!isset($toSave['imagefilename'])) { $toSave['imagefilename'] = ''; }

    # If the article is published I need to delete the cache
    if ($toSave['Published'] == 1) {
        DirectoryRunner::cleanDir('cached');
    }

    $art = new Article(
        $toSave['id'],
        $toSave['numberid'],
        $toSave['categoryid'],
        $toSave['indexnumber'],
        $toSave['Published'],
        $toSave['Title'],
        $toSave['SubTitle'],
        $toSave['Summary'],
        $toSave['Body'],
        $toSave['commentsallowed'],
        $toSave['Tag'],
        $toSave['MetaDescription'],
        $toSave['MetaKeyword'],
        $toSave['created'],
        $toSave['updated']);
    $art->save();

    $art = Article::findById($art->getId()); // Necessary to reload date informations

    $outAction['art'] = $art;

    $outAction['info'] = LANG_CON_ARTICLE_SAVED;

    return $outAction;
}

if (isset($_GET['list'])) { $list = $_GET['list']; }
else { $list = 'index'; }
if (isset($_GET['pageSelected'])) { $page = $_GET['pageSelected']; }
elseif (isset($_POST['page'])) { $page = $_POST['page']; }
else { $page = '1'; }
if (isset($_GET['action'])) { $action = $_GET['action']; }
else { $action = 'newArticle'; }

if (isset($_SESSION['user'])) {
    $outCommons = commons();
    switch ($action) {
        case  'newArticle':          $outAction = newArticle(); break;
        case  'save':                $outAction = save($_POST); break;
        case  'edit':                $outAction = edit($_GET['id']); break;
        case  'dodelete':            $outAction = dodelete($_GET['id']); break;
        case  'requestdelete':       $outAction = requestdelete($_GET['id'], $_GET['list'], $_GET['pageSelected']); break;
        case  'up':                  $outAction = up($_GET['id']); break;
        case  'down':                $outAction = down($_GET['id']); break;
        case  'linkauthor':          $outAction = linkauthor($_POST['authorid'], $_GET['idarticle']); break;
        case  'requestunlinkauthor': $outAction = requestunlinkauthor($_GET['idauthor'], $_GET['idarticle'], $_GET['list'], $_GET['pageSelected']); break;
        case  'dounlinkauthor':      $outAction = dounlinkauthor($_GET['idauthor'], $_GET['idarticle']); break;
        case  'preview':             $outAction = preview($_GET['id']); break;
    }
    switch ($list) {
        case  'index':               $outList = index($page); break;
        case  'find':                $outList = find($_POST); break;
        case  'byuser':              $outList = byuser($page); break;
        case  'articlenumber':       $outList = articlenumber($_GET, $page); break;
        case  'articlecategory':     $outList = articlecategory($_GET['id'], $page); break;
    }
} else {
    header("Location: ../../loginError.php");
}

$numbs = $outCommons['numbs'];
$authors = $outCommons['authors'];
$categories = $outCommons['categories'];

if (isset($outAction['art'])) {
    $art = $outAction['art'];
}

$arts = $outList['arts'];
$lastList = $outList['lastList'];
$page_numbers = $outList['page_numbers'];
$pageSelected = $outList['pageSelected'];

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


if (isset ($outAction['view']) && $outAction['view'] == 'router') {
    #nothign
} else {
    include('../../view/publisher/articles.php');
}

?>