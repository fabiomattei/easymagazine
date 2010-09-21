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

class TestWebSite extends WebTestCase {

    function testHomePage(){
        $this->get(BASEADDRESSHTTP);
        $this->assertText('My 14th number');
    }

    function testPeoplePage(){
        $this->get(BASEADDRESSHTTP);
        $this->click('People');
        $this->assertText('New User');
        $this->assertText('Second User');
    }

    function testNumbersPage(){
        $this->get(BASEADDRESSHTTP);
        $this->click('Numbers');
        $this->assertText('My 13 number');
        $this->assertText('My 12 number');
        $this->click('Last');
        $this->assertText('My 4th number');
    }

    function testPagePage(){
        $this->get(BASEADDRESSHTTP);
        $this->click('My second Page');
        $this->assertText('Body of my second page');
    }

    function testCategoriesPage(){
        $this->get(BASEADDRESSHTTP);
        $this->click('News');
        $this->assertText('My third Article');
    }

    function testNumberPage(){
        $this->get(BASEADDRESSHTTP);
        $this->click('My 13 number');
        $this->assertText('My 13 number');
    }

    function testSearchPage(){
        $this->get(BASEADDRESSHTTP);
        $this->setFieldByName('s', 'article');
        $this->click('Search');
        $this->assertText('My first Article');
        $this->click('Last');
        $this->assertText('My third Article');
    }

    function testCommentPage(){
        $this->get(BASEADDRESSHTTP);
        $this->click('My final Article');
        $this->click('comments');
        $this->assertText('My final Article');
        $this->setFieldByName('Title', 'article');
        $this->setFieldByName('Body', 'article');
        $this->setFieldByName('Signature', 'article');
        $this->click('Ok');
        //$this->assertText('Please type the right Captcha');
    }

    function testTagPage(){
        $this->get(BASEADDRESSHTTP);
        $this->click('bike');
        $this->assertText('bike');
        $this->assertText('My first Article');
        $this->assertText('My final Article');
    }
    
}

?>
