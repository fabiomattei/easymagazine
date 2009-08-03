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

    $out = array();

    $comm = new Comment();
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = Paginator::paginate($comms, $page);
    $out['page_numbers'] = Article::getPageNumbers();
    $out['pageSelected'] = $page;
    $out['lastAction'] = 'index';

    return $out;
}

function byuser($posts) {
    if (isset($posts['page'])) $page = $posts['page'];
    else $page = 1;

    $out = array();

    $comm = new Comment();
    $out['comm'] = $comm;

    $comms = $_SESSION['user']->articlescomments();
    $out['comms'] = Paginator::paginate($comms, $page);
    $out['page_numbers'] = Article::getPageNumbers();
    $out['pageSelected'] = $page;
    $out['lastAction'] = 'index';

    return $out;
}

function find($string) {
    $out = array();

    $comm = new Comment();
    $out['comm'] = $comm;

    $comms = Comment::findInAllTextFields($string);
    $out['comms'] = $comms;
    $out['page_numbers'] = 1;
    $out['pageSelected'] = 1;
    $out['lastAction'] = 'find';

    if (count($comms)==0) { $out['warning'] = 'No comments corresponding to search criteria';  }
    return $out;
}

function commentnumber($id, $posts) {
    if (isset($posts['page'])) $page = $posts['page'];
    else $page = 1;
    
    $out = array();

    $comm = new Comment();
    $out['comm'] = $comm;

    $num = Number::findById($id);
    $comms = $num->comments();
    $out['comms'] = Paginator::paginate($comms, $page);
    $out['page_numbers'] = Article::getPageNumbers();
    $out['pageSelected'] = $page;
    $out['lastAction'] = 'index';

    return $out;
}

function commentarticle($id, $posts) {
    if (isset($posts['page'])) $page = $posts['page'];
    else $page = 1;
    
    $out = array();

    $comm = new Comment();
    $out['comm'] = $comm;

    $art = Article::findById($id);
    $comms = $art->comments();
    $out['comms'] = Paginator::paginate($comms, $page);
    $out['page_numbers'] = Article::getPageNumbers();
    $out['pageSelected'] = $page;
    $out['lastAction'] = 'index';

    return $out;
}

function edit($id) {
    $page = 1;
    $out = array();

    $comm = Comment::findById($id);
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = Paginator::paginate($comms, $page);
    $out['page_numbers'] = Article::getPageNumbers();
    $out['pageSelected'] = $page;
    $out['lastAction'] = 'index';

    return $out;
}

function requestdelete($id) {
    $page = 1;
    $out = array();

    $comm = Comment::findById($id);
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = Paginator::paginate($comms, $page);
    $out['page_numbers'] = Article::getPageNumbers();
    $out['pageSelected'] = $page;
    $out['lastAction'] = 'index';

    $out['question'] = 'Do you really want to delete the comment: '.$comm->getTitle().'? <br />
    <a href="comment.php?action=dodelete&id='.$comm->getId().'">yes</a>,
    <a href="comment.php">no</a>';

    return $out;
}

function dodelete($id) {
    $page = 1;
    $out = array();

    $comm = Comment::findById($id);
    $comm->delete();
    $comm = new Comment();
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = Paginator::paginate($comms, $page);
    $out['page_numbers'] = Article::getPageNumbers();
    $out['pageSelected'] = $page;
    $out['lastAction'] = 'index';

    $out['info'] = 'Comment deleted';

    return $out;
}

function replay($id) {
    $page = 1;
    $out = array();

    $comm_to_be_replayed = Comment::findById($id);

    $comm = new Comment();
    $comm->setArticle_id($comm_to_be_replayed->getArticle_id());
    $comm->setTitle('Re: '.$comm_to_be_replayed->getTitle());
    $comm->setSignature($_SESSION['user']->getName());
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = Paginator::paginate($comms, $page);
    $out['page_numbers'] = Article::getPageNumbers();
    $out['pageSelected'] = $page;
    $out['lastAction'] = 'index';

    return $out;
}

function save($toSave) {
    $page = 1;
    $out = array();

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
    $out['comm'] = $comm_to_be_replayed = Comment::findById($comm->getId());

    $comms = Comment::findAll();
    $out['comms'] = Paginator::paginate($comms, $page);
    $out['page_numbers'] = Article::getPageNumbers();
    $out['pageSelected'] = $page;
    $out['lastAction'] = 'index';

    return $out;
}

if (!isset($_GET["action"])) { $out = index($_POST); }
else {
    switch ($_GET["action"]) {
        case  'index':             $out = index($_POST); break;
        case  'save':              $out = save($_POST); break;
        case  'edit':              $out = edit($_GET['id']); break;
        case  'dodelete':          $out = dodelete($_GET['id']); break;
        case  'requestdelete':     $out = requestdelete($_GET['id']); break;
        case  'replay':            $out = replay($_GET['id']); break;
        case  'commentnumber':     $out = commentnumber($_GET['id'], $_POST); break;
        case  'commentarticle':    $out = commentarticle($_GET['id'], $_POST); break;
        case  'find':              $out = find($_POST); break;
        case  'byuser':            $out = byuser($_POST); break;
    }
}

$comms = $out['comms'];
$comm = $out['comm'];
$lastAction = $out['lastAction'];
$page_numbers = $out['page_numbers'];
$pageSelected = $out['pageSelected'];

if (isset($out['info'])) { $info = $out['info']; }
if (isset($out['warning'])) { $warning = $out['warning']; }
if (isset($out['question'])) { $question = $out['question']; }
if (isset($out['error'])) { $error = $out['error']; }

include('../../view/publisher/comments.php');

?>
