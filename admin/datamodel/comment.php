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

require_once(STARTPATH.FILTERPATH.'commentfilterremote.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');
require_once(STARTPATH.DATAMODELPATH.'article.php');
require_once(STARTPATH.UTILSPATH.'data.php');
require_once(STARTPATH.DBPATH.'db.php');

class Comment {
    const NEW_COMMENT = -1;
    private $id = self::NEW_COMMENT;
    private $article_id;
    private $title;
    private $published;
    private $body;
    private $signature;
    private $created;
    private $updated;
    private $db;
    private $filter;

    const INSERT_SQL = 'insert into comments (id, article_id, published, title, body, signature, created, updated) values (#, #, #, ?, ?, ?, now(), now())';
    const UPDATE_SQL = 'update comments set article_id = #, published = #, title = ?, body = ?, signature = ?, updated=now() where id = #';
    const DELETE_SQL = 'delete from comments where id = #';
    const SELECT_BY_ID = 'select * from comments where id = #';
    const SELECT_LAST_N = 'select * from comments ORDER BY updated DESC LIMIT # ';
    const SELECT_BY_TITLE = 'select * from comments where title like ?';
    const FIND_IN_ALL_TEXT_FIELDS = 'select * from comments where title like ? OR body like ? OR signature like ? ';
    const SELECT_BY_ID_ORD = 'select id from comments order by id DESC';
    const SELECT_ALL = 'select * from comments order by id DESC';
    const SELECT_ARTICLE = 'select * from articles where id = # ';

    public function __construct($id=self::NEW_COMMENT, $article_id=self::NEW_COMMENT, $title='', $published='', $body='', $signature='', $created='', $updated='') {
        $this->db = DB::getInstance();
        $this->filter = CommentFilterRemote::getInstance();
        $this->id = $id;
        $this->article_id = $article_id;
        $this->title = $title;
        $this->published = $published;
        $this->body = $body;
        $this->signature = $signature;
        $this->created = $created;
        $this->updated = $updated;
    }

    public function getId() {
        return $this->id;
    }

    public static function findOne($SQL, $array_str, $array_int) {
        try {
            $tables = array("comments" => TBPREFIX."comments");
            $rs = DB::getInstance()->execute(
                $SQL,
                $array_str,
                $array_int,
                $tables);
            if ($row = mysql_fetch_array($rs)) {
                $ret = new Comment($row['id'], $row['article_id'], $row['title'], $row['published'], $row['body'], $row['signature'], $row['created'], $row['updated']);
            } else {
                $ret = new Comment();
            }
        } catch (Exception $e) {
            $ret = new Comment();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public static function findMany($SQL, $array_str, $array_int) {
        $ret = array();
        $tables = array("comments" => TBPREFIX."comments");
        try {
            $rs = DB::getInstance()->execute(
                $SQL,
                $array_str,
                $array_int,
                $tables);
            while ($row = mysql_fetch_array($rs)) {
                $ret[] = new Comment($row['id'], $row['article_id'], $row['title'], $row['published'], $row['body'], $row['signature'], $row['created'], $row['updated']);
            }
        } catch (Exception $e) {
            $ret[] = new Comment();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public static function findById($id) {
        $ret = COMMENT::findOne(self::SELECT_BY_ID, array(), array($id));
        return $ret;
    }

    public static function findAll() {
        $ret = COMMENT::findMany(self::SELECT_ALL, array(), array());
        return $ret;
    }

    public static function findLastN($n) {
        $ret = COMMENT::findMany(self::SELECT_LAST_N, array(), array($n));
        return $ret;
    }

    public static function findByTitle($title) {
        $ret = COMMENT::findMany(self::SELECT_BY_TITLE, array("%$title%"), array());
        return $ret;
    }

    public static function findInAllTextFields($string) {
        $ret = COMMENT::findMany(self::FIND_IN_ALL_TEXT_FIELDS, array("%$string%", "%$string%", "%$string%"), array());
        return $ret;
    }

    public function article() {
        $tables = array("articles" => TBPREFIX."articles");
        try {
            $rs = DB::getInstance()->execute(
                self::SELECT_ARTICLE,
                array(),
                array($this->article_id),
                $tables);
            while ($row = mysql_fetch_array($rs)) {
                $ret = new Article(
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
                    $row['imgfilename'],
                    $row['imgdescription'],
                    $row['created'],
                    $row['updated']);
            }
        } catch (Exception $e) {
            $ret = new Article();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public function save() {
        if ($this->id == self::NEW_COMMENT) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function delete() {
        $tables = array("comments" => TBPREFIX."comments");
        try {
            DB::getInstance()->execute(
                self::DELETE_SQL,
                array(),
                array((int) $this->getId()),
                $tables);
            $this->id = self::NEW_COMMENT;
            $this->article_id = self::NEW_COMMENT;
            $this->title = '';
            $this->published = '';
            $this->body = '';
            $this->signature = '';
            $this->created = '';
            $this->updated = '';
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    protected function insert() {
        $this->id = $this->getMaxId()+1;
        $tables = array("comments" => TBPREFIX."comments");
        try {
            DB::getInstance()->execute(
                self::INSERT_SQL,
                array($this->title, $this->body, $this->signature),
                array($this->id, $this->article_id, $this->published),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    protected function update() {
        $tables = array("comments" => TBPREFIX."comments");
        try {
            DB::getInstance()->execute(
                self::UPDATE_SQL,
                array($this->title, $this->body, $this->signature),
                array($this->article_id, $this->published, $this->id),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getMaxId() {
        $tables = array("comments" => TBPREFIX."comments");
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

    public static function getPageNumbers() {
        return Pagination::calculatePageNumbers(DB::getInstance()->getCountLastQueryResults());
    }

    public function getArticle_id() {
        return $this->article_id;
    }

    public function setArticle_id($article_id) {
        $this->article_id = $article_id;
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

    public function getPublished() {
        return $this->published;
    }

    public function setPublished($published) {
        $this->published = $published;
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

    public function getSignature() {
        $out = $this->filter->executeFiltersSignature($this->signature);
        return $out;
    }

    public function getUnfilteredSignature() {
        return $this->signature;
    }

    public function setSignature($signature) {
        $this->signature = $signature;
    }

    public function getCreated() {
        return $this->created;
    }

    public function getCreatedFormatted() {
        return Data::DataFormat($this->created);
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
