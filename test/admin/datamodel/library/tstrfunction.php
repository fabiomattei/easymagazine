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

require_once(BASEDIR.'admin/datamodel/library/strfunction.php');
require_once(OUTDIR.'simpletest/autorun.php');

class StrHelperTests extends UnitTestCase {

    public function __construct() {
    }

	function setUp() {
	}
	
	public function tearDown() {
	}
	
   function TestStringInCompleteQuery() {
	    $str = 'insert into articles (id, number_id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values (#, #, #, #, ?, ?, ?, ?, ?, ?, ?, now(), now())';
	    $array_strings = array("Titolo", "Sottotitolo", "sommario", "body", "TAg1 tag 2", "Metadescription", "Metakeyword");
        $array_int = array(1, 2, 3, 1);
        $tables = array("articles" => "Pretab"."articles");
	    $out = StrHelper::formatQRY($str, $array_strings, $array_int ,$tables);
		$this->assertPattern('(Titolo)', $out);
    }

   function TestNumberInCompleteQuery() {
	    $str = 'insert into articles (id, number_id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values (#, #, #, #, ?, ?, ?, ?, ?, ?, ?, now(), now())';
	    $array_strings = array("Titolo", "Sottotitolo", "sommario", "body", "TAg1 tag 2", "Metadescription", "Metakeyword");
        $array_int = array(1, 2, 3, 1);
        $tables = array("articles" => "Pretab"."articles");
	    $out = StrHelper::formatQRY($str, $array_strings, $array_int ,$tables);
		$this->assertPattern('(1)', $out);
    }

   function TestTableNameInCompleteQuery() {
	    $str = 'insert into articles (id, number_id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values (#, #, #, #, ?, ?, ?, ?, ?, ?, ?, now(), now())';
	    $array_strings = array("Titolo", "Sottotitolo", "sommario", "body", "TAg1 tag 2", "Metadescription", "Metakeyword");
        $array_int = array(1, 2, 3, 1);
        $tables = array("articles" => "Pretab"."articles");
	    $out = StrHelper::formatQRY($str, $array_strings, $array_int ,$tables);
		$this->assertPattern('(Pretabarticles)', $out);
    }

   function TestReplaceTitoloString() {
	    $str = 'insert into articles (id, number_id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values (#, #, #, #, ?, ?, ?, ?, ?, ?, ?, now(), now())';
	    $array = array("Titolo", "Sottotitolo", "sommario", "body", "TAg1 tag 2", "Metadescription", "Metakeyword");
	    $out = StrHelper::replaceStrings($str, $array);
		$this->assertPattern('(Titolo)', $out);
    }

   function TestReplaceMetakeywordString() {
	    $str = 'insert into articles (id, number_id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values (#, #, #, #, ?, ?, ?, ?, ?, ?, ?, now(), now())';
	    $array = array("Titolo", "Sottotitolo", "sommario", "body", "TAg1 tag 2", "Metadescription", "Metakeyword");
	    $out = StrHelper::replaceStrings($str, $array);
		$this->assertPattern('(Metakeyword)', $out);
    }

    function TestReplaceIdNumber() {
	    $str = 'insert into articles (id, number_id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values (#, #, #, #, ?, ?, ?, ?, ?, ?, ?, now(), now())';
	    $array = array(1, 2, 3, 4);
	    $out = StrHelper::replaceNumbers($str, $array);
		$this->assertPattern('(1)', $out);
    }

    function TestReplaceLastNumber() {
	    $str = 'insert into articles (id, number_id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values (#, #, #, #, ?, ?, ?, ?, ?, ?, ?, now(), now())';
	    $array = array(1, 2, 3, 4);
	    $out = StrHelper::replaceNumbers($str, $array);
		$this->assertPattern('(4)', $out);
    }

    function TestReplaceTableName() {
	    $str = 'insert into articles (id, number_id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values (#, #, #, #, ?, ?, ?, ?, ?, ?, ?, now(), now())';
	    $tables = array("articles" => "Pretab"."articles");
	    $out = StrHelper::fixTableName($str, $tables);
		$this->assertPattern('(Pretabarticles)', $out);
    }
}

$test = new StrHelperTests();
$test->run(new HtmlReporter());

?>
