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
require_once(STARTPATH.DATAMODELPATH.'page.php');

session_start();

function index() {
    $out = array();

    $pag = new Page();
    $out['pag'] = $pag;

    $pags = Page::findAllOrderedByIndexNumber();
    $out['pags'] = $pags;
    return $out;
}

function edit($id) {
    $out = array();

    $pag = Page::findById($id);
    $out['pag'] = $pag;

    $pags = Page::findAllOrderedByIndexNumber();
    $out['pags'] = $pags;
    return $out;
}

function delete($id) {
    $out = array();

    $pag = Page::findById($id);
    $pag->delete();
    $pag = new Page();
    $out['pag'] = $pag;

    $pags = Page::findAllOrderedByIndexNumber();
    $out['pags'] = $pags;
    return $out;
}

function deleteimg($id) {
    $out = array();

    $pag = Page::findById($id);
    $pag->deleteImg();
    $out['pag'] = $pag;

    $pags = Page::findAllOrderedByIndexNumber();
    $out['pags'] = $pags;
    return $out;
}

function up($id) {
    $out = array();

    $pag1 = Page::findById($id);
    $pag2 = $pag1->findUpIndexNumber();

    if ($pag2) {
        $pag1->setIndexNumber($pag2->getIndexNumber());
        $pag2->setIndexNumber($indexnumber);
        $pag1->save();
        $pag2->save();
    }

    $pag = new Page();
    $out['pag'] = $pag;

    $pags = Page::findAllOrderedByIndexNumber();
    $out['pags'] = $pags;
    return $out;
}

function down($id) {
    $out = array();

    $pag1 = Page::findById($id);
    $pag2 = $pag1->findDownIndexNumber();

    if ($pag2) {
        $pag1->setIndexNumber($pag2->getIndexNumber());
        $pag2->setIndexNumber($indexnumber);
        $pag1->save();
        $pag2->save();
    }

    $pag = new Page();
    $out['pag'] = $pag;

    $pags = Page::findAllOrderedByIndexNumber();
    $out['pags'] = $pags;
    return $out;
}

function save($toSave, $files) {
    $out = array();

    if (!isset($toSave['Published'])) { $toSave['Published'] = 0; }
    if (!isset($toSave['imagefilename'])) { $toSave['imagefilename'] = ''; }

    $pag = new Page(
        $toSave['id'],
        $toSave['indexnumber'],
        $toSave['Published'],
        $toSave['Title'],
        $toSave['SubTitle'],
        $toSave['Summary'],
        $toSave['Body'],
        $toSave['Tag'],
        $toSave['MetaDescription'],
        $toSave['MetaKeyword'],
        $toSave['imagefilename'],
        $toSave['ImageDescription'],
        $toSave['created'],
        $toSave['updated']);
    $pag->save();

    if (isset($files['Image']) && $files['Image']['size'] > 0) {
        $pag->deleteImg();
        $pag->saveImg($files['Image']);
    }
    $out['pag'] = $pag;

    $pags = Page::findAllOrderedByIndexNumber();
    $out['pags'] = $pags;
    return $out;
}

if (!isset($_GET["action"])) { $out = index(); }
else {
	switch ($_GET["action"]) {
		case  'index':             $out = index(); break;
		case  'save':              $out = save($_POST, $_FILES); break;
		case  'edit':              $out = edit($_GET['id']); break;
		case  'delete':            $out = delete($_GET['id']); break;
		case  'up':                $out = up($_GET['id']); break;
		case  'down':              $out = down($_GET['id']); break;
		case  'deleteimg':         $out = deleteimg($_GET['id']); break;
	}
}

$pags = $out['pags'];
$pag = $out['pag'];

include('../../view/publisher/Pages.php');

?>
