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

require_once(STARTPATH.UTILSPATH.'password.php');
require_once(STARTPATH.UTILSPATH.'imagefiles.php');
require_once(STARTPATH.'lib/textile2/classTextile.php');

class User {
    const NEW_USER = -1;
    private $id = self::NEW_USER;
    private $name;
    private $username;
    private $password;
    private $body;
    private $role;
    private $email;
    private $msn;
    private $skype;
    private $created;
    private $updated;
    private $imgfilename;
    private $imgdescription;
    private $db;

    const INSERT_SQL = 'insert into users (id, name, username, password, body, role, email, msn, skype, created, updated) values (#, ?, ?, ?, ?, ?, ?, ?, ?, now(), now())';
    const UPDATE_SQL = 'update users set name = ?, body = ?, role = ?, email = ?, msn = ?, skype = ?, imgdescription = ?, updated=now() where id = #';
    const UPDATE_SQL_IMG = 'update users set imgfilename = ?, updated = Now() where id = #';
    const UPDATE_SQL_IMG_IMGDESC = 'update users set imgfilename = ?, imgdescription = ?, updated = Now() where id = #';
    const UPDATE_SQL_PASSWORD = 'update users set password = ?, updated=now() where id = #';
    const DELETE_SQL = 'delete from users where id = #';
    const SELECT_BY_ID = 'select * from users where id = #';
    const SELECT_BY_NAME = 'select * from users where name like ?';
    const SELECT_BY_USERNAME_AND_EMAIL = 'select * from users where username = ? AND email = ? ';
    const SELECT_ALL = 'select * from users ';
    const SELECT_USR_PSW = 'select * from users WHERE username like ? AND password like ? ';
    const SELECT_BY_ID_ORD = 'select id from users order by id DESC';
    const SELECT_ARTICLES = 'select AR.* from articles as AR, users_articles as UA where AR.id = UA.article_id AND UA.user_id = # order by AR.id DESC';
    const SELECT_COMMENTSARTICLES = 'select CM.* from comments as CM, articles as AR, users_articles as UA where AR.id = CM.article_id AND AR.id = UA.article_id AND UA.user_id = # order by AR.id DESC';

    public function __construct($id=self::NEW_USER, $name='', $username='', $password='', $body='', $role='', $email='', $msn='', $skype='', $imgfilename='', $imgdescription='', $created='', $updated='') {
        $this->db = DB::getInstance();
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->body = $body;
        $this->role = $role;
        $this->email = $email;
        $this->msn = $msn;
        $this->skype = $skype;
        $this->imgfilename = $imgfilename;
        $this->imgdescription = $imgdescription;
        $this->created = $created;
        $this->updated = $updated;
    }

