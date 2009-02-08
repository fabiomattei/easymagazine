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

$cmd = "CREATE TABLE ".$table_prefix."numbers (
       id int(11) NOT NULL auto_increment,
       indexnumer int,
       title varchar(255),
       subtitle text,
       summary text,
       PRIMARY KEY (id)
    );";

$result = mysql_query($cmd, $connection);

if ($result) {
    $out = "Table Numbers created<BR>";
} else {
    $out = "Table Numbers NOT created<BR>";;
}

if ($connection) {
    $cmd = "CREATE TABLE ".$table_prefix."articles (
       id int(11) NOT NULL auto_increment,
       number_id int(11),
       indexnumer int,
       title varchar(255),
       subtitle text,
       summary text,
       body text,
       tag text,
       metadescription text,
       metakeyword text,
       created datetime,
       updated datetime,
       PRIMARY KEY (id)
    );";

    $result = mysql_query($cmd, $connection);

    if ($result) {
        $out .= "Table Articles created<BR>";
    } else {
        $out .= "Table Articles NOT created<BR>";;
    }

    $cmd = "CREATE TABLE ".$table_prefix."comments (
       id int(11) NOT NULL auto_increment,
       article_id int(11),
       title varchar(255),
       body text,
       signature text,
       created datetime,
       updated datetime, 
       PRIMARY KEY (id)
    );";

    $result = mysql_query($cmd, $connection);

    if ($result) {
        $out .= "Table Comments created<BR>";
    } else {
        $out .= "Table Comments NOT created<BR>";;
    }

    $cmd = "CREATE TABLE ".$table_prefix."pages (
       id int(11) NOT NULL auto_increment,
       title varchar(255),
       indexnumer int,
       subtitle text,
       summary text,
       body text,
       tag text,
       metadescription text,
       metakeyword text,
       PRIMARY KEY (id)
    );";

    $result = mysql_query($cmd, $connection);

    if ($result) {
        $out .= "Table Pages created<BR>";
    } else {
        $out .= "Table Pages NOT created<BR>";;
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

    $result = mysql_query($cmd, $connection);

    if ($result) {
        $out .= "Table Users created<BR>";
    } else {
        $out .= "Table Users NOT created<BR>";;
    }

    $cmd = "CREATE TABLE ".$table_prefix."users_articles (
       id int(11) NOT NULL auto_increment,
       article_id int(11),
       user_id int(11),
       PRIMARY KEY (id)
    );";

    $result = mysql_query($cmd, $connection);

    if ($result) {
        $out .= "Table Users created<BR>";
    } else {
        $out .= "Table Users NOT created<BR>";
    }

    // Populate the tables with some dummy data

    $cmd = "insert into ".$table_prefix."numbers (id, indexnumer, title, subtitle, summary)
            values (1, 1, 'My first number', 'Subtitle to my first number',
            'Summary of my first number')";

    $result = mysql_query($cmd, $connection);

    if ($result) {
        $out .= "Dummy data Number Created<BR>";
    } else {
        $out .= "Dummy data Number NOT created<BR>";;
    }

    $cmd = "insert into ".$table_prefix."articles (id, number_id, indexnumer, title, subtitle, summary, body, tag, metadescription, metakeyword, created, updated) values
           (1, 1, 1, 'My firts Article', 'Subtitle of my first article', 'summary of my first article',
            'Body of my first article', 'tag of my first article',
            'metadescription of my first article', 'metakeyword of my first article', now(), now())";

    $result = mysql_query($cmd, $connection);

    if ($result) {
        $out .= "Dummy data Article Created<BR>";
    } else {
        $out .= "Dummy data Article NOT created<BR>";;
    }

    $cmd = "insert into ".$table_prefix."comments (id, article_id, title, body, signature, created, updated) values
           (1, 1, 'My first comment', 'text of my first comment', 'signature of my first comment', now(), now())";

    $result = mysql_query($cmd, $connection);

    if ($result) {
        $out .= "Dummy data Comment Created<BR>";
    } else {
        $out .= "Dummy data Comment NOT created<BR>";;
    }

    $cmd = "insert into ".$table_prefix."pages (id, indexnumer, title, subtitle, summary, body, tag, metadescription, metakeyword) values
           (1, 1, 'My firts Page', 'Subtitle of my first page', 'summary of my first page',
            'Body of my first page', 'tag of my first page',
            'metadescription of my first page', 'metakeyword of my first page')";

    $result = mysql_query($cmd, $connection);

    if ($result) {
        $out .= "Dummy data Page Created<BR>";
    } else {
        $out .= "Dummy data Page NOT created<BR>";;
    }

    $cmd = "insert into ".$table_prefix."users (name, username, password, role, email, msn, skype) values
           ('New User', 'newuser', 'psw', 'role', 'email@email.com', 'abcdef@abcdef.com', 'abcdef')";

    $result = mysql_query($cmd, $connection);

    if ($result) {
        $out .= "Dummy data User Created<BR>";
    } else {
        $out .= "Dummy data User NOT created<BR>";;
    }

    $cmd = "insert into ".$table_prefix."users_articles (id, article_id, user_id) values
           (1, 1, 1)";

    $result = mysql_query($cmd, $connection);

    if ($result) {
        $out .= "Dummy data Relation User<->Article Created<BR>";
    } else {
        $out .= "Dummy data Relation User<->Article NOT created<BR>";;
    }

    mysql_close($connection);
} else {
    $out = "Errore nella connessione<BR>".mysql_errno().": ".mysql_error();
}

echo $out;

?>
