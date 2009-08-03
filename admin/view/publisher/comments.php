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
        <style media="all" type="text/css">@import "../../resources/css/messages.css";</style>
</head>
<body>
<div id="main">
	<div id="header">
		<a href="index.html" class="logo"><img src="../../resources/img/logo_blu_arancio.gif" alt="" /></a>
		<ul id="top-navigation">
			<li><span><span><a href="dashboard.php">Dashboard</a></span></span></li>
			<li><span><span><a href="number.php">Numbers</a></span></span></li>
			<li><span><span><a href="article.php">Articles</a></span></span></li>
			<li><span><span><a href="page.php">Pages</a></span></span></li>
			<li class="active"><span><span>Comments</span></span></li>
			<li><span><span><a href="plugin.php">Plugin</a></span></span></li>
			<li><span><span><a href="template.php">Template</a></span></span></li>
                        <li><span><span><a href="user.php">Users</a></span></span></li>
		</ul>
	</div>
	<div id="middle">
		<div id="left-column">
			<h3>Hello, <? echo $_SESSION['user']->getName() ?></h3><br />
                        <h3>Comments</h3>
			<ul class="nav">
				<li><a href="#">View all comments</a></li>
				<li><a href="#">View my comments</a></li>
				<li class="last"><a href="#">View comments to my articles</a></li>
			</ul>
			<a href="#" class="link">View the website</a>
		</div>
		<div id="center-column">
                    <?
                    if (isset($info) AND $info!='') {
                        echo '<div class="message info"><p><strong>Info:</strong>: '.$info.'</p></div>';
                    }
                    if (isset($warning) AND $warning!='') {
                        echo '<div class="message warning"><p><strong>Warning:</strong>: '.$warning.'</p></div>';
                    }
                    if (isset($question) AND $question!='') {
                        echo '<div class="message question"><p><strong>Question:</strong>: '.$question.'</p></div>';
                    }
                    if (isset($error) AND $error!='') {
                        echo '<div class="message error"><p><strong>Error:</strong>: '.$error.'</p></div>';
                    }
                    ?>
		  <div class="select-bar">
                    <form name="searchform" method="post" action="comment.php?action=find">
		    <label>
		    <input type="text" name="string" />
		    </label>
		    <label>
			<input type="submit" name="Submit" value="Search" />
	            </label>
                    </form>
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
                    foreach ($comms as $ar) {
                    ?>
					<tr>
						<td class="first style1"><? echo $ar->getTitle(); ?></td>
						<td><a href="comment.php?action=edit&id=<? echo $ar->getId(); ?>"><img src="../../resources/img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
						<td>
                                                <? if ($ar->getPublished()) { ?>
                                                    <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                                <? } else { ?>
                                                    <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                                <? } ?></td>
						<td class="last"><a href="comment.php?action=requestdelete&id=<? echo $ar->getId(); ?>"><img src="../../resources/img/hr.gif" width="16" height="16" alt="add" /></a></td>
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
                                                    <? if($comm->getArticle_id() != Comment::NEW_COMMENT) { echo $comm->article()->getTitle(); } ?>
                                                    <input type="hidden" name="created" value="<? echo $comm->getArticle_id(); ?>">
                                                </td>
                                        </tr>
					<tr>
						<td class="first" width="172"><strong>Title</strong></td>
						<td class="last"><input type="text" name="Title" value="<? echo $comm->getUnfilteredTitle(); ?>"/></td>
                    </tr>
                    <tr>
						<td class="first"><strong>Body</strong></td>
                        <td class="last"><textarea name="Body" rows="4" cols="60"><? echo $comm->getUnfilteredBody(); ?></textarea></td>
					</tr>
                    					<tr>
						<td class="first"><strong>Signature</strong></td>
                        <td class="last"><input type="text" name="Signature" value="<? echo $comm->getSignature(); ?>"/></td>
					</tr>
                    <tr class="bg">
						<td class="first"><strong>Published</strong></td>
						<td class="last"><input type="checkbox" name="Published" value="1" <? if($comm->getPublished()) echo 'checked="checked"'; ?>/></td>
					</tr>
                    <tr class="bg">
						<td class="first"><strong>Created:</strong></td>
                        <td class="last"><? echo $comm->getCreated(); ?></td>
					</tr>
                    <tr>
						<td class="first"><strong>Updated:</strong></td>
                        <td class="last"><? echo $comm->getUpdated(); ?></td>
					</tr>
                    <tr>
						<td class="first"><strong>&nbsp;</strong></td>
                        <input type="hidden" name="id" value="<? echo $comm->getId(); ?>">
                        <input type="hidden" name="created" value="<? echo $comm->getCreated(); ?>">
                        <input type="hidden" name="updated" value="<? echo $comm->getUpdated(); ?>">
                        <input type="hidden" name="article_id" value="<? echo $comm->getArticle_id(); ?>">
                        <td class="last">
                        <input type="submit" value="Save" name="save" />
                        </form>

                        <form name="formnew" method="post" action="comment.php?action=replay&id=<? echo $ar->getId(); ?>">
                        <input type="submit" value="Replay" name="new" />
                        </form></td>
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
