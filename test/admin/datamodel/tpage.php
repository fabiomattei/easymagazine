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

class PageTests extends UnitTestCase {

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
        $pg = Page::findById(1);
		$this->assertPattern('(Page)', $pg->getTitle());
    }

    function testfindAllPublished() {
        $pg = Page::findAllPublished();
		$this->assertEqual(2, count($pg));
    }

    function testfindAll() {
        $pg = Page::findAll();
		$this->assertEqual(3, count($pg));
    }

    function testfindAllOrdered() {
        $pg = Page::findAllOrdered();
		$this->assertEqual(3, count($pg));
        $this->assertEqual(1, $pg[0]->getId());
    }

    function testfindAllPublishedOrdered() {
        $pg = Page::findAllPublishedOrdered();
		$this->assertEqual(2, count($pg));
        $this->assertEqual(1, $pg[0]->getId());
    }

    function testSaveNewPage() {
        $newpage = new Page(Page::NEW_PAGE, '4', '0', 'Page four', 'Subtitle four', 'summary four', 'Body', 'tag', 'metadscritpion', 'metakeyword');
        $newpage->save();
        $pages = Page::findAll();
		$this->assertEqual(4, count($pages));
    }

    function testUpdatePage() {
        $num = Page::findById(1);
        $num->setTitle("New strange Title");
        $num->save();
        $num = Page::findById(1);
        $this->assertPattern('(strange)', $num->getTitle());
    }

    function testDeletePage() {
        $num = Page::findById(1);
        $num->delete();
        $num = Page::findAll();
		$this->assertEqual(2, count($num));
    }

}

$test = new PageTests();
$test->run(new HtmlReporter());

?>
