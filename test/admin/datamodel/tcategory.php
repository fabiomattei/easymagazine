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

class CategoryTests extends UnitTestCase {

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
        $cat = Category::findById(1);
        $this->assertPattern('(News)', $cat->getName());
    }

    function testfindUpIndexNumber () {
        $cat = Category::findUpIndexNumber(1);
        $this->assertPattern('(Sport)', $cat->getName());
    }

    function testfindDownIndexNumber () {
        $cat = Category::findDownIndexNumber(2);
        $this->assertPattern('(News)', $cat->getName());
    }

    function testfindAllPublished() {
        $cat = Category::findAllPublished();
        $this->assertEqual(2, count($cat));
    }

    function testfindAll() {
        $cat = Category::findAll();
        $this->assertEqual(3, count($cat));
    }

    function testfindAllOrderedByIndexNumber() {
        $cat = Category::findAllOrderedByIndexNumber();
        $this->assertEqual(3, count($cat));
        $this->assertPattern('(Relax)', $cat[0]->getName());
    }

    function testfindArticles() {
        $cat = Category::findById(1);
        $arts = $cat->articles();
        $this->assertEqual(14, count($arts));
        $this->assertPattern('(Article)', $arts[0]->getTitle());
    }

    function testfindArticlesPublished() {
        $cat = Category::findById(1);
        $arts = $cat->articlesPublished();
        $this->assertEqual(14, count($arts));
        $this->assertPattern('(Article)', $arts[0]->getTitle());
    }

    function testSaveNewCategory() {
        $newCat = new Category(Category::NEW_CATEGORY, Category::NEW_CATEGORY, '0', 'Hello', 'Hello Articles');
        $newCat->save();
        $cat = Category::findAll();
        $this->assertEqual(4, count($cat));
    }

    function testUpdate() {
        $cat = Category::findById(1);
        $cat->setName("New strange Name");
        $cat->save();
        $cat = Category::findById(1);
        $this->assertPattern('(strange)', $cat->getName());
    }

    function testDelete() {
        $cat = Category::findById(1);
        $cat->delete();
        $cat = Category::findAll();
        $this->assertEqual(2, count($cat));
    }
}

$test = new CategoryTests();
$test->run(new HtmlReporter());

?>
