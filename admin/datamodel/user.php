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
    private $created;
    private $updated;
    private $db;

    const INSERT_SQL = 'insert into users (id, name, username, password, role, email, msn, skype, created, updated) values (#, ?, ?, ?, ?, ?, ?, ?, now(), now())';
    const UPDATE_SQL = 'update users set name = ?, username = ?, role = ?, email = ?, msn = ?, skype = ?, updated=now() where id = #';
    const UPDATE_SQL_PASSWORD = 'update users set password = ?, updated=now() where id = #';
    const DELETE_SQL = 'delete from users where id = #';
    const SELECT_BY_ID = 'select * from users where id = #';
    const SELECT_BY_NAME = 'select * from users where name like ?';
    const SELECT_ALL = 'select * from users ';
    const SELECT_USR_PSW = 'select * from users WHERE username like ? AND password like ?';
    const SELECT_BY_ID_ORD = 'select id from users order by id DESC';
    const SELECT_ARTICLES = 'select AR.* from articles as AR, users_articles as UA where AR.id = UA.article_id AND UA.user_id = # order by AR.id DESC';

    public function __construct($id=self::NEW_USER, $name='', $username='', $password='', $role='', $email='', $msn='', $skype='', $created='', $updated='') {
        $this->db = DB::getInstance();
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->email = $email;
        $this->msn = $msn;
        $this->skype = $skype;
        $this->created = $created;
        $this->updated = $updated;
    }

    public static function findOne($SQL, $array_str, $array_int) {
        $tables = array("users" => TBPREFIX."users");
        $rs = DB::getInstance()->execute(
            $SQL,
            $array_str,
            $array_int,
            $tables);
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret = new User($row['id'], $row['name'], $row['username'], $row['password'], $row['role'], $row['email'], $row['msn'], $row['skype'], $row['created'], $row['updated']);
            }
        }
        return $ret;
    }

    public static function findMany($SQL, $array_str, $array_int) {
        $tables = array("users" => TBPREFIX."users");
        $rs = DB::getInstance()->execute(
            $SQL,
            $array_str,
            $array_int,
            $tables);
        $ret = array();
        if ($rs) {
            while ($row = mysql_fetch_array($rs)){
                $ret[] = new User($row['id'], $row['name'], $row['username'], $row['password'], $row['role'], $row['email'], $row['msn'], $row['skype'], $row['created'], $row['updated']);
            }
        }
        return $ret;
    }

    public static function findById($id) {
        $ret = USER::findOne(self::SELECT_BY_ID, array(), array($id));
        return $ret;
    }

    public static function findByName($name) {
        $ret = USER::findMany(self::SELECT_BY_NAME, array("%$name%"), array());
        return $ret;
    }

    public static function findAll() {
        $ret = USER::findMany(self::SELECT_ALL, array(), array());
        return $ret;
    }

    public static function checkUsrPsw($usr, $psw) {
        $ret = USER::findOne(self::SELECT_USR_PSW, array("$usr", md5($psw)), array());
        return $ret;
    }

    public function articles() {
        $tables = array('articles' => TBPREFIX.'articles',
                        'users_articles' => TBPREFIX.'users_articles');
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
                    $row['tag'],
                    $row['metadescription'],
                    $row['metakeyword'],
                    $row['created'],
                    $row['updated']);
            }
        }
        return $ret;
    }

    public function getMaxId() {
        $tables = array("users" => TBPREFIX."users");
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

    public function save() {
        if ($this->id == self::NEW_USER) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function delete() {
        $tables = array("users" => TBPREFIX."users");
        $rs = DB::getInstance()->execute(
            self::DELETE_SQL,
            array(),
            array($this->id),
            $tables);
        $this->id = self::NEW_USER;
        $this->name = '';
        $this->username = '';
        $this->password = '';
        $this->role = '';
        $this->email = '';
        $this->msn = '';
        $this->skype = '';
        $this->created = '';
        $this->updated = '';
    }

    protected function insert() {
        $this->id = $this->getMaxId()+1;
        $tables = array("users" => TBPREFIX."users");
        $psw = md5($this->password);
        $rs = DB::getInstance()->execute(
            self::INSERT_SQL,
            array($this->name, $this->username, $psw, $this->role, $this->email, $this->msn, $this->skype),
            array($this->id),
            $tables);
    }

    protected function update() {
        $tables = array("users" => TBPREFIX."users");
        $rs = DB::getInstance()->execute(
            self::UPDATE_SQL,
            array($this->name, $this->username, $this->role, $this->email, $this->msn, $this->skype),
            array($this->id),
            $tables);
    }

    public function updatePassword($psw) {
        $tables = array("users" => TBPREFIX."users");
        $this->password = md5($psw);
        $rs = DB::getInstance()->execute(
            self::UPDATE_SQL_PASSWORD,
            array($this->password),
            array($this->id),
            $tables);
    }

    public function getId() {
        return $this->id;
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

    public function getCreated() {
        return $this->created;
    }

    public function getUpdated() {
        return $this->updated;
    }

}

?>
