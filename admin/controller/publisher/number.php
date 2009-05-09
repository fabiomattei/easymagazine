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

session_start();

function index() {
    $out = array();

    $numb = new Number();
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = $numbs;
    return $out;
}

function edit($id) {
    $out = array();

    $numb = Number::findById($id);
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = $numbs;
    return $out;
}

function delete($id) {
    $out = array();

    $numb = Number::findById($id);
    $numb->delete();
    $numb = new Number();
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = $numbs;
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
    return $out;
}

function save($toSave) {
    $out = array();

    if (!isset ($toSave['Published'])) { $toSave['Published'] = 0; }
    if (!isset ($toSave['commentsallowed'])) { $toSave['commentsallowed'] = 0; }

    $numb = new Number(
        $toSave['id'],
        $toSave['indexnumber'],
        $toSave['Published'] ,
        $toSave['Title'],
        $toSave['SubTitle'],
        $toSave['Summary'],
        $toSave['commentsallowed']);
    $numb->save();
    $out['numb'] = $numb;

    $numbs = Number::findAllOrderedByIndexNumber();
    $out['numbs'] = $numbs;
    return $out;
}


if (isset($_SESSION['user'])) {
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
    } else {
         header("Location: ../../loginError.php");
}

$numbs = $out['numbs'];
$numb = $out['numb'];

include('../../view/publisher/numbers.php');

?>
