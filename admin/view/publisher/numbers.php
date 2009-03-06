<?

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

define('STARTPATH', '../../../');

require_once(STARTPATH.'config.php');
require_once(STARTPATH.'costants.php');
require_once(STARTPATH.DATAMODELPATH.'number.php');

$numbs = Number::findAll();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Easy Magazine Admin</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "css/all.css";</style>
</head>
<body>
<div id="main">
	<div id="header">
		<a href="index.html" class="logo"><img src="img/logo.gif" width="101" height="29" alt="" /></a>
		<ul id="top-navigation">
			<li><span><span><a href="index.php">Dashboard</a></span></span></li>
			<li class="active"><span><span>Numbers</span></span></li>
			<li><span><span><a href="articles.php">Articles</a></span></span></li>
			<li><span><span><a href="pages.php">Pages</a></span></span></li>
			<li><span><span><a href="comments.php">Comments</a></span></span></li>
			<li><span><span><a href="plugin.php">Plugin</a></span></span></li>
			<li><span><span><a href="template.php">Template</a></span></span></li>
            <li><span><span><a href="users.php">Users</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<h3>Header</h3>
			<ul class="nav">
				<li><a href="#">Lorem Ipsum dollar</a></li>
				<li><a href="#">Dollar</a></li>
				<li><a href="#">Lorem dollar</a></li>
				<li><a href="#">Ipsum dollar</a></li>
				<li><a href="#">Lorem Ipsum dollar</a></li>
				<li class="last"><a href="#">Dollar Lorem Ipsum</a></li>
			</ul>
			<a href="#" class="link">Link here</a>
			<a href="#" class="link">Link here</a>
		</div>
		<div id="center-column">
			<div class="top-bar">
				<a href="#" class="button">ADD NEW </a>
				<h1>Contents</h1>
				<div class="breadcrumbs"><a href="#">Homepage</a> / <a href="#">Contents</a></div>
			</div><br />
		  <div class="select-bar">
		    <label>
		    <input type="text" name="textfield" />
		    </label>
		    <label>
			<input type="submit" name="Submit" value="Search" />
			</label>
		  </div>
			<div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="177">Header Here</th>
						<th>Header</th>
						<th>Head</th>
						<th>Header</th>
						<th>Header</th>
						<th>Head</th>
						<th>Header</th>
						<th class="last">Head</th>
					</tr>

                    <?
                    foreach ($numbs as $num) {
                    ?>
					<tr>
						<td class="first style1"><? echo $num->getTitle(); ?> </td>
						<td><img src="img/add-icon.gif" width="16" height="16" alt="" /></td>
						<td><img src="img/hr.gif" width="16" height="16" alt="" /></td>
						<td><img src="img/save-icon.gif" width="16" height="16" alt="" /></td>
						<td><img src="img/edit-icon.gif" width="16" height="16" alt="" /></td>
						<td><img src="img/login-icon.gif" width="16" height="16" alt="" /></td>
						<td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
						<td class="last"><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
					</tr>
                    <?
                    }
                    ?>
				</table>
				<div class="select">
					<strong>Other Pages: </strong>
					<select>
						<option>1</option>
					</select>
			  </div>
			</div>
		  <div class="table">
				<img src="img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">New Number of the magazine</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Lorem Ipsum</strong></td>
						<td class="last"><input type="text" class="text" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Lorem Ipsum</strong></td>
						<td class="last"><input type="text" class="text" /></td>
					</tr>
					<tr>
						<td class="first"><strong>Lorem Ipsum</strong></td>
						<td class="last"><input type="text" class="text" /></td>
					</tr>
					<tr class="bg">
						<td class="first"><strong>Lorem Ipsum</strong></td>
						<td class="last"><input type="text" class="text" /></td>
					</tr>
				</table>
	        <p>&nbsp;</p>
		  </div>
		</div>
		<div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box">Here there is a list of all numbers, published and not still published.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>


</body>
</html>
