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

//require_once(BASEDIR.'admin/datamodel/library/db.php');

require_once(OUTDIR.'simpletest/autorun.php');
//require_once(OUTDIR.'simpletest/web_tester.php');
//require_once(OUTDIR.'simpletest/unit_tester.php');
//require_once(OUTDIR.'simpletest/reporter.php');

class DBTests extends UnitTestCase {

    public function __construct() {
    }

	function setUp() {
	}
	
	public function tearDown() {
	}
	
   function TestListaMacchinari() {
	    //formatQRY($str, $array_strings, $array_int ,$tables)
		$this->assertPattern('(Saldatrice)', 'fabio');
    }

   function TestProva() {
	    //formatQRY($str, $array_strings, $array_int ,$tables)
		$this->assertPattern('(Saldatrice)', 'Saldatrice');
    }

}

$test = new DBTests();
$test->run(new HtmlReporter());

?>
