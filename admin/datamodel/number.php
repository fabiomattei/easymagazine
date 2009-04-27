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
require_once(STARTPATH.FILTERPATH.'numberfilterremote.php');

class Number {
    const NEW_NUMBER = -1;
    private $id = self::NEW_NUMBER;
    private $indexnumber;
    private $published;
    private $title;
    private $subtitle;
    private $summary;
    private $commentsallowed;
    private $created;
    private $updated;
    private $db;
    private $filter;

    const INSERT_SQL = 'insert into numbers (id, indexnumber, published, title, subtitle, summary, commentsallowed, created, updated) values (#, #, #, ?, ?, ?, #, Now(), Now())';
    const UPDATE_SQL = 'update numbers set indexnumber = #, published = #, commentsallowed = #, title = ?, subtitle = ?, summary = ?, updated = Now() where id = #';
    const DELETE_SQL = 'delete from numbers where id = #';
    const SELECT_BY_ID = 'select * from numbers where id = #';
    const SELECT_BY_TITLE = 'select * from numbers where title like ?';
    const SELECT_LAST = 'select * from numbers where published = 1 order by indexnumber DESC Limit 1';
    const SELECT_ALL_PUB = 'select * from numbers where published = 1 order by indexnumber DESC';
    const SELECT_ALL = 'select * from numbers order by id DESC';
    const SELECT_ALL_ORD_INDEXNUMBER = 'select * from numbers order by indexnumber DESC';
    const SELECT_ARTICLES = 'select * from articles where number_id = # order by indexnumber DESC';
    const SELECT_ARTICLES_PUBLISHED = 'select * from articles where number_id = # AND published = 1 order by indexnumber DESC';
    const SELECT_BY_INDEXNUMBER = 'select indexnumber from numbers order by indexnumber DESC';
    const SELECT_BY_ID_ORD = 'select id from numbers order by id DESC';
    const SELECT_UP_INDEXNUMBER = 'select * from numbers WHERE indexnumber > # order by indexnumber DESC';
    const SELECT_DOWN_INDEXNUMBER = 'select * from numbers WHERE indexnumber < # order by indexnumber';

    public function __construct($id=self::NEW_NUMBER, $indexnumber='', $published='', $title='', $subtitle='', $summary='', $commentsallowed='', $created='', $updated='') {
        $this->db = DB::getInstance();
        $this->filter = NumberFilterRemote::getInstance();
        $this->id = $id;
        $this->indexnumber = $indexnumber;
        $this->published = $published;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->summary = $summary;
        $this->commentsallowed = $commentsallowed;
        $this->created = $created;
        $this->updated = $updated;
    }

    public function getId() {
        return $this->id;
    }

