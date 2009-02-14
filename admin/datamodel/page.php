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

class Page {
    const NEW_PAGE = -1;
    private $id = self::NEW_PAGE;
    private $title;
    private $publisched;
    private $indexnumber;
    private $subtitle;
    private $summary;
    private $body;
    private $tag;
    private $metadescription;
    private $metakeyword;
    private $db;

    const INSERT_SQL = 'insert into pages (title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values (?, ?, ?, ?, ?, ?, ?, now(), now())';
    const UPDATE_SQL = 'update pages set title = ?, subtitle = ?, sumary = ?, body = ?, tag = ?, metadescription = ?, metakeyword = ?, updated=now() where id = ?';
    const DELETE_SQL = 'delete from pages where id=?';
    const SELECT_BY_ID = 'select * from pages where id = ?';
    const SELECT_BY_TITLE = 'select * from pages where title like ?';

    public function __construct($id=NEW_NUMBER, $title='', $publisched='', $indexnumber='', $subtitle='', $summary='', $body='', $tag='', $metadescription='', $metakeyword='') {
        $this->db = DB::getInstance();
        $this->id = $id;
        $this->title = $title;
        $this->publisched = $publisched;
        $this->indexnumber = $indexnumber;    
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

    public static function findById($id) {
        $tables = array('pages' => TBPREFIX.'pages');
        $rs = DB::getInstance()->execute(
            self::SELECT_BY_ID,
            array("$id"),
            $tables);
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret = new Page($row['id'], $row['title'], $row['publisched'], $row['indexnumber'], $row['subtitle'], $row['summary'], $row['body'], $row['tag'], $row['metadescription'], $row['metakeyword']);
            }
        }
        return $ret;
    }

    protected function save() {
        if ($this->id == self::NEW_PAGE) {
            $this->insert();
        } else {
            $this->update();
        }
        $this->setTimeStamps();
    }

    public function delete() {
        $this->conn->execute(DELETE_SQL, array((int) $this->getId()));
        $this->id = self::NEW_PAGE;
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
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getPublisched() {
        return $this->publisched;
    }

    public function setPublisched($publisched) {
        $this->publisched = $publisched;
    }

    public function getIndexnumber() {
        return $this->indexnumber;
    }

    public function setIndexnumber($indexnumber) {
        $this->indexnumber = $indexnumber;
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

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getTag() {
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