    public static function findOne($SQL, $array_str, $array_int) {
        $tables = array("users" => TBPREFIX."users");
        try {
            $rs = DB::getInstance()->execute(
                $SQL,
                $array_str,
                $array_int,
                $tables);
            if ($row = mysql_fetch_array($rs)) {
                $ret = new User($row['id'], $row['name'], $row['username'], $row['password'], $row['body'], $row['role'], $row['email'], $row['msn'], $row['skype'], $row['imgfilename'], $row['imgdescription'], $row['created'], $row['updated']);
            } else {
                $ret = new User();
            }
        } catch (Exception $e) {
            $ret = new User();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public static function findMany($SQL, $array_str, $array_int) {
        $tables = array("users" => TBPREFIX."users");
        $ret = array();
        try {
            $rs = DB::getInstance()->execute(
                $SQL,
                $array_str,
                $array_int,
                $tables);
            while ($row = mysql_fetch_array($rs)) {
                $ret[] = new User($row['id'], $row['name'], $row['username'], $row['password'], $row['body'], $row['role'], $row['email'], $row['msn'], $row['skype'], $row['imgfilename'], $row['imgdescription'], $row['created'], $row['updated']);
            }
        } catch (Exception $e) {
            $ret[] = new User();
            echo 'Caught exception: ', $e->getMessage(), "\n";
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

    public static function findByUsernameAndEmail($username, $email) {
        $ret = USER::findOne(self::SELECT_BY_USERNAME_AND_EMAIL, array("$username", "$email"), array());
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
        $ret = array();
        $tables = array('articles' => TBPREFIX.'articles',
            'users_articles' => TBPREFIX.'users_articles');
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
                    $row['imgdescription'],
                    $row['created'],
                    $row['updated']);
            }
        } catch (Exception $e) {
            $ret[] = new Article();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public function articlescomments() {
        $ret = array();
        $tables = array('comments' => TBPREFIX.'comments',
            'articles' => TBPREFIX.'articles',
            'users_articles' => TBPREFIX.'users_articles');
        try {
            $rs = DB::getInstance()->execute(
                self::SELECT_COMMENTSARTICLES,
                array(),
                array("$this->id"),
                $tables);
            while ($row = mysql_fetch_array($rs)) {
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
        } catch (Exception $e) {
            $ret[] = new Comment();
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $ret;
    }

    public function getMaxId() {
        $tables = array("users" => TBPREFIX."users");
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

    public function save() {
        if ($this->id == self::NEW_USER) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function delete() {
        $tables = array("users" => TBPREFIX."users");
        try {
            DB::getInstance()->execute(
                self::DELETE_SQL,
                array(),
                array($this->id),
                $tables);
            $this->id = self::NEW_USER;
            $this->name = '';
            $this->username = '';
            $this->password = '';
            $this->body = '';
            $this->role = '';
            $this->email = '';
            $this->msn = '';
            $this->skype = '';
            $this->imgfilename = '';
            $this->imgdescription = '';
            $this->created = '';
            $this->updated = '';
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    protected function insert() {
        $this->id = $this->getMaxId()+1;
        $tables = array("users" => TBPREFIX."users");
        $psw = md5($this->password);
        try {
            DB::getInstance()->execute(
                self::INSERT_SQL,
                array($this->name, $this->username, $psw, $this->body, $this->role, $this->email, $this->msn, $this->skype),
                array($this->id),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    protected function update() {
        $tables = array("users" => TBPREFIX."users");
        try {
            DB::getInstance()->execute(
                self::UPDATE_SQL,
                array($this->name, $this->body, $this->role, $this->email, $this->msn, $this->skype, $this->imgdescription),
                array($this->id),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function updatePassword($NewPsw, $OldPsw) {
        if (md5($OldPsw)==$this->password) {
            $tables = array("users" => TBPREFIX."users");
            $this->password = md5($NewPsw);
            try {
                DB::getInstance()->execute(
                    self::UPDATE_SQL_PASSWORD,
                    array($this->password),
                    array($this->id),
                    $tables);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }

    public function setNewRandomPassword() {
        $newPassword = Password::generatePassword();
        $tables = array("users" => TBPREFIX."users");
        $this->password = md5($newPassword);
        try {
            DB::getInstance()->execute(
                self::UPDATE_SQL_PASSWORD,
                array($this->password),
                array($this->id),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $newPassword;
    }

    public function saveImg($img) {
        if (!$img['error']) {
            $this->imgfilename = $img['name'];
            $tables = array("users" => TBPREFIX."users");
            try {
                DB::getInstance()->execute(
                    self::UPDATE_SQL_IMG,
                    array($this->imgfilename),
                    array($this->id),
                    $tables);
                ImageFiles::savefile($this->created, $img);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }

    public function deleteImg() {
        ImageFiles::deletefile($this->created, $this->imgfilename);
        $this->imgfilename = '';
        $this->imgdescription = '';
        $tables = array("users" => TBPREFIX."users");
        try {
            DB::getInstance()->execute(
                self::UPDATE_SQL_IMG_IMGDESC,
                array($this->imgfilename, $this->imgdescription),
                array($this->id),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function imageExists() {
        if ($this->imgfilename == '') { return false; }
        else { return ImageFiles::fileexists($this->created, $this->imgfilename); }
    }

    public function imagePath() {
        return ImageFiles::filepath($this->created, $this->imgfilename);
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

    public function getBody() {
        $textile = new Textile();
        return $textile->TextileThis($this->body);
    }

    public function getUnfilteredBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
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

    public function getImgfilename() {
        return $this->imgfilename;
    }

    public function setImgfilename($imgfilename) {
        $this->imgfilename = $imgfilename;
    }

    public function getImgdescription() {
        return $this->imgdescription;
    }

    public function setImgdescription($imgdescription) {
        $this->imgdescription = $imgdescription;
    }

    public function getCreated() {
        return $this->created;
    }

    public function getUpdated() {
        return $this->updated;
    }

}

?>