    public static function findOne($SQL, $array_str, $array_int) {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            $SQL,
            $array_str,
            $array_int,
            $tables);
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret = new Number($row['id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary'], $row['commentsallowed'], $row['created'], $row['updated']);
            }
        }
        return $ret;
    }

    public static function findMany($SQL, $array_str, $array_int) {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            $SQL,
            $array_str,
            $array_int,
            $tables);
        $ret = array();
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret[] = new Number($row['id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary'], $row['commentsallowed'], $row['created'], $row['updated']);
            }
        }
        return $ret;
    }

    public static function findById($id) {
        $ret = NUMBER::findOne(self::SELECT_BY_ID, array(), array($id));
        return $ret;
    }

    public static function findUpIndexNumber ($indexnumber) {
        $ret = NUMBER::findOne(self::SELECT_UP_INDEXNUMBER, array(), array($indexnumber));
        return $ret;
    }

    public static function findDownIndexNumber ($indexnumber) {
        $ret = NUMBER::findOne(self::SELECT_DOWN_INDEXNUMBER, array(), array($indexnumber));
        return $ret;
    }

    public static function findByTitle($title) {
        $ret = NUMBER::findMany(self::SELECT_BY_TITLE, array("%$title%"), array());
        return $ret;
    }

    public static function findLast() {
        $ret = NUMBER::findOne(self::SELECT_LAST, array(), array());
        return $ret;
    }

    public static function findAllPublished() {
        $ret = NUMBER::findMany(self::SELECT_ALL_PUB, array(), array());
        return $ret;
    }

    public static function findAll() {
        $ret = NUMBER::findMany(self::SELECT_ALL, array(), array());
        return $ret;
    }

    public static function findAllOrderedByIndexNumber() {
        $ret = NUMBER::findMany(self::SELECT_ALL_ORD_INDEXNUMBER, array(), array());
        return $ret;
    }

    public function articles() {
        $tables = array("articles" => TBPREFIX."articles");
        $rs = DB::getInstance()->execute(
            self::SELECT_ARTICLES,
            array(),
            array("$this->id"),
            $tables);
        $ret = array();
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret[] = new Article(
                    $row['id'],
                    $row['number_id'],
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
                    $row['created'],
                    $row['updated']);
            }
        }
        return $ret;
    }

    public function articlesPublished() {
        $tables = array("articles" => TBPREFIX."articles");
        $rs = DB::getInstance()->execute(
            self::SELECT_ARTICLES_PUBLISHED,
            array(),
            array("$this->id"),
            $tables);
        $ret = array();
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret[] = new Article(
                    $row['id'],
                    $row['number_id'],
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
                    $row['created'],
                    $row['updated']);
            }
        }
        return $ret;
    }

    public function save() {
        if ($this->id == self::NEW_NUMBER) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function delete() {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::DELETE_SQL,
            array(),
            array($this->id),
            $tables);
        $this->id = self::NEW_NUMBER;
        $this->indexnumber = '';
        $this->published = '';
        $this->title = '';
        $this->subtitle = '';
        $this->summary = '';
        $this->created = '';
        $this->updated = '';
    }

    protected function insert() {
        $this->id = $this->getMaxId()+1;
        $this->indexnumber = $this->getMaxIndexNumber()+1;
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::INSERT_SQL,
            array($this->title, $this->subtitle, $this->summary),
            array($this->id, $this->indexnumber, $this->published, $this->commentsallowed),
            $tables);
    }

    protected function update() {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::UPDATE_SQL,
            array($this->title, $this->subtitle, $this->summary),
            array($this->indexnumber, $this->published, $this->commentsallowed, $this->id),
            $tables);
    }

    public function getMaxIndexNumber() {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::SELECT_BY_INDEXNUMBER,
            array(),
            array(),
            $tables);
        if ($rs) {
            $row = mysql_fetch_array($rs);
            $maxIndexNumber = $row['indexnumber'];
        }
        return $maxIndexNumber;
    }

    public function getMaxId() {
        $tables = array("numbers" => TBPREFIX."numbers");
        $rs = DB::getInstance()->execute(
            self::SELECT_BY_ID_ORD,
            array(),
            array(),
            $tables);
        if ($rs) {
            $row = mysql_fetch_array($rs);
                $maxId = $row['id'];
        }
        return $maxId;
    }

    public function getIndexnumber() {
        return $this->indexnumber;
    }

    public function setIndexnumber($indexnumber) {
        $this->indexnumber = $indexnumber;
    }

    public function getTitle() {
        $out = $this->filter->executeFiltersTitle($this->title);
        return $out;
    }

    public function getUnfilteredTitle(){
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getSubtitle() {
        $out = $this->filter->executeFiltersSubTitle($this->subtitle);
        return $out;
    }

    public function getUnfilteredSubtitle() {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
    }

    public function getSummary() {
        $out = $this->filter->executeFiltersSummary($this->summary);
        return $out;
    }

    public function getUnfilteredSummary() {
        return $this->summary;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
    }

    public function getCommentsallowed() {
        return $this->commentsallowed;
    }

    public function setCommentsallowed($commentsallowed) {
        $this->commentsallowed = $commentsallowed;
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

    public function getUpdated() {
        return $this->updated;
    }

}

?>
