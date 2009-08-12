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

class Option {
    const NEW_OPTION = -1;
    private $id = self::NEW_OPTION;
    private $name;
    private $type;
    private $value;

    const INSERT_SQL = 'insert into options (id, name, type, value) values (#, ?, ?, ?)';
    const UPDATE_SQL = 'update options set name = ?, type = ?, value = ? where id = #';
    const DELETE_SQL = 'delete from options where id = #';
    const DELETE_TYPE_SQL = 'delete from options where type = ?';
    const SELECT_BY_ID = 'select * from options where id = #';
    const SELECT_BY_NAME = 'select * from options where name like ?';
    const SELECT_BY_NAME_AND_TYPE = 'select * from options where name like ? and type like ?';
    const SELECT_BY_TYPE = 'select * from options where type like ?';
    const SELECT_ALL = 'select * from options order by id DESC';
    const SELECT_BY_ID_ORD = 'select id from options order by id DESC';

    public function __construct($id=self::NEW_OPTION, $name='', $type='', $value='') {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    public function getId() {
        return $this->id;
    }

    public static function findOne($SQL, $array_str, $array_int) {
        $tables = array("options" => TBPREFIX."options");
        try {
            $rs = DB::getInstance()->execute(
                $SQL,
                $array_str,
                $array_int,
                $tables);
            if ($row = mysql_fetch_array($rs)) {
                $ret = new Option($row['id'], $row['name'], $row['type'], $row['value']);
            } else {
                $ret = new Option();
            }
        } catch (Exception $e)  {
            $ret = new Option();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $ret;
    }

    public static function findMany($SQL, $array_str, $array_int) {
        $tables = array("options" => TBPREFIX."options");
        $ret = array();
        try {
            $rs = DB::getInstance()->execute(
                $SQL,
                $array_str,
                $array_int,
                $tables);
            while ($row = mysql_fetch_array($rs)) {
                $ret[] = new Option($row['id'], $row['name'], $row['type'], $row['value']);
            }
        } catch (Exception $e)  {
            $ret[] = new Option();
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        return $ret;
    }

    public static function findById($id) {
        $ret = OPTION::findOne(self::SELECT_BY_ID, array(), array($id));
        return $ret;
    }

    public static function findAll() {
        $ret = OPTION::findMany(self::SELECT_ALL, array(), array());
        return $ret;
    }

    public static function findByName($name) {
        $ret = OPTION::findMany(self::SELECT_BY_NAME, array("%$name%"), array());
        return $ret;
    }

    public static function findByNameAndType($name, $type) {
        $ret = OPTION::findMany(self::SELECT_BY_NAME_AND_TYPE, array("%$name%", "%$type%"), array());
        return $ret;
    }

    public static function findByType($type) {
        $ret = OPTION::findMany(self::SELECT_BY_TYPE, array("%$type%"), array());
        return $ret;
    }

    public static function cleanType($type) {
        $tables = array("options" => TBPREFIX."options");
        try {
            DB::getInstance()->execute(
                self::DELETE_TYPE_SQL,
                array($type),
                array(),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function save() {
        if ($this->id == self::NEW_OPTION) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    public function delete() {
        $tables = array("options" => TBPREFIX."options");
        try {
            DB::getInstance()->execute(
                self::DELETE_SQL,
                array(),
                array((int) $this->getId()),
                $tables);
            $this->id = self::NEW_OPTION;
            $this->name = '';
            $this->type = '';
            $this->value = '';
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    protected function insert() {
        $this->id = $this->getMaxId()+1;
        $tables = array("options" => TBPREFIX."options");
        try {
            DB::getInstance()->execute(
                self::INSERT_SQL,
                array($this->name, $this->type, $this->value),
                array($this->id),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    protected function update() {
        $tables = array("options" => TBPREFIX."options");
        try {
            DB::getInstance()->execute(
                self::UPDATE_SQL,
                array($this->name, $this->type, $this->value),
                array($this->id),
                $tables);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getMaxId() {
        $tables = array("options" => TBPREFIX."options");
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

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }

}

?>