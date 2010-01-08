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
require_once(STARTPATH.FILTERPATH.'pagefilterremote.php');
require_once(STARTPATH.UTILSPATH.'imagefiles.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');

class Page {
    const NEW_PAGE = -1;
    private $id = self::NEW_PAGE;
    private $indexnumber;
    private $published;
    private $title;
    private $subtitle;
    private $summary;
    private $body;
    private $tag;
    private $metadescription;
    private $metakeyword;
    private $created;
    private $updated;
    private $db;

    const INSERT_SQL = 'insert into pages (id, indexnumber, published, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values (#, #, #, ?, ?, ?, ?, ?, ?, ?, now(), now())';
    const UPDATE_SQL = 'update pages set indexnumber = #, published = #, title = ?, subtitle = ?, summary = ?, body = ?, tag = ?, metadescription = ?, metakeyword = ?, updated=now() where id = #';
    const DELETE_SQL = 'delete from pages where id = # ';
    const SELECT_BY_ID = 'select * from pages where id = # ';
    const SELECT_ALL_PUB = 'select * from pages where published = 1 order by indexnumber DESC';
    const SELECT_ALL = 'select * from pages order by indexnumber';
    const SELECT_ALL_ORD_INDEXNUMBER = 'select * from pages order by indexnumber DESC ';
    const SELECT_MAX_INDEXNUMBER = 'select max(indexnumber) from pages ';
    const SELECT_ALL_PUB_ORD_INDEXNUMBER = 'select * from pages where published = 1 order by indexnumber DESC ';
    const SELECT_UP_INDEXNUMBER = 'select * from pages WHERE indexnumber > # order by indexnumber ';
    const SELECT_DOWN_INDEXNUMBER = 'select * from pages WHERE indexnumber < # order by indexnumber DESC ';
    const SELECT_BY_TITLE = 'select * from pages where title like ?';
    const FIND_IN_ALL_TEXT_FIELDS = 'select * from pages where title like ? OR subtitle like ? OR summary like ? OR body like ? ';
    const SELECT_BY_ID_ORD = 'select id from pages order by id DESC';
    const SELECT_BY_INDEXNUMBER = 'select indexnumber from pages order by indexnumber DESC';

    public function __construct($id=self::NEW_PAGE, $indexnumber='', $published='', $title='', $subtitle='', $summary='', $body='', $tag='', $metadescription='', $metakeyword='', $created='', $updated='') {
        $this->db = DB::getInstance();
        $this->filter = PageFilterRemote::getInstance();
        $this->id = $id;
        $this->indexnumber = $indexnumber;
        $this->published = $published;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->summary = $summary;
        $this->body = $body;
        $this->tag = $tag;
        $this->metadescription = $metadescription;
        $this->metakeyword = $metakeyword;
        $this->created = $created;
        $this->updated = $updated;
    }

    public function getId() {
        return $this->id;
    }

