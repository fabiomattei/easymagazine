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

require_once(STARTPATH.DBPATH.'db.php');
require_once(STARTPATH.DATAMODELPATH.'article.php');
require_once(STARTPATH.UTILSPATH.'pagination.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');
require_once(STARTPATH.'lib/textile2/classTextile.php');

class Category {
    const NEW_CATEGORY = -1;
    private $id = self::NEW_CATEGORY;
    private $indexnumber;
    private $name;
    private $description;
    private $published;
    private $created;
    private $updated;

    const INSERT_SQL = 'insert into categories (id, indexnumber, published, name, description, created, updated) values (#, #, #, ?, ?, Now(), Now())';
    const UPDATE_SQL = 'update categories set indexnumber = #, published = #, name = ?, description = ?, updated = Now() where id = #';
    const DELETE_SQL = 'delete from categories where id = #';
    const SELECT_BY_ID = 'select * from categories where id = #';
    const SELECT_ALL_PUB = 'select * from categories where published = 1 order by indexnumber DESC';
    const SELECT_ALL = 'select * from categories order by id DESC';
    const SELECT_ALL_ORD_INDEXNUMBER = 'select * from categories order by indexnumber DESC';
    const SELECT_ALL_PUB_ORD_INDEXNUMBER = 'select * from categories where published = 1 order by indexnumber DESC ';
    const SELECT_ALL_NOTPUB_ORD_INDEXNUMBER = 'select * from categories where published = 0 order by indexnumber DESC';
    const SELECT_ARTICLES = 'select * from articles where category_id = # order by indexnumber DESC';
    const SELECT_ARTICLES_PUBLISHED = 'select * from articles where category_id = # AND published = 1 order by indexnumber DESC';
    const SELECT_BY_INDEXNUMBER = 'select * from categories order by indexnumber DESC ';
    const SELECT_MAX_INDEXNUMBER = 'select max(indexnumber) from categories ';
    const SELECT_BY_ID_ORD = 'select id from categories order by id DESC';
    const SELECT_UP_INDEXNUMBER = 'select * from categories WHERE indexnumber > # order by indexnumber ';
    const SELECT_DOWN_INDEXNUMBER = 'select * from categories WHERE indexnumber < # order by indexnumber DESC ';

    public function __construct($id=self::NEW_CATEGORY, $indexnumber='', $published='', $name='', $description='', $created='', $updated='') {
        $this->id = $id;
        $this->indexnumber = $indexnumber;
        $this->published = $published;
        $this->name = $name;
        $this->description = $description;
        $this->created = $created;
        $this->updated = $updated;
    }

    public function getId() {
        return $this->id;
    }

