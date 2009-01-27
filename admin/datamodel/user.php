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

class User {
    const NEW_USER = -1;
    private $id = self::NEW_USER;
    private $name;
    private $username;
    private $password;
    private $role;
    private $email;
    private $msn;
    private $skype;
    private $db;

    const INSERT_SQL = 'insert into articles (name, username, password, role, email, msn, skype, created, updated) values (?, ?, ?, ?, ?, ?, ?, now(), now())';
    const UPDATE_SQL = 'update articles set name = ?, username = ?, sumary = ?, role = ?, email = ?, msn = ?, skype = ?, updated=now() where id = ?';
    const DELETE_SQL = 'delete from articles where id=?';
    const SELECT_BY_ID = 'select name, username, password, role, email, msn, skype, created, updated from articles where id = ?';
    const SELECT_BY_name = 'select name, username, password, role, email, msn, skype, created, updated from articles where name like ?';

    public function __construct() {
        $this->db = DB::getInstance();
    }

    public function __construct($id, $name, $username, $password, $role, $email, $msn, $skype) {
        $this->db = DB::getInstance();
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->email = $email;
        $this->msn = $msn;
        $this->skype = $skype;
    }

    public function getId() {
        return $this->id;
    }

    public static function findByname($name) {
        $rs = $this->db->execute(
            self::SELECT_BY_name,
            array("%$name%"));
        $ret = array();
        if ($rs) {
            foreach ($rs->getArray() as $row) {
                $ret[] = new Article($row['id'], $row['name'], $row['username'], $row['password'], $row['role'], $row['email'], $row['msn'], $row['skype']);
            }
        }
        return $ret;
    }

    protected function save() {
        if ($this->id == self::NEW_USER) {
            $this->insert();
        } else {
            $this->update();
        }
        $this->setTimeStamps();
    }

    public function delete() {
        $this->conn->execute(DELETE_SQL, array((int) $this->getId()));
        $this->id = self::NEW_USER;
        $this->name = '';
        $this->username = '';
        $this->password = '';
        $this->role = '';
        $this->email = '';
        $this->msn = '';
        $this->skype = '';
    }

    protected function insert() {
        $rs = $this->conn->execute(
            self::INSERT_SQL,
            array($this->name, $this->username, $this->password, $this->role, $this->email, $this->msn, $this->skype));
        if ($rs) {
            $this->id = (int) $this->conn->Insert_ID();
        } else {
            trigger_error('DB error: '.$this->db->getErrorMsg());
        }
    }

    protected function update() {
        $this->conn->execute(
            self::UPDATE_SQL,
            array($this->name, $this->username, $this->password, $this->role, $this->email, $this->msn, $this->skype));
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

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getMsn() {
        return $this->msn;
    }

    public function setMsn($msn) {
        $this->msn = $msn;
    }

    public function getSkype() {
        return $this->skype;
    }

    public function setSkype($skype) {
        $this->skype = $skype;
    }
        
}


?>
