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

class UserTests extends UnitTestCase {

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

    function testfindById() {
        $usr = User::findById(1);
        $this->assertPattern('(User)', $usr->getName());
    }

    function testfindAll() {
        $usr = User::findAll();
        $this->assertEqual(3, count($usr));
    }

    function testfindArticles() {
        $usr = User::findById(1);
        $arts = $usr->articles();
        $this->assertEqual(2, count($arts));
        $this->assertPattern('(Article)', $arts[0]->getTitle());
    }

    function testfindArticlesComments() {
        $usr = User::findById(1);
        $coms = $usr->articlescomments();
        $this->assertEqual(2, count($coms));
        $this->assertPattern('(comment)', $coms[0]->getTitle());
    }

    function testCheckUsrPsw() {
        $usr = User::checkUsrPsw('newuser','psw');
        $this->assertPattern('(User)', $usr->getName());
    }

    function testCheckChangePsw() {
        $usr = User::checkUsrPsw('newuser','psw');
        $usr->updatePassword('hello','psw');
        $usr = User::checkUsrPsw('newuser','hello');
        $this->assertPattern('(User)', $usr->getName());
    }

    function testSaveNewUser() {
        $newNum = new User(User::NEW_USER, 'New User second', 'newusersecond', 'newpasswordsecond' , 'description example', 'role', '1', 'email@email.com', 'abcdef@abcdef.com', 'abcdef');
        $newNum->save();
        $num = User::findAll();
        $this->assertEqual(4, count($num));
    }

    function testUpdateUser() {
        $usr = User::findById(1);
        $usr->setName("New strange Name");
        $usr->save();
        $usr = User::findById(1);
        $this->assertPattern('(strange)', $usr->getName());
    }

    function testDeleteUser() {
        $num = User::findById(2);
        $num->delete();
        $num = User::findAll();
        $this->assertEqual(2, count($num));
    }

    function testfindUserByUsernameAndEmail() {
        $usr = User::findByUsernameAndEmail('newuser', 'email@email.com');
        $this->assertPattern('(email@email.com)', $usr->getEmail());;
    }
}

$test = new UserTests();
$test->run(new HtmlReporter());

?>
