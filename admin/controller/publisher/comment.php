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

    $art = new Comment();
    $out['art'] = $art;

    $arts = Comment::findAll();
    $out['arts'] = $arts;

    return $out;
}

function edit($id) {
    $out = array();

    $art = Comment::findById($id);
    $out['art'] = $art;

    $arts = Comment::findAll();
    $out['arts'] = $arts;

    return $out;
}

function delete($id) {
    $out = array();

    $art = Comment::findById($id);
    $art->delete();
    $art = new Comment();
    $out['art'] = $art;

    $arts = Comment::findAll();
    $out['arts'] = $arts;

    return $out;
}

function deleteimg($id) {
    $out = array();

    $art = Comment::findById($id);
    $art->deleteImg();
    $out['art'] = $art;

    $arts = Comment::findAll();
    $out['arts'] = $arts;

    return $out;
}

function up($id) {
    $out = array();

    $art1 = Comment::findById($id);
    $art2 = $art1->findUpIndexNumber();

    if ($art2) {
        $art1->setIndexNumber($art2->getIndexNumber());
        $art2->setIndexNumber($indexnumber);
        $art1->save();
        $art2->save();
    }

    $art = new Comment();
    $out['art'] = $art;

    $arts = Comment::findAll();
    $out['arts'] = $arts;

    return $out;
}

function down($id) {
    $out = array();

    $art1 = Comment::findById($id);
    $art2 = $art1->findDownIndexNumber();

    if ($art2) {
        $art1->setIndexNumber($art2->getIndexNumber());
        $art2->setIndexNumber($indexnumber);
        $art1->save();
        $art2->save();
    }

    $art = new Comment();
    $out['art'] = $art;

    $arts = Comment::findAll();
    $out['arts'] = $arts;

    return $out;
}

function save($toSave) {
    $out = array();

    if (!isset($toSave['Published'])) { $toSave['Published'] = 0; }
    if (!isset($toSave['commentsallowed'])) { $toSave['commentsallowed'] = 0; }
    if (!isset($toSave['imagefilename'])) { $toSave['imagefilename'] = ''; }

    $art = new Comment(
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

    $arts = Comment::findAll();
    $out['arts'] = $arts;

    return $out;
}

if (!isset($_GET["action"])) { $out = index(); }
else {
	switch ($_GET["action"]) {
		case  'index':             $out = index(); break;
		case  'save':              $out = save($_POST); break;
		case  'edit':              $out = edit($_GET['id']); break;
		case  'delete':            $out = delete($_GET['id']); break;
		case  'up':                $out = up($_GET['id']); break;
		case  'down':              $out = down($_GET['id']); break;
		case  'deleteimg':         $out = deleteimg($_GET['id']); break;
	}
}

$arts = $out['arts'];
$art = $out['art'];

include('../../view/publisher/Comments.php');

?>