    public static function findOne($SQL, $array_str, $array_int) {
        $tables = array("categories" => TBPREFIX."categories");
        try {
            $rs = DB::getInstance()->execute(
                $SQL,
                $array_str,
                $array_int,
                $tables);
            if ($row = mysql_fetch_array($rs)) {
                $ret = new Category($row['id'], $row['indexnumber'], $row['published'], $row['name'], $row['description'], $row['created'], $row['updated']);
            } else {
                $ret = new Category();
            }
        } catch (Exception $e)  {
            $ret = new Category();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public static function findMany($SQL, $array_str, $array_int) {
        $ret = array();
        $tables = array("categories" => TBPREFIX."categories");
        try {
            $rs = DB::getInstance()->execute(
                $SQL,
                $array_str,
                $array_int,
                $tables);
            while ($row = mysql_fetch_array($rs)) {
                $ret[] = new Category($row['id'], $row['indexnumber'], $row['published'], $row['name'], $row['description'], $row['created'], $row['updated']);
            }
        } catch (Exception $e) {
            $ret[] = new Category();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public static function getPageNumbers() {
        return Pagination::calculatePageNumbers(DB::getInstance()->getCountLastQueryResults());
    }

    public static function findById($id) {
        $ret = Category::findOne(self::SELECT_BY_ID, array(), array($id));
        return $ret;
    }

    public static function findInAllTextFields($string) {
        $ret = Category::findMany(self::FIND_IN_ALL_TEXT_FIELDS, array("%$string%", "%$string%", "%$string%"), array());
        return $ret;
    }

    public static function findUpIndexNumber ($indexnumber) {
        $ret = Category::findOne(self::SELECT_UP_INDEXNUMBER, array(), array($indexnumber));
        return $ret;
    }

    public static function findDownIndexNumber ($indexnumber) {
        $ret = Category::findOne(self::SELECT_DOWN_INDEXNUMBER, array(), array($indexnumber));
        return $ret;
    }

    public static function findByTitle($title) {
        $ret = Category::findMany(self::SELECT_BY_TITLE, array("%$title%"), array());
        return $ret;
    }

    public static function findLast() {
        $ret = Category::findOne(self::SELECT_LAST, array(), array());
        return $ret;
    }

    public static function findLastPublished() {
        $ret = Category::findOne(self::SELECT_LAST_PUBLISHED, array(), array());
        return $ret;
    }

    public static function findAllPublished() {
        $ret = Category::findMany(self::SELECT_ALL_PUB, array(), array());
        return $ret;
    }

    public static function findAll() {
        $ret = Category::findMany(self::SELECT_ALL, array(), array());
        return $ret;
    }

    public static function findAllOrderedByIndexNumber() {
        $ret = Category::findMany(self::SELECT_ALL_ORD_INDEXNUMBER, array(), array());
        return $ret;
    }

    public static function findAllPublishedOrderedByIndexNumber() {
        $ret = Category::findMany(self::SELECT_ALL_PUB_ORD_INDEXNUMBER, array(), array());
        return $ret;
    }

    public static function findAllNotPublishedOrderedByIndexNumber() {
        $ret = Category::findMany(self::SELECT_ALL_NOTPUB_ORD_INDEXNUMBER, array(), array());
        return $ret;
    }

    public function articles() {
        $ret = array();
        $tables = array("articles" => TBPREFIX."articles");
        try {
            $rs = DB::getInstance()->execute(
                self::SELECT_ARTICLES,
                array(),
                array("$this->id"),
                $tables);
            while ($row = mysql_fetch_array($rs)) {
                $ret[] = new Article(
                    $row['id'],
                    $row['number_id'],
                    $row['category_id'],
                    $row['indexnumber'],
                    $row['published'],
                    $row['title'],
                    $row['subtitle'],
                    $row['summary'],
                    $row['body'],
                    $row['commentsallowed'],
                    $row['tag'],
                    $row['metadescription'],
                    $row['metakeyword'],
                    $row['imgfilename'],
                    $row['imgalt'],
                    $row['imgcaption'],
                    $row['created'],
                    $row['updated']);
            }
        } catch (Exception $e) {
            $ret[] = new Article();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public function articlesPublished() {
        $ret = array();
        $tables = array("articles" => TBPREFIX."articles");
        try {
            $rs = DB::getInstance()->execute(
                self::SELECT_ARTICLES_PUBLISHED,
                array(),
                array("$this->id"),
                $tables);
            while ($row = mysql_fetch_array($rs)) {
                $ret[] = new Article(
                    $row['id'],
                    $row['number_id'],
                    $row['category_id'],
                    $row['indexnumber'],
                    $row['published'],
                    $row['title'],
                    $row['subtitle'],
                    $row['summary'],
                    $row['body'],
                    $row['commentsallowed'],
                    $row['tag'],
                    $row['metadescription'],
                    $row['metakeyword'],
                    $row['imgfilename'],
                    $row['imgalt'],
                    $row['imgcaption'],
                    $row['created'],
                    $row['updated']);
            }
        } catch (Exception $e) {
            $ret[] = new Article();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public function save() {
        if ($this->id == self::NEW_CATEGORY) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    protected function insert() {
        $this->id = $this->getMaxId()+1;
        $this->indexnumber = $this->getMaxIndexNumber()+1;
        $tables = array("categories" => TBPREFIX."categories");
        try {
            DB::getInstance()->execute(
                self::INSERT_SQL,
                array($this->name, $this->description),
                array($this->id, $this->indexnumber, $this->published),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    protected function update() {
        $tables = array("categories" => TBPREFIX."categories");
        try {
            DB::getInstance()->execute(
                self::UPDATE_SQL,
                array($this->name, $this->description),
                array($this->indexnumber, $this->published, $this->id),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function delete() {
        $tables = array("categories" => TBPREFIX."categories");
        try {
            DB::getInstance()->execute(
                self::DELETE_SQL,
                array(),
                array($this->id),
                $tables);
            $this->id = self::NEW_CATEGORY;
            $this->indexnumber = '';
            $this->published = '';
            $this->name = '';
            $this->descripion = '';
            $this->created = '';
            $this->updated = '';
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getMaxIndexNumber() {
        try {
            $tables = array("categories" => TBPREFIX."categories");
            $rs = DB::getInstance()->execute(
                self::SELECT_MAX_INDEXNUMBER,
                array(),
                array(),
                $tables);
            if ($row = mysql_fetch_array($rs)) {
                $maxIndexNumber = $row[0];
            } else {
                $maxIndexNumber = 1;
            }
        } catch (Exception $e) {
            $maxIndexNumber = 1;
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $maxIndexNumber;
    }

    public function getMaxId() {
        try {
            $tables = array("categories" => TBPREFIX."categories");
            $rs = DB::getInstance()->execute(
                self::SELECT_BY_ID_ORD,
                array(),
                array(),
                $tables);
            $row = mysql_fetch_array($rs);
            $maxId = $row['id'];
        } catch (Exception $e) {
            $maxId = 0;
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $maxId;
    }

    public function getIndexnumber() {
        return $this->indexnumber;
    }

    public function setIndexnumber($indexnumber) {
        $this->indexnumber = $indexnumber;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription() {
        $textile = new Textile();
        $out = $textile->TextileThis($this->description);
        return $out;
    }

    public function getUnfilteredDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPublished() {
        return $this->published;
    }

    public function setPublished($published) {
        $this->published = $published;
    }

    public function getCreated() {
        return $this->created;
    }

    public function setCreated($created) {
        $this->created = $created;
    }

    public function getUpdated() {
        return $this->updated;
    }

    public function setUpdated($updated) {
        $this->updated = $updated;
    }

}

?>