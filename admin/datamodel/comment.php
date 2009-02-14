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

    const INSERT_SQL = 'insert into comments (title, body, signature, created, updated) values (?, ?, ?, now(), now())';
    const UPDATE_SQL = 'update comments set title = ?, body = ?, signature = ?, updated=now() where id = ?';
    const DELETE_SQL = 'delete from comments where id = ?';
    const SELECT_BY_ID = 'select title, body, signature, created, updated from comments where id = ?';
    const SELECT_BY_TITLE = 'select title, body, signature, created, updated from comments where title like ?';

    public function __construct($id, $article_id, $title, $published, $body, $signature, $created, $updated) {
        $this->db = DB::getInstance();
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

    public static function findByTitle($title) {
        $rs = $this->db->execute(
            self::SELECT_BY_TITLE,
            array("%$title%"));
        $ret = array();
        if ($rs) {
            foreach ($rs->getArray() as $row) {
                $ret[] = new Article($row['id'], $row['title'], $row['body'], $row['signature']);
            }
        }
        return $ret;
    }

    protected function save() {
        if ($this->id == self::NEW_COMMENT) {
            $this->insert();
        } else {
            $this->update();
        }
        $this->setTimeStamps();
    }

    public function delete() {
        $this->conn->execute(DELETE_SQL, array((int) $this->getId()));
        $this->id = self::NEW_COMMENT;
        $this->title = '';
        $this->body = '';
        $this->signature = '';
    }

    protected function insert() {
        $rs = $this->conn->execute(
            self::INSERT_SQL,
            array($this->title, $this->body, $this->signature));
        if ($rs) {
            $this->id = (int) $this->conn->Insert_ID();
        } else {
            trigger_error('DB error: '.$this->db->getErrorMsg());
        }
    }

    protected function update() {
        $this->conn->execute(
            self::UPDATE_SQL,
            array($this->title, $this->body, $this->signature));
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

    public function getArticle_id() {
        return $this->article_id;
    }

    public function setArticle_id($article_id) {
        $this->article_id = $article_id;
    }

    public function getTitle() {
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

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getSignature() {
        return $this->signature;
    }

    public function setSignature($signature) {
        $this->signature = $signature;
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
