<?php

/*
	Copyright (C) 2009-2012  Fabio Mattei <burattino@gmail.com>

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
require_once(STARTPATH.FILTERPATH.'userfilterremote.php');


class User {
    const NEW_USER = -1;
    private $id = self::NEW_USER;
    private $name;
    private $username;
    private $password;
    private $body;
    private $role;
    private $toshow;
    private $email;
    private $msn;
    private $skype;
    private $created;
    private $updated;

    const INSERT_SQL = 'insert into users (id, name, username, password, body, role, toshow, email, msn, skype, created, updated) values (@#@, @?@, @?@, @?@, @?@, @?@, @#@, @?@, @?@, @?@, now(), now())';
    const UPDATE_SQL = 'update users set name = @?@, body = @?@, role = @?@, toshow = @#@, email = @?@, msn = @?@, skype = @?@, updated=now() where id = @#@';
    const UPDATE_SQL_PASSWORD = 'update users set password = @?@, updated=now() where id = @#@';
    const UPDATE_SQL_USERNAME = 'update users set username = @?@, updated=now() where id = @#@';
    const DELETE_SQL = 'delete from users where id = @#@';
    const SELECT_MAX_ID = 'select max(id) as maxid from users ';
    const SELECT_BY_ID = 'select * from users where id = @#@ ';
    const SELECT_BY_NAME = 'select * from users where name like @?@ order by name';
    const SELECT_BY_USERNAME = 'select * from users where username = @?@ LIMIT 1 ';
    const SELECT_BY_USERNAME_AND_EMAIL = 'select * from users where username = @?@ AND email = @?@ order by name ';
    const SELECT_ALL = 'select * from users order by name ';
    const SELECT_ALL_TO_SHOW = 'select * from users WHERE toshow = 1 order by name ';
    const SELECT_USR_PSW = 'select * from users WHERE username like @?@ AND password like @?@ ';
    const SELECT_BY_ID_ORD = 'select id from users order by id DESC';
    const SELECT_ARTICLES = 'select AR.* from articles as AR, users_articles as UA where AR.id = UA.article_id AND UA.user_id = @#@ order by AR.id DESC';
    const SELECT_COMMENTSARTICLES = 'select CM.* from comments as CM, articles as AR, users_articles as UA where AR.id = CM.article_id AND AR.id = UA.article_id AND UA.user_id = @#@ order by CM.id DESC';

    public function __construct($id=self::NEW_USER, $name='', $username='', $password='', $body='', $role='', $toshow='', $email='', $msn='', $skype='', $created='', $updated='') {
        $this->filter = UserFilterRemote::getInstance();
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->body = $body;
        $this->role = $role;
        $this->toshow = $toshow;
        $this->email = $email;
        $this->msn = $msn;
        $this->skype = $skype;
        $this->created = $created;
        $this->updated = $updated;
    }

    /**
     * Return a user from the query
     *
     * @return User
     */
    public static function findOne($SQL, $array_str, $array_int) {
        $tables = array("users" => TBPREFIX."users");
        try {
            $rs = DB::getInstance()->execute(
                    $SQL,
                    $array_str,
                    $array_int,
                    $tables);
            if ($row = mysql_fetch_array($rs)) {
                $ret = new User($row['id'], $row['name'], $row['username'], $row['password'], $row['body'], $row['role'], $row['toshow'], $row['email'], $row['msn'], $row['skype'], $row['created'], $row['updated']);
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
                $ret[] = new User($row['id'], $row['name'], $row['username'], $row['password'], $row['body'], $row['role'], $row['toshow'], $row['email'], $row['msn'], $row['skype'], $row['created'], $row['updated']);
            }
        } catch (Exception $e) {
            $ret[] = new User();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $ret;
    }

    /**
     * Return a user from the query searching by id
     *
     * @return User
     */
    public static function findById($id) {
        return USER::findOne(self::SELECT_BY_ID, array(), array($id));
    }

    /**
     * Return a user from the query searching by name
     *
     * @return User
     */
    public static function findByName($name) {
        return USER::findMany(self::SELECT_BY_NAME, array("%$name%"), array());
    }

    /**
     * Return a user from the query searching by username
     *
     * @return User
     */
    public static function findByUserName($username) {
        return USER::findOne(self::SELECT_BY_USERNAME, array("$username"), array());
    }

    /**
     * Return a user from the  searching by Username and Email
     *
     * @return User
     */
    public static function findByUsernameAndEmail($username, $email) {
        return USER::findOne(self::SELECT_BY_USERNAME_AND_EMAIL, array("$username", "$email"), array());
    }

    /**
     * Return all user in the database
     *
     * @return Array(User)
     */
    public static function findAll() {
        return USER::findMany(self::SELECT_ALL, array(), array());
    }

    public static function findAllToShow() {
        return USER::findMany(self::SELECT_ALL_TO_SHOW, array(), array());
    }

    public static function checkUsrPsw($usr, $psw) {
        return USER::findOne(self::SELECT_USR_PSW, array("$usr", md5($psw)), array());
    }

    public function articles() {
        $tables = array('articles' => TBPREFIX.'articles',
                'users_articles' => TBPREFIX.'users_articles');
        return ARTICLE::findManyAndSpecifyTables(self::SELECT_ARTICLES, array(), array($this->id), $tables);
    }

    public function articlescomments() {
        $tables = array('comments' => TBPREFIX.'comments',
                'articles' => TBPREFIX.'articles',
                'users_articles' => TBPREFIX.'users_articles');
        return COMMENT::findManyAndSpecifyTables(self::SELECT_COMMENTSARTICLES, array(), array($this->id), $tables);
    }

    public function getMaxId() {
        $tables = array("users" => TBPREFIX."users");
        try {
            $rs = DB::getInstance()->execute(
                    self::SELECT_MAX_ID,
                    array(),
                    array(),
                    $tables);
            $row = mysql_fetch_array($rs);
            $maxId = $row['maxid'];
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
            $this->toshow = '';
            $this->email = '';
            $this->msn = '';
            $this->skype = '';
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
                    array($this->id, $this->toshow),
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
                    array($this->name, $this->body, $this->role, $this->email, $this->msn, $this->skype),
                    array($this->toshow, $this->id),
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

    public function updateUsername($NewUserName) {
        $tables = array("users" => TBPREFIX."users");
        $this->username = $NewUserName;
        try {
            DB::getInstance()->execute(
                    self::UPDATE_SQL_USERNAME,
                    array($this->username),
                    array($this->id),
                    $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
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
        $out = $this->filter->executeFiltersBody($this->body);
        return $out;
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

    public function getToshow() {
        return $this->toshow;
    }

    public function setToshow($toshow) {
        $this->toshow = $toshow;
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