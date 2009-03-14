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

define('STARTPATH', '../../');

require_once(STARTPATH.'config.php');
require_once(STARTPATH.'costants.php');
require_once(STARTPATH.DATAMODELPATH.'article.php');

function index() {
    $out = array();

    $art = new Article();
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;
    return $out;
}

function edit($id) {
    $out = array();

    $art = Article::findById($id);
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;
    return $out;
}

function delete($id) {
    $out = array();

    $art = Article::findById($id);
    $art->delete();
    $art = new Number();
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;
    return $out;
}

function up($id) {
    $out = array();

    $art1 = Article::findById($id);
    $indexnumber = $art1->getIndexNumber();
    $art2 = Article::findUpIndexNumber($indexnumber);

    $art1->setIndexNumber($art2->getIndexNumber());
    $art2->setIndexNumber($indexnumber);
    $art1->save();
    $art2->save();

    $art = new Article();
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;
    return $out;
}

function down($id) {
    $out = array();

    $art1 = Article::findById($id);
    $indexnumber = $art1->getIndexNumber();
    $art2 = Article::findDownIndexNumber($indexnumber);

    $art1->setIndexNumber($art2->getIndexNumber());
    $art2->setIndexNumber($indexnumber);
    $art1->save();
    $art2->save();

    $art = new Article();
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
    $out['arts'] = $arts;
    return $out;
}

function save($toSave) {
    $out = array();

    $art = new Article(
        $toSave['id'],
        $toSave['number_id'],
        $toSave['indexnumber'],
        $toSave['Published'],
        $toSave['Title'],
        $toSave['SubTitle'],
        $toSave['Summary'],
        $toSave['Body'],
        $toSave['Tag'],
        $toSave['MetaDescription'],
        $toSave['MetaKeyword']);
    $art->save();
    $out['art'] = $art;

    $arts = Article::findAllOrderedByIndexNumber();
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
    }
}

$arts = $out['arts'];
$art = $out['art'];

include('../view/publisher/articles.php');

?>
