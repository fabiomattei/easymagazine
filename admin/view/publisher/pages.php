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
		<a href="index.html" class="logo"><img src="../../resources/img/logo.gif" width="101" height="29" alt="" /></a>
		<ul id="top-navigation">
			<li><span><span><a href="dashboard.php">Dashboard</a></span></span></li>
			<li><span><span><a href="number.php">Numbers</a></span></span></li>
			<li><span><span><a href="article.php">Articles</a></span></span></li>
			<li class="active"><span><span>Pages</span></span></li>
			<li><span><span><a href="comment.php">Comments</a></span></span></li>
			<li><span><span><a href="plugin.php">Plugin</a></span></span></li>
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
                    <form name="searchform" method="post" action="page.php?action=find">
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
						<th class="first" width="177">Title</th>
						<th>Edit</th>
						<th>Up</th>
						<th>Down</th>
						<th>Published</th>
						<th class="last">Delete</th>
					</tr>

                    <?
                    foreach ($pags as $pg) {
                    ?>
					<tr>
						<td class="first style1"><? echo $pg->getTitle(); ?></td>
						<td><a href="page.php?action=edit&id=<? echo $pg->getId(); ?>"><img src="../../resources/img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
						<td><a href="page.php?action=up&id=<? echo $pg->getId(); ?>"><img src="../../resources/img/up-arrow.png" width="16" height="16" alt="" /></a></td>
						<td><a href="page.php?action=down&id=<? echo $pg->getId(); ?>"><img src="../../resources/img/down-arrow.png" width="16" height="16" alt="" /></a></td>
						<td>
                                                <? if ($pg->getPublished()) { ?>
                                                    <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                                <? } else { ?>
                                                    <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                                <? } ?></td>
						<td class="last"><a href="page.php?action=requestdelete&id=<? echo $pg->getId(); ?>"><img src="../../resources/img/hr.gif" width="16" height="16" alt="add" /></a></td>
					</tr>
                    <?
                    }
                    ?>
				</table>
              <form name="formnew" method="post" action="page.php">
                <input type="submit" value="New" name="new" />
              </form>
			</div>
		  <div class="table">
				<img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
				<img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                <form name="form1" enctype="multipart/form-data" method="post" action="page.php?action=save">
				<table class="listing form" cellpadding="0" cellspacing="0">
					<tr>
						<th class="full" colspan="2">Edit</th>
					</tr>
					<tr>
						<td class="first" width="172"><strong>Title</strong></td>
						<td class="last"><input type="text" name="Title" value="<? echo $pag->getUnfilteredTitle(); ?>"/></td>
                    </tr>
					<tr class="bg">
						<td class="first"><strong>Sub Title</strong></td>
						<td class="last"><input type="text" name="SubTitle" value="<? echo $pag->getUnfilteredSubtitle(); ?>"/></td>
					</tr>
					<tr>
						<td class="first"><strong>Summary</strong></td>
                        <td class="last"><textarea name="Summary" rows="4" cols="60"><? echo $pag->getUnfilteredSummary(); ?></textarea></td>
					</tr>
                    <tr>
                                    <td class="first" colspan="2"><strong>Body</strong><br />
                                        <script src="../../../lib/textileeditor/teh/javascripts/prototype.js" type="text/javascript"></script>
                                            <textarea cols="40" id="article_body" name="Body" rows="20" style="width: 500px; padding: 5px"><? echo $pag->getUnfilteredBody(); ?></textarea>
                                            <link href="../../../lib/textileeditor/teh/stylesheets/textile-editor.css" media="screen" rel="Stylesheet" type="text/css" />
                                            <script src="../../../lib/textileeditor/teh/javascripts/textile-editor.js" type="text/javascript"></script>
                                            <script type="text/javascript">
                                                Event.observe(window, "load", function() {
                                                    TextileEditor.initialize("article_body", "extended");
                                                });
                                            </script>
                                    </td>
					</tr>
                    					<tr>
						<td class="first"><strong>Tag</strong></td>
                        <td class="last"><input type="text" name="Tag" value="<? echo $pag->getUnfilteredTag(); ?>"/></td>
					</tr>
                    <tr>
						<td class="first"><strong>Meta Description</strong></td>
                        <td class="last"><textarea name="MetaDescription" rows="4" cols="60"><? echo $pag->getMetaDescription(); ?></textarea></td>
					</tr>
                    <tr>
						<td class="first"><strong>Meta Keyword</strong></td>
                        <td class="last"><textarea name="MetaKeyword" rows="4" cols="60"><? echo $pag->getMetaKeyword(); ?></textarea></td>
					</tr>
                    <tr class="bg">
						<td class="first"><strong>Published</strong></td>
						<td class="last"><input type="checkbox" name="Published" value="1" <? if($pag->getPublished()) echo 'checked="checked"'; ?>/></td>
					</tr>
                    <tr class="bg">
						<td class="first"><strong>Show Image</strong></td>
                        <td class="last">
                        <? if ($pag->imageExists()) { ?>
                        <img src="<? echo $pag->imagePath(); ?>"
                        <a href="page.php?action=deleteimg&id=<? echo $pag->getId(); ?>">Delete image</a>
                        <? } else { ?>
                        &nbsp;
                        <? } ?>
                        </td>
					</tr>
                    <tr>
						<td class="first"><strong>Image File</strong></td>
                        <td class="last"><input type="file" name="Image" value="" /></td>
					</tr>
                    <tr class="bg">
						<td class="first"><strong>Image file name:</strong></td>
                        <td class="last"><? echo $pag->getImgfilename(); ?></td>
					</tr>
                    <tr>
						<td class="first"><strong>Image description:</strong></td>
                        <td class="last"><input type="text" name="ImageDescription" value="<? echo $pag->getImgdescription(); ?>"/></td>
					</tr>
                    <tr class="bg">
						<td class="first"><strong>Created:</strong></td>
                        <td class="last"><? echo $pag->getCreated(); ?></td>
					</tr>
                    <tr>
						<td class="first"><strong>Updated:</strong></td>
                        <td class="last"><? echo $pag->getUpdated(); ?></td>
					</tr>
                    <tr>
						<td class="first"><strong>&nbsp;</strong></td>
                        <input type="hidden" name="id" value="<? echo $pag->getId(); ?>">
                        <input type="hidden" name="indexnumber" value="<? echo $pag->getIndexnumber(); ?>">
                        <input type="hidden" name="imagefilename" value="<? echo $pag->getImgfilename(); ?>">
                        <input type="hidden" name="created" value="<? echo $pag->getCreated(); ?>">
                        <input type="hidden" name="updated" value="<? echo $pag->getUpdated(); ?>">
                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                        <td class="last"><input type="submit" value="Save" name="save" /></td>
					</tr>
				</table>
                </form>
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