    public static function findOne($SQL, $array_str, $array_int) {
        $tables = array("pages" => TBPREFIX."pages");
        try {
            $rs = DB::getInstance()->execute(
                $SQL,
                $array_str,
                $array_int,
                $tables);
            if ($row = mysql_fetch_array($rs)) {
                $ret = new Page($row['id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary'], $row['body'], $row['tag'], $row['metadescription'], $row['metakeyword'], $row['created'], $row['updated'] );
            } else {
                $ret = new Page();
            }
        } catch (Exception $e) {
            $ret = new Page();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $ret;
    }

    public static function findMany($SQL, $array_str, $array_int) {
        $ret = array();
        $tables = array("pages" => TBPREFIX."pages");
        try {
            $rs = DB::getInstance()->execute(
                $SQL,
                $array_str,
                $array_int,
                $tables);
            while ($row = mysql_fetch_array($rs)) {
                $ret[] = new Page($row['id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary'], $row['body'], $row['tag'], $row['metadescription'], $row['metakeyword'], $row['created'], $row['updated']);
            }
        } catch (Exception $e) {
            $ret[] = new Page();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $ret;
    }

    public static function findById($id) {
        $ret = PAGE::findOne(self::SELECT_BY_ID, array(), array($id));
        return $ret;
    }

    public static function findAllPublished() {
        $ret = PAGE::findMany(self::SELECT_ALL_PUB, array(), array());
        return $ret;
    }

    public static function findAllPublishedOrdered() {
        $ret = PAGE::findMany(self::SELECT_ALL_PUB_ORD_INDEXNUMBER, array(), array());
        return $ret;
    }

    public static function findAll() {
        $ret = PAGE::findMany(self::SELECT_ALL, array(), array());
        return $ret;
    }

    public static function findAllOrdered() {
        $ret = PAGE::findMany(self::SELECT_ALL_ORD_INDEXNUMBER, array(), array());
        return $ret;
    }

    public static function findInAllTextFields($string) {
        $ret = PAGE::findMany(self::FIND_IN_ALL_TEXT_FIELDS, array("%$string%", "%$string%", "%$string%", "%$string%"), array());
        return $ret;
    }

    public static function findAllOrderedByIndexNumber() {
        $ret = PAGE::findMany(self::SELECT_ALL_ORD_INDEXNUMBER, array(), array());
        return $ret;
    }

    public function findUpIndexNumber () {
        $ret = PAGE::findOne(self::SELECT_UP_INDEXNUMBER, array(), array($this->indexnumber));
        return $ret;
    }

    public function findDownIndexNumber() {
        $ret = PAGE::findOne(self::SELECT_DOWN_INDEXNUMBER, array(), array($this->indexnumber));
        return $ret;
    }

    public function save() {
        if ($this->id == self::NEW_PAGE) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function delete() {
        $tables = array("pages" => TBPREFIX."pages");
        try {
            DB::getInstance()->execute(
                self::DELETE_SQL,
                array(),
                array($this->id),
                $tables);
            $this->id = self::NEW_PAGE;
            $this->title = '';
            $this->subtitle = '';
            $this->summary = '';
            $this->body = '';
            $this->tag = '';
            $this->metadescription = '';
            $this->metakeyword = '';
            $this->created = '';
            $this->updated = '';
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    protected function insert() {
        $this->id = $this->getMaxId()+1;
        $this->indexnumber = $this->getMaxIndexNumber()+1;
        $tables = array("pages" => TBPREFIX."pages");
        try {
            DB::getInstance()->execute(
                self::INSERT_SQL,
                array($this->title, $this->subtitle, $this->summary, $this->body, $this->tag, $this->metadescription, $this->metakeyword),
                array($this->id, $this->indexnumber, $this->published),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    protected function update() {
        $tables = array("pages" => TBPREFIX."pages");
        try {
            DB::getInstance()->execute(
                self::UPDATE_SQL,
                array($this->title, $this->subtitle, $this->summary, $this->body, $this->tag, $this->metadescription, $this->metakeyword),
                array($this->indexnumber, $this->published, $this->id),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function getMaxIndexNumber() {
        $tables = array("pages" => TBPREFIX."pages");
        try {
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
        $tables = array("pages" => TBPREFIX."pages");
        try {
            $rs = DB::getInstance()->execute(
                self::SELECT_BY_ID_ORD,
                array(),
                array(),
                $tables);
            $row = mysql_fetch_array($rs);
            $maxId = $row['id'];
        } catch (Exception $e) {
            $maxId = 0;
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        return $maxId;
    }

    public function getTitle() {
        $out = $this->filter->executeFiltersTitle($this->title);
        return $out;
    }

    public function getUnfilteredTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getpublished() {
        return $this->published;
    }

    public function setpublished($published) {
        $this->published = $published;
    }

    public function getIndexnumber() {
        return $this->indexnumber;
    }

    public function setIndexnumber($indexnumber) {
        $this->indexnumber = $indexnumber;
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

    public function getBody() {
        $out = $this->filter->executeFiltersBody($this->body);
        return $out;
    }

    public function getUnfilteredBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getTag() {
        $out = $this->filter->executeFiltersTag($this->tag);
        return $out;
    }

    public function getUnfilteredTag() {
        return $this->tag;
    }

    public function setTag($tag) {
        $this->tag = $tag;
    }

    public function getMetadescription() {
        return $this->metadescription;
    }

    public function setMetadescription($metadescription) {
        $this->metadescription = $metadescription;
    }

    public function getMetakeyword() {
        return $this->metakeyword;
    }

    public function setMetakeyword($metakeyword) {
        $this->metakeyword = $metakeyword;
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