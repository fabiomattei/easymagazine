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


// ** MySQL settings ** //
define('DB_NAME', 'easymagazine');    // The name of the database
define('DB_USER', 'root');     // Your MySQL username
define('DB_PASSWORD', 'root'); // ...and password
define('DB_HOST', 'localhost:8889');    // 99% chance you won't need to change this value
//  define('DB_CHARSET', 'utf8');

// You can have multiple installations in one database if you give each a unique prefix
define('TBPREFIX', 'em_');

define('FOLDER', '/easymagazine/');

// Change this to localize Easy Magazine.
// A corresponding file for the
// chosen language must be installed to contents/languages.
define ('EMLANG', 'IT');

?>
