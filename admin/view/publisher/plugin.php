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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Easy Magazine Admin: Articles</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<style media="all" type="text/css">@import "../../resources/css/all.css";</style>
</head>
<body>
<div id="main">
	<div id="header">
		<a href="index.html" class="logo"><img src="../../resources/img/logo.gif" width="101" height="29" alt="" /></a>
		<ul id="top-navigation">
			<li><span><span><a href="index.php">Dashboard</a></span></span></li>
			<li><span><span><a href="number.php">Numbers</a></span></span></li>
			<li><span><span><a href="article.php">Articles</a></span></span></li>
			<li><span><span><a href="page.php">Pages</a></span></span></li>
			<li><span><span><a href="comment.php">Comments</a></span></span></li>
			<li class="active"><span><span>Plugin</span></span></li>
			<li><span><span><a href="template.php">Template</a></span></span></li>
                        <li><span><span><a href="user.php">Users</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<h3>Hello, <? echo $_SESSION['user']->getName() ?></h3>
			<ul class="nav">
				<li><a href="#">List all comments</a></li>
				<li><a href="#">List all Authors</a></li>
				<li class="last"><a href="#">Filter all link</a></li>
			</ul>
			<a href="#" class="link">View in the website</a>
		</div>
		<div id="center-column">
		  <div class="select-bar">
		    <label>
		    <input type="text" name="textfield" />
		    </label>
		    <label>
			<input type="submit" name="Submit" value="Search" />
			</label>
		  </div>
			<div class="table">
				<img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
				<table class="listing" cellpadding="0" cellspacing="0">
					<tr>
						<th class="first" width="377">Title</th>
						<th>Edit</th>
						<th>Published</th>
						<th class="last">Delete</th>
					</tr>

                    <?
                    foreach ($plugins as $key => $value) {
                    ?>
					<tr>
						<td class="first style1"><? echo $key; ?></td>
						<td><a href="comment.php?action=edit&id=<? echo $key; ?>"><img src="../../resources/img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
						<td>
                                                <? if ($key) { ?>
                                                    <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                                <? } else { ?>
                                                    <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                                <? } ?></td>
						<td class="last"><a href="comment.php?action=delete&id=<? echo $key; ?>"><img src="../../resources/img/hr.gif" width="16" height="16" alt="add" /></a></td>
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
              <form name="formnew" method="post" action="comment.php">
                <input type="submit" value="New" name="new" />
              </form>
			</div>
		  <div class="table">
				<img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                                <table class="listing form" cellpadding="0" cellspacing="0">
                <form name="form1" enctype="multipart/form-data" method="post" action="comment.php?action=save">
					<tr>
						<th class="full" colspan="2">Edit</th>
					</tr>
                                        <tr>
						<td class="first" width="172"><strong>Article</strong></td>
						<td class="last">
                                                    <?  echo 'Hello!!!!'; ?>
                                                    <input type="hidden" name="created" value="<? echo 'Hello'; ?>">
                                                </td>
                                        </tr>
                                 <tr>
						<td class="first"><strong>&nbsp;</strong></td>
                        <input type="hidden" name="id" value="<? echo '' ?>">
                        <td class="last">
                        <input type="submit" value="Save" name="save" />
                        </form>
                             </td>
			</tr>
			</table>
	        <p>&nbsp;</p>
		  </div>
		</div>
		<div id="right-column">
			<strong class="h">INFO</strong>
			<div class="box">Here there is a list of all comments, published and not still published.</div>
	  </div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
