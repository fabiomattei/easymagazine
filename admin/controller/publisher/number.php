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
require_once(STARTPATH.DATAMODELPATH.'number.php');
require_once(STARTPATH.UTILSPATH.'paginator.php');

session_start();

function index($posts) {
    if (isset($posts['page'])) $page = $posts['page'];
    else $page = 1;

    $out = array();

    $numb = new Number();
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = Paginator::paginate($numbs, $page);
    $out['page_numbers'] = Number::getPageNumbers();
    $out['pageSelected'] = $page;

    $out['lastAction'] = 'index';

    return $out;
}


function find($posts) {
    if (isset($posts['page'])) {
        $page = $posts['page'];
        $string = $_SESSION['oldstring'];
    } else {
        $string = $posts['string'];
        $page = 1;
    }

    $out = array();

    $numb = new Number();
    $out['numb'] = $numb;

    $numbs = Number::findInAllTextFields($string);
    $out['numbs'] = Paginator::paginate($numbs, $page);
    $out['page_numbers'] = Number::getPageNumbers();
    $out['pageSelected'] = $page;

    $out['lastAction'] = 'find';

    if (count($numbs)==0) { $out['warning'] = 'No numbers corresponding to search criteria';  }
    return $out;
}

function edit($id) {
    $out = array();

    $numb = Number::findById($id);
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = $numbs;
    $out['page_numbers'] = Number::getPageNumbers();

    $out['pageSelected'] = 1;
    $out['lastAction'] = 'index';

    return $out;
}

function requestdelete($id) {
    $out = array();

    $numb = Number::findById($id);
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = $numbs;
    $out['page_numbers'] = Number::getPageNumbers();

    $out['pageSelected'] = 1;
    $out['lastAction'] = 'index';

    $out['question'] = 'Do you really want to delete the number: '.$numb->getTitle().'? <br />
    <a href="number.php?action=dodelete&id='.$numb->getId().'">yes</a>,
    <a href="number.php">no</a>';

    return $out;
}

function dodelete($id) {
    $out = array();

    $numb = Number::findById($id);
    $numb->delete();
    $numb = new Number();
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = $numbs;
    $out['page_numbers'] = Number::getPageNumbers();

    $out['pageSelected'] = 1;
    $out['lastAction'] = 'index';

    $out['info'] = 'Number deleted';

    return $out;
}

function deleteimg($id) {
    $out = array();

    $numb = Number::findById($id);
    $numb->deleteImg();
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = $numbs;
    $out['page_numbers'] = Number::getPageNumbers();

    $out['pageSelected'] = 1;
    $out['lastAction'] = 'index';

    return $out;
}

function up($id) {
    $out = array();

    $numb1 = Number::findById($id);
    $indexnumber = $numb1->getIndexNumber();
    $numb2 = Number::findUpIndexNumber($indexnumber);

    if ($numb2) {
        $numb1->setIndexNumber($numb2->getIndexNumber());
        $numb2->setIndexNumber($indexnumber);
        $numb1->save();
        $numb2->save();
    }

    $numb = new Number();
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = $numbs;
    $out['page_numbers'] = Number::getPageNumbers();

    $out['pageSelected'] = 1;
    $out['lastAction'] = 'index';

    return $out;
}

function down($id) {
    $out = array();

    $numb1 = Number::findById($id);
    $indexnumber = $numb1->getIndexNumber();
    $numb2 = Number::findDownIndexNumber($indexnumber);

    if ($numb2) {
        $numb1->setIndexNumber($numb2->getIndexNumber());
        $numb2->setIndexNumber($indexnumber);
        $numb1->save();
        $numb2->save();
    }

    $numb = new Number();
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = $numbs;
    $out['page_numbers'] = Number::getPageNumbers();

    $out['pageSelected'] = 1;
    $out['lastAction'] = 'index';

    return $out;
}

function save($toSave, $files) {
    $out = array();

    if (!isset($toSave['Published'])) { $toSave['Published'] = 0; }
    if (!isset($toSave['commentsallowed'])) { $toSave['commentsallowed'] = 0; }
    if (!isset($toSave['imagefilename'])) { $toSave['imagefilename'] = ''; }

    $numb = new Number(
        $toSave['id'],
        $toSave['indexnumber'],
        $toSave['Published'],
        $toSave['Title'],
        $toSave['SubTitle'],
        $toSave['Summary'],
        $toSave['commentsallowed'],
        $toSave['imagefilename'],
        $toSave['ImageDescription'],
        $toSave['created'],
        $toSave['updated']);
    $numb->save();

    if (isset($files['Image']) && $files['Image']['size'] > 0) {
        $numb->deleteImg();
        $numb->saveImg($files['Image']);
    }
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = $numbs;
    $out['page_numbers'] = Number::getPageNumbers();

    $out['pageSelected'] = 1;
    $out['lastAction'] = 'index';

    return $out;
}


if (isset($_SESSION['user'])) {
    if (!isset($_GET['action'])) { $out = index($_POST); }
    else {
        switch ($_GET['action']) {
            case  'index':             $out = index($_POST); break;
            case  'save':              $out = save($_POST, $_FILES); break;
            case  'edit':              $out = edit($_GET['id']); break;
            case  'dodelete':          $out = dodelete($_GET['id']); break;
            case  'requestdelete':     $out = requestdelete($_GET['id']); break;
            case  'up':                $out = up($_GET['id']); break;
            case  'down':              $out = down($_GET['id']); break;
            case  'deleteimg':         $out = deleteimg($_GET['id']); break;
            case  'find':              $out = find($_POST); break;
        }
    }
} else {
    header("Location: ../../loginError.php");
}

$numbs = $out['numbs'];
$numb = $out['numb'];
$page_numbers = $out['page_numbers'];
$pageSelected = $out['pageSelected'];
$lastAction = $out['lastAction'];

if (isset($out['info'])) { $info = $out['info']; }
if (isset($out['warning'])) { $warning = $out['warning']; }
if (isset($out['question'])) { $question = $out['question']; }
if (isset($out['error'])) { $error = $out['error']; }

include('../../view/publisher/numbers.php');

?>
