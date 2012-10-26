<?php

/*
    Copyright (C) 2009-2012  Fabio Mattei <burattino@gmail.com>

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

class CommentTests extends UnitTestCase {

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
        $num = Comment::findById(1);
		$this->assertPattern('(first)', $num->getTitle());
    }

    function testFindAll() {
        $num = Comment::findAll();
        $this->assertEqual(2, count($num));
    }

    function testfindByTitle() {
        $num = Comment::findByTitle('first');
		$this->assertPattern('(first)', $num[0]->getTitle());
    }

    function testSaveNewComment() {
        $newCmt = new Comment(Comment::NEW_COMMENT, Comment::NEW_COMMENT, 'New Comment', '1', 'New Comment Body', 'Fabio');
        $newCmt->save();
        $num = Comment::findAll();
		$this->assertEqual(3, count($num));
    }

    function testUpdateComment() {
        $comt = Comment::findById(1);
        $comt->setTitle("New strange Title");
        $comt->save();
        $comt = Comment::findById(1);
        $this->assertPattern('(strange)', $comt->getTitle());
    }

    function testDeleteComment() {
        $comt = Comment::findById(1);
        $comt->delete();
        $comt = Comment::findAll();
		$this->assertEqual(1, count($comt));
    }

    function testArticle() {
        $comt = Comment::findById(1);
        $art = $comt->article();
	$this->assertPattern('(first Article)', $art->getTitle());
    }
}

$test = new CommentTests();
$test->run(new HtmlReporter());

?>
