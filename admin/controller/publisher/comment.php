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
require_once(STARTPATH.DATAMODELPATH.'comment.php');
require_once(STARTPATH.UTILSPATH.'paginator.php');

session_start();

function index($posts) {
    if (isset($posts['page'])) $page = $posts['page'];
    else $page = 1;

    $outList = array();

    $comms = Comment::findAll();
    $outList['comms'] = Paginator::paginate($comms, $page);
    $outList['page_numbers'] = Article::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastAction'] = 'index';

    return $outList;
}

function byuser($posts) {
    if (isset($posts['page'])) $page = $posts['page'];
    else $page = 1;

    $outList = array();

    $comms = $_SESSION['user']->articlescomments();
    $outList['comms'] = Paginator::paginate($comms, $page);
    $outList['page_numbers'] = Article::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastAction'] = 'index';

    return $outList;
}

function find($string) {
    $outList = array();

    $comms = Comment::findInAllTextFields($string);
    $outList['comms'] = $comms;
    $outList['page_numbers'] = 1;
    $outList['pageSelected'] = 1;
    $outList['lastAction'] = 'find';

    if (count($comms)==0) { $outList['warning'] = 'No comments corresponding to search criteria';  }
    return $outList;
}

function commentnumber($id, $posts) {
    if (isset($posts['page'])) $page = $posts['page'];
    else $page = 1;

    $outList = array();

    $num = Number::findById($id);
    $comms = $num->comments();
    $outList['comms'] = Paginator::paginate($comms, $page);
    $outList['page_numbers'] = Article::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastAction'] = 'index';

    return $outList;
}

function commentarticle($id, $posts) {
    if (isset($posts['page'])) $page = $posts['page'];
    else $page = 1;

    $outList = array();

    $art = Article::findById($id);
    $comms = $art->comments();
    $outList['comms'] = Paginator::paginate($comms, $page);
    $outList['page_numbers'] = Article::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastAction'] = 'index';

    return $outList;
}

function edit($id) {
    $outAction = array();

    $comm = Comment::findById($id);
    $outAction['comm'] = $comm;

    return $outAction;
}

function requestdelete($id) {
    $outAction = array();

    $comm = Comment::findById($id);
    $outAction['comm'] = $comm;

    $outAction['question'] = 'Do you really want to delete the comment: '.$comm->getTitle().'? <br />
    <a href="comment.php?action=dodelete&id='.$comm->getId().'">yes</a>,
    <a href="comment.php">no</a>';

    return $outAction;
}

function dodelete($id) {
    $outAction = array();

    $comm = Comment::findById($id);
    $comm->delete();
    $comm = new Comment();
    $outAction['comm'] = $comm;

    $outAction['info'] = 'Comment deleted';

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
    $outAction['comm'] = $comm_to_be_replayed = Comment::findById($comm->getId());

    return $outAction;
}

if (isset($_GET['list'])) { $list = $_GET['list']; }
else { $list = 'index'; }
if (isset($_GET['action'])) { $action = $_GET['action']; }
else { $action = 'newNumber'; }

if (isset($_SESSION['user'])) {
    switch ($_GET["action"]) {
        case  'save':              $outAction = save($_POST); break;
        case  'edit':              $outAction = edit($_GET['id']); break;
        case  'dodelete':          $outAction = dodelete($_GET['id']); break;
        case  'requestdelete':     $outAction = requestdelete($_GET['id']); break;
        case  'replay':            $outAction = replay($_GET['id']); break;
    }
    switch ($list) {
        case  'index':             $outList = index($_POST); break;
        case  'commentnumber':     $outList = commentnumber($_GET['id'], $_POST); break;
        case  'commentarticle':    $outList = commentarticle($_GET['id'], $_POST); break;
        case  'find':              $outList = find($_POST); break;
        case  'byuser':            $outList = byuser($_POST); break;
    }
}

$comms = $outList['comms'];
$lastAction = $outList['lastAction'];
$page_numbers = $outList['page_numbers'];
$pageSelected = $outList['pageSelected'];

$comm = $outAction['comm'];

if (isset($out['info'])) { $info = $out['info']; }
if (isset($out['warning'])) { $warning = $out['warning']; }
if (isset($out['question'])) { $question = $out['question']; }
if (isset($out['error'])) { $error = $out['error']; }

include('../../view/publisher/comments.php');

?>
