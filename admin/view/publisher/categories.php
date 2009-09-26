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
        <title>Easy Magazine Admin: Numbers</title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <style media="all" type="text/css">@import "../../resources/css/all.css";</style>
        <style media="all" type="text/css">@import "../../resources/css/messages.css";</style>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <a href="#" class="logo"><img src="../../resources/img/logo_blu_arancio.gif" alt="" /></a>
                <ul id="top-navigation">
                    <li><span><span><a href="dashboard.php">Dashboard</a></span></span></li>
                    <li><span><span><a href="number.php">Numbers</a></span></span></li>
                    <li class="active"><span><span>Categories</span></span></li>
                    <li><span><span><a href="article.php">Articles</a></span></span></li>
                    <li><span><span><a href="page.php">Pages</a></span></span></li>
                    <li><span><span><a href="comment.php">Comments</a></span></span></li>
                    <li><span><span><a href="plugin.php">Plugin</a></span></span></li>
                    <li><span><span><a href="template.php">Template</a></span></span></li>
                    <li><span><span><a href="settings.php">Settings</a></span></span></li>
                    <li><span><span><a href="user.php">Users</a></span></span></li>
                </ul>
                <div id="logout"><a href="../../logout.php">logout</a></div>
            </div>
            <div id="middle">
                <div id="left-column">
                    <h3>Hello, <? echo $_SESSION['user']->getName() ?> </h3><br />
                    <h3>Categories</h3>
                    <ul class="nav">
                        <li><a href="category.php">Show All</a></li>
                        <li><a href="category.php?list=showPublished">Show Published</a></li>
                        <li class="last"><a href="category.php?list=showNotPublished">Show Not Published</a></li>
                    </ul>
                    <a href="../../index.php" class="link">View the website</a>
                </div>
                <div id="center-column">
                    <?
                    foreach ($infoarray as $info) {
                        echo '<div class="message info"><p><strong>Info:</strong>: '.$info.'</p></div>';
                    }
                    foreach ($warningarray as $warning) {
                        echo '<div class="message warning"><p><strong>Warning:</strong>: '.$warning.'</p></div>';
                    }
                    foreach ($questionarray as $question) {
                        echo '<div class="message question"><p><strong>Question:</strong>: '.$question.'</p></div>';
                    }
                    foreach ($errorarray as $error) {
                        echo '<div class="message error"><p><strong>Error:</strong>: '.$error.'</p></div>';
                    }
                    ?>
                    <div class="table">
                        <img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
                        <img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                        <table class="listing" cellpadding="0" cellspacing="0">
                            <tr>
                                <th class="first" width="177">Name</th>
                                <th>Edit</th>
                                <th>Up</th>
                                <th>Down</th>
                                <th>Articles</th>
                                <th>Published</th>
                                <th class="last">Delete</th>
                            </tr>
                            <?
                            foreach ($categories as $cat) {
                                ?>
                            <tr>
                                <td class="first style1"><? echo $cat->getName(); ?></td>
                                <td><a href="category.php?action=edit&id=<? echo $cat->getId(); ?>&list=<?=$lastList?>&pageSelected=<?=$pageSelected?>"><img src="../../resources/img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
                                <td><a href="category.php?action=up&id=<? echo $cat->getId(); ?>&list=<?=$lastList?>&pageSelected=<?=$pageSelected?>"><img src="../../resources/img/up-arrow.png" width="16" height="16" alt="" /></a></td>
                                <td><a href="category.php?action=down&id=<? echo $cat->getId(); ?>&list=<?=$lastList?>&pageSelected=<?=$pageSelected?>"><img src="../../resources/img/down-arrow.png" width="16" height="16" alt="" /></a></td>
                                <td><a href="article.php?list=articlecategory&id=<? echo $cat->getId(); ?>"><img src="../../resources/img/article.png" width="16" height="16" alt="" /></a></td>
                                <td>
                                        <? if ($cat->getPublished()) { ?>
                                    <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                        <? } else { ?>
                                    <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                        <? } ?>
                                </td>
                                <td class="last"><a href="category.php?action=requestdelete&id=<? echo $cat->getId(); ?>&list=<?=$lastList?>&pageSelected=<?=$pageSelected?>"><img src="../../resources/img/hr.gif" width="16" height="16" alt="add" /></a></td>
                            </tr>
                            <?
                            }
                            ?>
                        </table>
                        <div class="select">
                            <form name="pageselectionform" method="post" action="category.php?lastList=<?=$lastList?>">
                                <strong>Pages: </strong>
                                <select name="page">
                                    <? for ($i=1;$i<=$page_numbers;$i++) { ?>
                                    <option value="<?=$i?>" <?if ($i == $pageSelected) echo 'selected';?> ><?=$i?></option>
                                    <? }?>
                                </select>&nbsp;
                                <input type="hidden" name="movinglist" value="yes" />
                                <input type="submit" value="Go" name="Go" />
                            </form>
                        </div>
                        <form name="formnew" method="post" action="category.php?list=<?=$lastList?>&pageSelected=<?=$pageSelected?>">
                            <input type="submit" value="New" name="new" />
                        </form>
                    </div>
                    <div class="table">
                        <img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
                        <img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                        <form name="form1" enctype="multipart/form-data" method="post" action="category.php?action=save&list=<?=$lastList?>&pageSelected=<?=$pageSelected?>">
                            <table class="listing form" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th class="full" colspan="2">Edit</th>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong>Name</strong></td>
                                    <td class="last"><input type="text" size="50" name="Name" value="<? echo $categ->getName(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first" colspan="2"><strong>Description</strong><br />
                                        <script src="../../../lib/textileeditor/teh/javascripts/prototype.js" type="text/javascript"></script>
                                        <textarea cols="40" id="article_body" name="Description" rows="20" style="width: 500px; padding: 5px"><? echo $categ->getUnfilteredDescription(); ?></textarea>
                                <link href="../../../lib/textileeditor/teh/stylesheets/textile-editor.css" media="screen" rel="Stylesheet" type="text/css" />
                                <script src="../../../lib/textileeditor/teh/javascripts/textile-editor.js" type="text/javascript"></script>
                                <script type="text/javascript">
                                    Event.observe(window, "load", function() {
                                        TextileEditor.initialize("article_body", "extended");
                                    });
                                </script>
                                </td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Published</strong></td>
                                    <td class="last"><input type="checkbox" name="Published" value="1" <? if($categ->getPublished()) echo 'checked="checked"'; ?>/></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>Created:</strong></td>
                                    <td class="last"><? echo $categ->getCreated(); ?></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Updated:</strong></td>
                                    <td class="last"><? echo $categ->getUpdated(); ?></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>&nbsp;</strong></td>
                                <input type="hidden" name="id" value="<? echo $categ->getId(); ?>">
                                <input type="hidden" name="indexnumber" value="<? echo $categ->getIndexnumber(); ?>">
                                <input type="hidden" name="created" value="<? echo $categ->getCreated(); ?>">
                                <input type="hidden" name="updated" value="<? echo $categ->getUpdated(); ?>">
                                <td class="last"><input type="submit" value="Save" name="save" /></td>
                                </tr>
                            </table>
                        </form>
                        <p>&nbsp;</p>
                    </div>
                </div>
                <div id="right-column">
                    <strong class="h">INFO</strong>
                    <div class="box">Here there is a list of all categories, you'll need it to classify your articles.<br />
                        Only the published ones will be visible in the website.</div>
                </div>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>
