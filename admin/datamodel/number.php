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

class Number {
    const NEW_NUMBER = -1;
    private $id = self::NEW_NUMBER;
    private $title;
    private $subtitle;
    private $summary;
    private $db;

    const INSERT_SQL = 'insert into numbers (title, subtitle, summary, created, updated) values (?, ?, ?, now(), now())';
    const UPDATE_SQL = 'update numbers set title = ?, subtitle = ?, summary = ?, updated=now() where id = ?';
    const DELETE_SQL = 'delete from numbers where id = ?';
    const SELECT_BY_ID = 'select title, subtitle, summary, created, updated from numbers where id = ?';
    const SELECT_BY_TITLE = 'select title, subtitle, summary, created, updated from numbers where title like ?';

    public function __construct() {
        $this->db = DB::getInstance();
    }

    public function __construct($id, $title, $subtitle, $summary) {
        $this->db = DB::getInstance();
        $this->id = $id;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->summary = $summary;
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
                $ret[] = new Article($row['id'], $row['title'], $row['subtitle'], $row['summary']);
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
        $this->subtitle = '';
        $this->summary = '';
    }

    protected function insert() {
        $rs = $this->conn->execute(
            self::INSERT_SQL,
            array($this->title, $this->subtitle, $this->summary));
        if ($rs) {
            $this->id = (int) $this->conn->Insert_ID();
        } else {
            trigger_error('DB error: '.$this->db->getErrorMsg());
        }
    }

    protected function update() {
        $this->conn->execute(
            self::UPDATE_SQL,
            array($this->title, $this->subtitle, $this->summary));
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
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getSubtitle() {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
    }

    public function getSummary() {
        return $this->summary;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
    }
        
}


?>
