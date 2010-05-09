<?php
/*
    Copyright (C) 2009-2010  Fabio Mattei <burattino@gmail.com>

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

require_once(OUTDIR.'simpletest/web_tester.php');
require_once(OUTDIR.'simpletest/autorun.php');

//require_once('dummyDBCreator.php');

/* Repopulates the schema in order to restart to develop */
/*
$db = new DbCreator();
$db->connect();
$db->dropSchema();
$db->createSchema();
$db->populateSchema();
 */

/*
 * Manualino chiamate utili:
 * 
 * $this->get('http://localhost:8888/easymagazine/admin/login.php');
 * $this->assertText('Username');
 * $this->click('Testo link');
 * $this->setFieldByName('username', 'user');
 * $this->setFieldByName('password', 'psw');
 * $this->setFieldById('idfield', 'testo da inserire');
 * $this->click('Ok');
 * $this->assertText('Benvenuto');
 * $this->assertTitle('Amministrazione'); Deve essere tutto uguale uguale
 *
 */

class AllAcceptanceTests extends TestSuite {

    
    function __construct() {
        parent::__construct('All Acceptance Tests');
        $this->addFile('admin/view/publisher/numberst.php');
        $this->addFile('admin/view/publisher/articlest.php');
    }

    /*
    function AllTests() {
        $this->TestSuite('All tests for SimpleTest ' . SimpleTest::getVersion());
        $this->addFile('admin/view/publisher/numberst.php');
        $this->addFile('admin/view/publisher/articlest.php');
    }*/

}

$test = new AllAcceptanceTests();
$test->run(new HtmlReporter());

?>
