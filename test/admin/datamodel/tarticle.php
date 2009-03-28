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

//define('BASEDIR', '../');
//define('OUTDIR', BASEDIR.'../');

define('STARTPATH', '../');

//require_once(BASEDIR.'config.php');
require_once(BASEDIR.'costants.php');
require_once(BASEDIR.'admin/datamodel/article.php');
require_once('dummyDBCreator.php');
require_once(OUTDIR.'simpletest/autorun.php');

class ArticleTests extends UnitTestCase {

    private $db;

    public function __construct() {
        $this->db = new DbCreator();
        $this->db->connect();
    }

	function setUp() {
        $this->db->dropSchema();
        $this->db->createSchema();
        $this->db->populateSchema();
	}

	public function tearDown() {
        $this->db->dropSchema();
	}

    function testFindById() {
        $ar = Article::findById(1);
		$this->assertPattern('(Article)', $ar->getTitle());
    }

    function testfindUpIndexNumber () {
        $ar = Article::findUpIndexNumber(2);
		$this->assertPattern('(third)', $ar->getTitle());
    }

    function testfindDownIndexNumber () {
        $ar = Article::findDownIndexNumber(2);
		$this->assertPattern('(first)', $ar->getTitle());
    }

//    function testfindByTitle() {
//        $ar = Article::findByTitle('Article');
//		$this->assertPattern('(Article)', $ar->getTitle());
//    }

    function testfindLast() {
        $ar = Article::findLast();
		$this->assertPattern('(Article)', $ar->getTitle());
    }

    function testfindAllPublished() {
        $ar = Article::findAllPublished();
		$this->assertPattern('(Article)', $ar[0]->getTitle());
    }

    function testfindAll() {
        $ar = Article::findAll();
		$this->assertPattern('(Article)', $ar[0]->getTitle());
    }

    function testfindAllOrderedByIndexNumber() {
        $ar = Article::findAllOrderedByIndexNumber();
		$this->assertPattern('(Article)', $ar[0]->getTitle());
    }

}

$test = new ArticleTests();
$test->run(new HtmlReporter());

?>
