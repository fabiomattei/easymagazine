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
	<title>Login Page</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style type="text/css">
		#login .theInput {
			font-family: Verdana;
			font-size: 11px;
			width: 110px;
			margin-right: 5px;
		}

		#login .theSubmit {
			font-family: Verdana;
			font-size: 10px;
			background-color: #333333;
			color: #FFFFFF;
			margin-right: 5px;
		}
	</style>
</head>
<body>
    <form action="openSession.php" method="post" id="login">
        Username: <input type="text" class="theInput" name="username" value="" /> <br />
        Password: <input type="password" class="theInput" name="password" value="" /> <br />
        <input type="submit" value="Ok" />
    </form>
</body>
</html>