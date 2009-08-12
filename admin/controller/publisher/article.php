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

function commons() {
    $outCommons = array();
    $outCommons['numbs'] = Number::findAll();
    $outCommons['authors'] = User::findAll();

    return $outCommons;
}

function index($posts) {
    if (isset($posts['page'])) $page = $posts['page'];
    else $page = 1;
    
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

function articlenumber($id) {
    $outList = array();

    $num = Number::findById($id);
    $outList['arts'] = $num->articles();
    $outList['page_numbers'] = 1;
    $outList['pageSelected'] = 1;
    $outList['lastList'] = 'articlenumber';

    return $outList;
}

function byuser($posts) {
    if (isset($posts['page'])) $page = $posts['page'];
    else $page = 1;

    $outList = array();

    $arts = $_SESSION['user']->articles();
    $outList['arts'] = Paginator::paginate($arts, $page);
    $outList['page_numbers'] = Article::getPageNumbers();
    $outList['pageSelected'] = $page;
    $outList['lastList'] = 'byuser';

    return $outList;
}

function find($string) {
    $outList = array();

    $outList['arts'] = Article::findInAllTextFields($string);
    $outList['page_numbers'] = 1;
    $outList['pageSelected'] = 1;
    $outList['lastList'] = 'find';

    if (count($arts)==0) { $outList['warning'] = 'No articles corresponding to search criteria';  }
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

    $outAction['question'] = 'Do you really want to delete the article: '.$art->getTitle().'? <br />
    <a href="article.php?action=dodelete&id='.$art->getId().'&list='.$list.'&pageSelected='.$pageSelected.'">yes</a>,
    <a href="article.php?list='.$list.'&pageSelected='.$pageSelected.'">no</a>';

    return $outAction;
}

function dodelete($id) {
    $outAction = array();

    $art = Article::findById($id);
    $art->delete();
    $art = new Article();
    $outAction['art'] = $art;

    $outAction['info'] = 'Article deleted';

    return $outAction;
}

function deleteimg($id) {
    $outAction = array();

    $art = Article::findById($id);
    $art->deleteImg();
    $outAction['art'] = $art;

    return $outAction;
}

function requestunlinkauthor($idAuthor, $idArticle, $list, $pageSelected) {
    $outAction = array();

    $art = Article::findById($idArticle);
    $outAction['art'] = $art;

    $author = User::findById($idAuthor);

    $outAction['question'] = 'Do you really want to unlink the author '.$author->getName().' - '.$author->getUsername().'
    from the article: '.$art->getTitle().'? <br />
    <a href="article.php?action=dounlinkauthor&idauthor='.$idAuthor.'&idarticle='.$idArticle.'&list='.$list.'&pageSelected='.$pageSelected.'">yes</a>,
    <a href="article.php?list='.$list.'&pageSelected='.$pageSelected.'">no</a>';

    return $outAction;
}

function dounlinkauthor($idAuthor, $idArticle) {
    $outAction = array();

    $art = Article::findById($idArticle);
    $art->unlinkUser($idAuthor);
    $outAction['art'] = $art;

    $outAction['info'] = 'Author unlinked';

    return $outAction;
}

function linkauthor($idAuthor, $idArticle) {
    $page = 1;
    $outAction = array();

    $art = Article::findById($idArticle);
    $art->linkUser($idAuthor);
    $outAction['art'] = $art;

    $outAction['info'] = 'Author linked';

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

    return $outAction;
}

function save($toSave, $files) {
    $page = 1;
    $outAction = array();

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
    $outAction['art'] = $art;

    return $outAction;
}

if (isset($_GET['list'])) { $list = $_GET['list']; }
else { $list = 'index'; }
if (isset($_GET['action'])) { $action = $_GET['action']; }
else { $action = 'newArticle'; }

if (isset($_SESSION['user'])) {
    $outCommons = commons();
    switch ($action) {
        case  'newArticle':          $outAction = newArticle(); break;
        case  'save':                $outAction = save($_POST, $_FILES); break;
        case  'edit':                $outAction = edit($_GET['id']); break;
        case  'dodelete':            $outAction = dodelete($_GET['id']); break;
        case  'requestdelete':       $outAction = requestdelete($_GET['id'], $_GET['list'], $_GET['pageSelected']); break;
        case  'up':                  $outAction = up($_GET['id']); break;
        case  'down':                $outAction = down($_GET['id']); break;
        case  'deleteimg':           $outAction = deleteimg($_GET['id']); break;
        case  'articlenumber':       $outAction = articlenumber($_GET['id']); break;
        case  'linkauthor':          $outAction = linkauthor($_POST['authorid'], $_GET['idarticle']); break;
        case  'requestunlinkauthor': $outAction = requestunlinkauthor($_GET['idauthor'], $_GET['idarticle'], $_GET['list'], $_GET['pageSelected']); break;
        case  'dounlinkauthor':      $outAction = dounlinkauthor($_GET['idauthor'], $_GET['idarticle']); break;
    }
    switch ($list) {
        case  'index':               $outList = index($_POST); break;
        case  'showPublished':       $outList = showPublished($_POST); break;
        case  'showNotPublished':    $outList = showNotPublished($_POST); break;
        case  'find':                $outList = find($_POST); break;
        case  'byuser':              $outList = byuser($_POST); break;
    }
} else {
    header("Location: ../../loginError.php");
}

$numbs = $outCommons['numbs'];
$authors = $outCommons['authors'];

$art = $outAction['art'];

$arts = $outList['arts'];
$lastList = $outList['lastList'];
$page_numbers = $outList['page_numbers'];
$pageSelected = $outList['pageSelected'];

if (isset($out['info'])) { $info = $out['info']; }
if (isset($out['warning'])) { $warning = $out['warning']; }
if (isset($out['question'])) { $question = $out['question']; }
if (isset($out['error'])) { $error = $out['error']; }

include('../../view/publisher/articles.php');

?>