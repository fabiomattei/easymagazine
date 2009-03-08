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
require_once(STARTPATH.DATAMODELPATH.'comment.php');
require_once(STARTPATH.FILTERPATH.'articlefilterremote.php');

class Article {
    const NEW_ARTICLE = -1;
    private $id = self::NEW_ARTICLE;
    private $title;
    private $subtitle;
    private $summary;
    private $body;
    private $tag;
    private $metadescription;
    private $metakeyword;
    private $db;
    private $filter;

    const INSERT_SQL = 'insert into articles (title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values (?, ?, ?, ?, ?, ?, ?, now(), now())';
    const UPDATE_SQL = 'update articles set title = ?, subtitle = ?, sumary = ?, body = ?, tag = ?, metadescription = ?, metakeyword = ?, updated=now() where id = ?';
    const DELETE_SQL = 'delete from articles where id=?';
    const SELECT_BY_ID = 'select * from articles where id = ?';
    const SELECT_BY_TITLE = 'select * from articles where title like ?';
    const SELECT_COMMENTS_PUB = 'select * from comments where published=1 AND article_id = ? order by created DESC';
    const SELECT_LAST = 'select * from articles where published=1 order by indexnumber DESC Limit 1';
    const SELECT_ALL_PUB = 'select * from articles where published=1 order by indexnumber DESC';
    const SELECT_ALL = 'select * from articles order by id DESC';
    const SELECT_ALL_ORD_INDEXNUMBER = 'select * from articles order by indexnumber DESC';
    const SELECT_BY_INDEXNUMBER = 'select indexnumber from articles order by indexnumber DESC';
    const SELECT_BY_ID_ORD = 'select id from articles order by id DESC';
    const SELECT_UP_INDEXNUMBER = 'select * from articles WHERE indexnumber > \'?\' order by indexnumber DESC';
    const SELECT_DOWN_INDEXNUMBER = 'select * from articles WHERE indexnumber < \'?\' order by indexnumber';

    public function __construct($id=self::NEW_ARTICLE, $number_id=self::NEW_ARTICLE, $indexnumber='', $published='', $title='', $subtitle='', $summary='', $body='', $tag='', $metadescription='', $metakeyword='') {
        $this->db = DB::getInstance();
        $this->filter = ArticleFilterRemote::getInstance();
        $this->id = $id;
        $this->number_id = $number_id;
        $this->indexnumber = $indexnumber;
        $this->published = $published;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->summary = $summary;
        $this->body = $body;
        $this->tag = $tag;
        $this->metadescription = $metadescription;
        $this->metakeyword = $metakeyword;
    }

    public function getId() {
        return $this->id;
    }

    public static function findOne($SQL, $array) {
        $tables = array("articles" => TBPREFIX."articles");
        $rs = DB::getInstance()->execute(
            $SQL,
            $array,
            $tables);
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret = new Article($row['id'], $row['number_id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary'], $row['body'], $row['tag'], $row['metadescription'], $row['metakeyword']);
            }
        }
        return $ret;
    }

    public static function findMany($SQL, $array) {
        $tables = array("articles" => TBPREFIX."articles");
        $rs = DB::getInstance()->execute(
            $SQL,
            $array,
            $tables);
        $ret = array();
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret[] = new Article($row['id'], $row['number_id'], $row['indexnumber'], $row['published'], $row['title'], $row['subtitle'], $row['summary'], $row['body'], $row['tag'], $row['metadescription'], $row['metakeyword']);
            }
        }
        return $ret;
    }
    
    public static function findById($id) {
        $ret = ARTICLE::findOne(self::SELECT_BY_TITLE, array("$id"));
        return $ret;
    }

    public static function findUpIndexNumber ($indexnumber) {
        $ret = ARTICLE::findOne(self::SELECT_UP_INDEXNUMBER, array("$indexnumber"));
        return $ret;
    }

    public static function findDownIndexNumber ($indexnumber) {
        $ret = ARTICLE::findOne(self::SELECT_DOWN_INDEXNUMBER, array("$indexnumber"));
        return $ret;
    }

    public static function findByTitle($title) {
        $ret = ARTICLE::findMany(self::SELECT_BY_TITLE, array("%$title%"));
        return $ret;
    }

    public static function findLast() {
        $ret = ARTICLE::findOne(self::SELECT_LAST, array(" "));
        return $ret;
    }

    public static function findAllPublished() {
        $ret = ARTICLE::findMany(self::SELECT_ALL_PUB, array());
        return $ret;
    }

    public static function findAll() {
        $ret = ARTICLE::findMany(self::SELECT_ALL, array());
        return $ret;
    }

    public static function findAllOrderedByIndexNumber() {
        $ret = ARTICLE::findMany(self::SELECT_ALL_ORD_INDEXNUMBER, array());
        return $ret;
    }

    public function comments() {
        $tables = array('comments' => TBPREFIX.'comments');
        $rs = DB::getInstance()->execute(
            self::SELECT_COMMENTS_PUB,
            array("$this->id"),
            $tables);
        $ret = array();
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret[] = new Comment(
                    $row['id'],
                    $row['article_id'],
                    $row['title'],
                    $row['published'],
                    $row['body'],
                    $row['signature'],
                    $row['created'],
                    $row['updated']);
            }
        }
        return $ret;
    }

    protected function save() {
        if ($this->id == self::NEW_ARTICLE) {
            $this->insert();
        } else {
            $this->update();
        }
        $this->setTimeStamps();
    }

    public function delete() {
        $this->conn->execute(DELETE_SQL, array((int) $this->getId()));
        $this->id = self::NEW_ARTICLE;
        $this->title = '';
        $this->subtitle = '';
        $this->summary = '';
        $this->body = '';
        $this->tag = '';
        $this->metadescription = '';
        $this->metakeyword = '';
    }

    protected function insert() {
        $rs = $this->conn->execute(
            self::INSERT_SQL,
            array($this->title, $this->subtitle, $this->summary, $this->body, $this->tag, $this->metadescription, $this->metakeyword));
        if ($rs) {
            $this->id = (int) $this->conn->Insert_ID();
        } else {
            trigger_error('DB error: '.$this->db->getErrorMsg());
        }
    }

    protected function update() {
        $this->conn->execute(
            self::UPDATE_SQL,
            array($this->title, $this->subtitle, $this->summary, $this->body, $this->tag, $this->metadescription, $this->metakeyword));
    }

    protected function setTimeStamps() {
        $rs = $this->conn->execute(
            self::SELECT_BY_ID,
            array($this->id));
        if ($rs) {
            $row = $rs->fetchRow();
            $this->created = $row['created'];
            $this->updated = $row['updated'];
        }
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
        
}

?>
