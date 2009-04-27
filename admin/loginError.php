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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Login Error Page</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
    Username or password wrong!<br />
    <a href="login.php">Try again</a>. <br /><br />
    If you lost your password please type your username and email and we will send you a new password. <br />
    <form action="mailPassword.php" method="post">
        Username: <input type="text" name="username" value="" /> <br />
        Mail: <input type="text" name="password" value="" /> <br />
    </form>
</body>
</html>

