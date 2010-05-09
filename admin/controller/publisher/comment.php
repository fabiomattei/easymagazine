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
require_once(STARTPATH.DATAMODELPATH.'comment.php');
require_once(STARTPATH.UTILSPATH.'paginator.php');
require_once(STARTPATH.CONTROLLERPATH.'all_controllers_commons.php');

session_start();
AllControllersCommons::loadlanguage();

function index($page) {
    $outList = array();

    $comms = Comment::findAll();
    $outList['comms'] = Paginator::paginate($comms, $page);
    $outList['page_numbers'] = Comment::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'index';

    return $outList;
}

function byuser($page) {
    $outList = array();

    $comms = $_SESSION['user']->articlescomments();
    $outList['comms'] = Paginator::paginate($comms, $page);
    $outList['page_numbers'] = Comment::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'byuser';

    return $outList;
}

function find($posts) {
    if (isset($posts['movinglist'])) {
        $page = $posts['page'];
        $string = $_SESSION['oldstring'];
    } else {
        $_SESSION['oldstring'] = $string;
        $string = $posts['string'];
        $page = 1;
    }

    $outList = array();

    $comms = Comment::findInAllTextFields($posts['string']);
    $outList['comms'] = Paginator::paginate($comms, $page);
    $outList['page_numbers'] = Comment::getPageNumbers();;
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'find';

    if (count($comms)==0) { $outList['warning'] = LANG_CON_COMMENT_NO_MACH;  }
    return $outList;
}

function commentnumber($get, $page) {
    $outList = array();

    if (isset($get['number_id'])) {
        $_SESSION['number_id'] = $get['number_id'];
        $number_id = $get['number_id'];
    } else {
        $number_id = $_SESSION['number_id'];
    }

    $num = Number::findById($number_id);
    $comms = $num->comments();
    $outList['comms'] = Paginator::paginate($comms, $page);
    $outList['page_numbers'] = Comment::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'commentnumber';

    return $outList;
}

function commentarticle($get, $page) {
    $outList = array();

    if (isset($get['article_id'])) {
        $_SESSION['article_id'] = $get['article_id'];
        $article_id = $get['article_id'];
    } else {
        $article_id = $_SESSION['article_id'];
    }

    $art = Article::findById($article_id);
    $comms = $art->comments();
    
    $outList['comms'] = Paginator::paginate($comms, $page);
    $outList['page_numbers'] = Comment::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'commentarticle';

    return $outList;
}

function newComment($get) {
    $outAction = array();

    $comm = new Comment();
    $outAction['comm'] = $comm;

    if (isset($get['article_id'])) {
        $comm->setArticle_id($get['article_id']);
    }

    return $outAction;
}

function edit($id) {
    $outAction = array();

    $comm = Comment::findById($id);
    $outAction['comm'] = $comm;

    return $outAction;
}

function requestdelete($id, $list, $pageSelected) {
    $outAction = array();

    $comm = Comment::findById($id);
    $outAction['comm'] = $comm;

    $outAction['question'] = LANG_CON_COMMENT_DO_YOU_WANT_DELETE.$comm->getTitle().'? <br />
    <a href="comment.php?action=dodelete&id='.$comm->getId().'&list='.$list.'&pageSelected='.$pageSelected.'">'.LANG_CON_GENERAL_YES.'</a>,
    <a href="comment.php?list='.$list.'&pageSelected='.$pageSelected.'">'.LANG_CON_GENERAL_NO.'</a>';

    return $outAction;
}

function dodelete($id) {
    $outAction = array();

    $comm = Comment::findById($id);
    $comm->delete();
    $comm = new Comment();
    $outAction['comm'] = $comm;

    $outAction['info'] = LANG_CON_COMMENT_DELETED;

    return $outAction;
}

function replay($id) {
    $outAction = array();

    $comm_to_be_replayed = Comment::findById($id);

    $comm = new Comment();
    $comm->setArticle_id($comm_to_be_replayed->getArticle_id());
    $comm->setTitle('Re: '.$comm_to_be_replayed->getTitle());
    $comm->setSignature($_SESSION['user']->getName());
    $outAction['comm'] = $comm;

    return $outAction;
}

function save($toSave) {
    $outAction = array();
    if ($toSave['article_id'] == Article::NEW_ARTICLE) {
        $outAction['comm'] = new Comment();
        $outAction['info'] = LANG_CON_COMMENT_ASSOCIATED_ARTICLE;
    } else {
        if (!isset($toSave['Published'])) { $toSave['Published'] = 0; }

        $comm = new Comment(
            $toSave['id'],
            $toSave['article_id'],
            $toSave['Title'],
            $toSave['Published'],
            $toSave['Body'],
            $toSave['Signature'],
            $toSave['created'],
            $toSave['updated']);
        $comm->save();

        $outAction['comm'] = Comment::findById($comm->getId());
    }
    return $outAction;
}

if (isset($_GET['list'])) { $list = $_GET['list']; }
else { $list = 'index'; }
if (isset($_GET['pageSelected'])) { $page = $_GET['pageSelected']; }
elseif (isset($_POST['page'])) { $page = $_POST['page']; }
else { $page = '1'; }
if (isset($_GET['action'])) { $action = $_GET['action']; }
else { $action = 'newComment'; }

if (isset($_SESSION['user'])) {
    switch ($action) {
        case  'newComment':        $outAction = newComment($_GET); break;
        case  'save':              $outAction = save($_POST); break;
        case  'edit':              $outAction = edit($_GET['id']); break;
        case  'dodelete':          $outAction = dodelete($_GET['id']); break;
        case  'requestdelete':     $outAction = requestdelete($_GET['id'], $_GET['list'], $_GET['pageSelected']); break;
        case  'replay':            $outAction = replay($_GET['id']); break;
    }
    switch ($list) {
        case  'index':             $outList = index($page); break;
        case  'commentnumber':     $outList = commentnumber($_GET, $page); break;
        case  'commentarticle':    $outList = commentarticle($_GET, $page); break;
        case  'find':              $outList = find($_POST); break;
        case  'byuser':            $outList = byuser($page); break;
    }
}

$comms = $outList['comms'];
$lastList = $outList['lastList'];
$page_numbers = $outList['page_numbers'];
$pageSelected = $outList['pageSelected'];

$comm = $outAction['comm'];

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

include('../../view/publisher/comments.php');

?>