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

session_start();

function index() {
    $out = array();

    $comm = new Comment();
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = $comms;

    return $out;
}

function find($string) {
    $out = array();

    $comm = new Comment();
    $out['comm'] = $comm;

    $comms = Comment::findInAllTextFields($string);
    $out['comms'] = $comms;

    if (count($comms)==0) { $out['warning'] = 'No comments corresponding to search criteria';  }
    return $out;
}

function commentnumber($id) {
    $out = array();

    $comm = new Comment();
    $out['comm'] = $comm;

    $num = Number::findById($id);
    $comms = $num->comments();
    $out['comms'] = $comms;

    return $out;
}

function commentarticle($id) {
    $out = array();

    $comm = new Comment();
    $out['comm'] = $comm;

    $art = Article::findById($id);
    $comms = $art->comments();
    $out['comms'] = $comms;

    return $out;
}

function edit($id) {
    $out = array();

    $comm = Comment::findById($id);
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = $comms;

    return $out;
}

function delete($id) {
    $out = array();

    $comm = Comment::findById($id);
    $comm->delete();
    $comm = new Comment();
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = $comms;

    return $out;
}

function replay($id) {
    $out = array();

    $comm_to_be_replayed = Comment::findById($id);

    $comm = new Comment();
    $comm->setArticle_id($comm_to_be_replayed->getArticle_id());
    $comm->setTitle('Re: '.$comm_to_be_replayed->getTitle());
    $comm->setSignature($_SESSION['user']->getName());
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = $comms;

    return $out;
}

function save($toSave) {
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
    $out['comms'] = $comms;

    return $out;
}

if (!isset($_GET["action"])) { $out = index(); }
else {
    switch ($_GET["action"]) {
        case  'index':             $out = index(); break;
        case  'save':              $out = save($_POST); break;
        case  'edit':              $out = edit($_GET['id']); break;
        case  'delete':            $out = delete($_GET['id']); break;
        case  'replay':            $out = replay($_GET['id']); break;
        case  'commentnumber':     $out = commentnumber($_GET['id']); break;
        case  'commentarticle':    $out = commentarticle($_GET['id']); break;
        case  'find':              $out = find($_POST['string']); break;
    }
}

$comms = $out['comms'];
$comm = $out['comm'];

if (isset($out['info'])) { $info = $out['info']; }
if (isset($out['warning'])) { $warning = $out['warning']; }
if (isset($out['question'])) { $question = $out['question']; }
if (isset($out['error'])) { $error = $out['error']; }

include('../../view/publisher/comments.php');

?>
