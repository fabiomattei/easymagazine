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
require_once(STARTPATH.DATAMODELPATH.'article.php');
require_once(STARTPATH.DATAMODELPATH.'number.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');
require_once(STARTPATH.UTILSPATH.'paginator.php');

session_start();

function index() {
    $out = array();

    $art = new Article();
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;

    $numbs = Number::findAll();
    $out['numbs'] = $numbs;

    $out['lastAction'] = 'index';

    $out['authors'] = User::findAll();

    return $out;
}

function articlenumber($id) {
    $out = array();

    $art = new Article();
    $out['art'] = $art;

    $num = Number::findById($id);
    $arts = $num->articles();
    $out['arts'] = $arts;

    $numbs = Number::findAll();
    $out['numbs'] = $numbs;

    $out['authors'] = User::findAll();

    return $out;
}

function find($string) {
    $out = array();

    $art = new Article();
    $out['art'] = $art;

    $arts = Article::findInAllTextFields($string);
    $out['arts'] = $arts;

    $numbs = Number::findAll();
    $out['numbs'] = $numbs;

    $out['authors'] = User::findAll();

    if (count($arts)==0) { $out['warning'] = 'No articles corresponding to search criteria';  }
    return $out;
}

function edit($id) {
    $out = array();

    $art = Article::findById($id);
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;

    $numbs = Number::findAll();
    $out['numbs'] = $numbs;

    $out['authors'] = User::findAll();

    return $out;
}

function requestdelete($id) {
    $out = array();

    $art = Article::findById($id);
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;

    $numbs = Number::findAll();
    $out['numbs'] = $numbs;

    $out['authors'] = User::findAll();

    $out['question'] = 'Do you really want to delete the article: '.$art->getTitle().'? <br />
    <a href="article.php?action=dodelete&id='.$art->getId().'">yes</a>,
    <a href="article.php">no</a>';

    return $out;
}

function dodelete($id) {
    $out = array();

    $art = Article::findById($id);
    $art->delete();
    $art = new Article();
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;

    $numbs = Number::findAll();
    $out['numbs'] = $numbs;

    $out['authors'] = User::findAll();

    $out['info'] = 'Article deleted';

    return $out;
}

function deleteimg($id) {
    $out = array();

    $art = Article::findById($id);
    $art->deleteImg();
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;

    $numbs = Number::findAll();
    $out['numbs'] = $numbs;

    $out['authors'] = User::findAll();

    return $out;
}

function up($id) {
    $out = array();

    $art1 = Article::findById($id);
    $art2 = $art1->findUpIndexNumber();

    if ($art2) {
        $art1->setIndexNumber($art2->getIndexNumber());
        $art2->setIndexNumber($indexnumber);
        $art1->save();
        $art2->save();
    }

    $art = new Article();
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;

    $numbs = Number::findAll();
    $out['numbs'] = $numbs;

    $out['authors'] = User::findAll();

    return $out;
}

function down($id) {
    $out = array();

    $art1 = Article::findById($id);
    $art2 = $art1->findDownIndexNumber();

    if ($art2) {
        $art1->setIndexNumber($art2->getIndexNumber());
        $art2->setIndexNumber($indexnumber);
        $art1->save();
        $art2->save();
    }

    $art = new Article();
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;

    $numbs = Number::findAll();
    $out['numbs'] = $numbs;

    $out['authors'] = User::findAll();

    return $out;
}

function save($toSave, $files) {
    $out = array();

    if (!isset($toSave['Published'])) { $toSave['Published'] = 0; }
    if (!isset($toSave['commentsallowed'])) { $toSave['commentsallowed'] = 0; }
    if (!isset($toSave['imagefilename'])) { $toSave['imagefilename'] = ''; }

    $art = new Article(
        $toSave['id'],
        $toSave['numberid'],
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
        $toSave['imagefilename'],
        $toSave['ImageDescription'],
        $toSave['created'],
        $toSave['updated']);
    $art->save();
    if (isset($files['Image']) && $files['Image']['size'] > 0) {
        $art->deleteImg();
        $art->saveImg($files['Image']);
    }
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;

    $numbs = Number::findAll();
    $out['numbs'] = $numbs;

    $out['authors'] = User::findAll();

    return $out;
}

if (!isset($_GET["action"])) { $out = index(); }
else {
    switch ($_GET["action"]) {
        case  'index':             $out = index(); break;
        case  'save':              $out = save($_POST, $_FILES); break;
        case  'edit':              $out = edit($_GET['id']); break;
        case  'dodelete':          $out = dodelete($_GET['id']); break;
        case  'requestdelete':     $out = requestdelete($_GET['id']); break;
        case  'up':                $out = up($_GET['id']); break;
        case  'down':              $out = down($_GET['id']); break;
        case  'deleteimg':         $out = deleteimg($_GET['id']); break;
        case  'articlenumber':     $out = articlenumber($_GET['id']); break;
        case  'find':              $out = find($_POST['string']); break;
    }
}

$arts = $out['arts'];
$art = $out['art'];
$numbs = $out['numbs'];
$authors = $out['authors'];

if (isset($out['info'])) { $info = $out['info']; }
if (isset($out['warning'])) { $warning = $out['warning']; }
if (isset($out['question'])) { $question = $out['question']; }
if (isset($out['error'])) { $error = $out['error']; }

include('../../view/publisher/articles.php');

?>
