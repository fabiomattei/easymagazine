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
        $ar = Article::findById(2);
        $ar2 = $ar->findUpIndexNumber();
		$this->assertPattern('(third)', $ar2->getTitle());
    }

    function testfindDownIndexNumber () {
        $ar = Article::findById(2);
        $ar2 = $ar->findDownIndexNumber();
		$this->assertPattern('(first)', $ar2->getTitle());
    }

    function testfindByTitle() {
        $ar = Article::findByTitle('first');
		$this->assertPattern('(first)', $ar[0]->getTitle());
    }

    function testfindLast() {
        $ar = Article::findLast();
		$this->assertPattern('(third)', $ar->getTitle());
    }

    function testfindAllPublished() {
        $ar = Article::findAllPublished();
		$this->assertEqual(2, count($ar));
    }

    function testfindAll() {
        $ar = Article::findAll();
		$this->assertEqual(3, count($ar));
    }

    function testfindAllOrderedByIndexNumber() {
        $ar = Article::findAllOrderedByIndexNumber();
		$this->assertEqual(3, count($ar));
		$this->assertPattern('(third)', $ar[0]->getTitle());
    }

    function testArticleNumber() {
        $ar = Article::findById(1);
        $num = $ar->Number();
        $this->assertPattern('(My first number)', $num->getTitle());
    }

    function testArticleComments() {
        $ar = Article::findById(1);
        $coms = $ar->comments();
        $this->assertEqual(2, count($coms));
        $this->assertPattern('(My first comment)', $coms[0]->getTitle());
    }

    function testArticleCommentsPublished() {
        $ar = Article::findById(1);
        $coms = $ar->commentsPublished();
        $this->assertEqual(1, count($coms));
        $this->assertPattern('(My first comment)', $coms[0]->getTitle());
    }

    function testSaveNewArticle() {
        $newArt = new Article(Article::NEW_ARTICLE, '1', '1', '6', '0', 'Article four', 'Subtitle four', 'summary four', 'body four', '1', 'tag four', 'metadescription four', 'metakeyword four');
        $newArt->save();
        $arts = Article::findAll();
	$this->assertEqual(4, count($arts));
    }

    function testUpdateArticle() {
        $ar = Article::findById(1);
        $ar->setTitle("New strange Title");
        $ar->save();
        $ar = Article::findById(1);
        $this->assertPattern('(strange)', $ar->getTitle());
    }

    function testDeleteArticle() {
        $num = Article::findById(1);
        $num->delete();
        $num = Article::findAll();
		$this->assertEqual(2, count($num));
    }

    function testUsers() {
        $art = Article::findById(1);
        $usrs = $art->users();
		$this->assertEqual(2, count($usrs));
    }
}

$test = new ArticleTests();
$test->run(new HtmlReporter());

?>
