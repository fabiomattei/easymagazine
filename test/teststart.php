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

define('BASEDIR', '../');
define('OUTDIR', BASEDIR.'../');
define('STARTPATH', '../');

require_once(BASEDIR.'admin/datamodel/library/strfunction.php');
require_once(OUTDIR.'simpletest/autorun.php');

require_once(BASEDIR.'costants.php');
require_once(BASEDIR.'admin/datamodel/article.php');
require_once(BASEDIR.'admin/datamodel/number.php');
require_once(BASEDIR.'admin/datamodel/comment.php');
require_once(BASEDIR.'admin/datamodel/page.php');
require_once(BASEDIR.'admin/datamodel/user.php');
require_once('dummyDBCreator.php');


require_once('admin/datamodel/library/tstrfunction.php');
require_once('admin/datamodel/tarticle.php');
require_once('admin/datamodel/tnumber.php');
require_once('admin/datamodel/tcomment.php');
require_once('admin/datamodel/tpage.php');
require_once('admin/datamodel/tuser.php');


/**
require_once('../../simpletest/autorun.php');

class AllTests extends TestSuite {
    function AllTests() {
        $this->TestSuite('All tests');
        $this->addFile('../easymagazine/test/admin/datamodel/library/tstrfunction.php');
        $this->addFile('test/admin/datamodel/library/tstrfunction.php');
    }
}
*/


?>
