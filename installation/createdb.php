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

// Create all the tables

include ('../config.php');

$connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
mysql_select_db(DB_NAME, $connection);

if ($connection) {
    $cmd = "CREATE TABLE ".$table_prefix."articles (
       id int(11) NOT NULL auto_increment,
       title varchar(255),
       subtitle text,
       summary text,
       body text,
       tag text,
       metadescription text,
       metakeyword text,
       PRIMARY KEY (id)
    );";

    $result = mysql_db_query($db,$cmd);

    if (!$result) {
        $out = "Table Articles created";
    } else {
        $out = "Table Articles NOT created";;
    }

    $cmd = "CREATE TABLE ".$table_prefix."comments (
       id int(11) NOT NULL auto_increment,
       title varchar(255),
       body text,
       signature text,
       PRIMARY KEY (id)
    );";

    $result = mysql_db_query($db,$cmd);

    if (!$result) {
        $out .= "Table Comments created";
    } else {
        $out .= "Table Comments NOT created";;
    }

    $cmd = "CREATE TABLE ".$table_prefix."numbers (
       id int(11) NOT NULL auto_increment,
       title varchar(255),
       subtitle text,
       summary text,
       PRIMARY KEY (id)
    );";

    $result = mysql_db_query($db,$cmd);

    if (!$result) {
        $out .= "Table Numbers created";
    } else {
        $out .= "Table Numbers NOT created";;
    }

    $cmd = "CREATE TABLE ".$table_prefix."pages (
       id int(11) NOT NULL auto_increment,
       title varchar(255),
       subtitle text,
       summary text,
       body text,
       tag text,
       metadescription text,
       metakeyword text,
       PRIMARY KEY (id)
    );";

    $result = mysql_db_query($db,$cmd);

    if (!$result) {
        $out .= "Table Pages created";
    } else {
        $out .= "Table Pages NOT created";;
    }

    $cmd = "CREATE TABLE ".$table_prefix."users (
       id int(11) NOT NULL auto_increment,
       name varchar(255),
       username varchar(255),
       password varchar(255),
       role varchar(255),
       email varchar(255),
       msn varchar(255),
       skype varchar(255),
       PRIMARY KEY (id)
    );";

    $result = mysql_db_query($db,$cmd);

    if (!$result) {
        $out .= "Table Users created";
    } else {
        $out .= "Table Users NOT created";;
    }

// Populate the tables with some dummy data

    $cmd = "insert into ".$table_prefix."numbers (title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated)
            values ('My first number', 'Subtitle to my first number',
            'Summary of my first number', 'Description of my first number', 'first, number', 
            'first number', 'first, number meta keyword', now(), now())";

    $result = mysql_db_query($db,$cmd);

    if (!$result) {
        $out .= "Dummy data Number Created";
    } else {
        $out .= "Dummy data Number NOT created";;
    }

    $cmd = "insert into ".$table_prefix."articles (title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values
           ('My firts Article', 'Subtitle of my first article', 'summary of my first article', 
            'Body of my first article', 'tag of my first article',
            'metadescription of my first article', 'metakeyword of my first article', now(), now())";

    $result = mysql_db_query($db,$cmd);

    if (!$result) {
        $out .= "Dummy data Article Created";
    } else {
        $out .= "Dummy data Article NOT created";;
    }

    $cmd = "insert into ".$table_prefix."comments (title, body, signature, created, updated) values
           ('My first comment', 'text of my first comment', 'signature of my first comment', now(), now())";

    $result = mysql_db_query($db,$cmd);

    if (!$result) {
        $out .= "Dummy data Comment Created";
    } else {
        $out .= "Dummy data Comment NOT created";;
    }

    $cmd = "insert into ".$table_prefix."pages (title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values 
           ('My firts Page', 'Subtitle of my first page', 'summary of my first page',
            'Body of my first page', 'tag of my first page',
            'metadescription of my first page', 'metakeyword of my first page', now(), now())";

    $result = mysql_db_query($db,$cmd);

    if (!$result) {
        $out .= "Dummy data Page Created";
    } else {
        $out .= "Dummy data Page NOT created";;
    }

    $cmd = "insert into ".$table_prefix."users (name, username, password, role, email, msn, skype, created, updated) values
           ('New User', 'newuser', 'psw', 'role', 'email@email.com', 'abcdef@abcdef.com', 'abcdef', now(), now())";

    $result = mysql_db_query($db,$cmd);

    if (!$result) {
        $out .= "Dummy data User Created";
    } else {
        $out .= "Dummy data User NOT created";;
    }

    mysql_close($dbh);
} else {
    $out = "Errore nella connessione<BR>".mysql_errno().": ".mysql_error();
}








?>
