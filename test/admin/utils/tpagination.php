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

class PaginationTests extends UnitTestCase {

    public function __construct() {
    }

    function setUp() {
    }

    function tearDown() {
    }

    function testcalculatePageNumbers() {
        $pages = Pagination::calculatePageNumbers(5);
        $this->assertEqual(1, $pages);
    }

    function testcalculatePageNumbers2() {
        $pages = Pagination::calculatePageNumbers(0);
        $this->assertEqual(1, $pages);
    }

    function testcalculatePageNumbers3() {
        $pages = Pagination::calculatePageNumbers(10);
        $this->assertEqual(1, $pages);
    }

    function testcalculatePageNumbers4() {
        $pages = Pagination::calculatePageNumbers(16);
        $this->assertEqual(2, $pages);
    }

    function testcalculatePageNumbers5() {
        $pages = Pagination::calculatePageNumbers(26);
        $this->assertEqual(3, $pages);
    }
}

$test = new PaginationTests();
$test->run(new HtmlReporter());

?>
