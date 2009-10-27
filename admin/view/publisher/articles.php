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
        <? require_once('../../view/common/tinymcesetup.php'); ?>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <a href="#" class="logo"><img src="../../resources/img/logo_blu_arancio.gif" alt="" /></a>
                <ul id="top-navigation">
                    <li><span><span><a href="dashboard.php">Dashboard</a></span></span></li>
                    <li><span><span><a href="number.php">Numbers</a></span></span></li>
                    <li><span><span><a href="category.php">Categories</a></span></span></li>
                    <li class="active"><span><span>Articles</span></span></li>
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
                    <h3>Articles</h3>
                    <ul class="nav">
                        <li><a href="article.php">Show All</a></li>
                        <li class="last"><a href="article.php?list=byuser">Show My Articles</a></li>
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
                    <div class="select-bar">
                        <form name="searchform" method="post" action="article.php?list=find">
                            <label>
                                <input type="text" size="50" name="string" />
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
                                <th>Comments</th>
                                <th>Published</th>
                                <th class="last">Delete</th>
                            </tr>

                            <?
                            foreach ($arts as $ar) {
                                ?>
                            <tr>
                                <td class="first style1"><? echo $ar->getTitle(); ?></td>
                                <td><a href="article.php?action=edit&id=<? echo $ar->getId(); ?>&list=<?=$lastList?>&pageSelected=<?=$pageSelected?>"><img src="../../resources/img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
                                <td><a href="article.php?action=up&id=<? echo $ar->getId(); ?>&list=<?=$lastList?>&pageSelected=<?=$pageSelected?>"><img src="../../resources/img/up-arrow.png" width="16" height="16" alt="" /></a></td>
                                <td><a href="article.php?action=down&id=<? echo $ar->getId(); ?>&list=<?=$lastList?>&pageSelected=<?=$pageSelected?>"><img src="../../resources/img/down-arrow.png" width="16" height="16" alt="" /></a></td>
                                <td><a href="comment.php?list=commentarticle&article_id=<? echo $ar->getId(); ?>"><img src="../../resources/img/comments.png" width="16" height="16" alt="" /></a></td>
                                <td>
                                        <? if ($ar->getPublished()) { ?>
                                    <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                        <? } else { ?>
                                    <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                    <? } ?></td>
                                <td class="last"><a href="article.php?action=requestdelete&id=<? echo $ar->getId(); ?>&list=<?=$lastList?>&pageSelected=<?=$pageSelected?>"><img src="../../resources/img/hr.gif" width="16" height="16" alt="add" /></a></td>
                            </tr>
                            <?
                            }
                            ?>
                        </table>
                        <div class="select">
                            <form name="pageselectionform" method="post" action="article.php?list=<?=$lastList?>">
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
                        <form name="formnew" method="post" action="article.php?list=<?=$lastList?>&pageSelected=<?=$pageSelected?>">
                            <input type="submit" value="New" name="new" />
                        </form>
                    </div>
                    <div class="table">
                        <img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
                        <img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                        <form name="form1" enctype="multipart/form-data" method="post" action="article.php?action=save&list=<?=$lastList?>&pageSelected=<?=$pageSelected?>">
                            <table class="listing form" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th class="full" colspan="2">Edit</th>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong>Number</strong></td>
                                    <td class="last">
                                        <select name="numberid">
                                            <? foreach ($numbs as $nmb) { ?>
                                            <option value="<? echo $nmb->getId(); ?>"
                                                <? if ($nmb->getId()==$art->getNumber_id()) { echo "selected"; } ?>
                                                    ><? echo $nmb->getTitle(); ?></option>
                                                    <? } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong>Category</strong></td>
                                    <td class="last">
                                        <select name="categoryid">
                                            <? foreach ($categories as $cat) { ?>
                                            <option value="<? echo $cat->getId(); ?>"
                                                <? if ($cat->getId()==$art->getCategory_id()) { echo "selected"; } ?>
                                                    ><? echo $cat->getName(); ?></option>
                                                    <? } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong>Title</strong></td>
                                    <td class="last">
                                        <textarea name="Title" rows="1" cols="60"><? echo $art->getUnfilteredTitle(); ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong>Sub Title</strong></td>
                                    <td class="last">
                                        <textarea name="SubTitle" rows="1" cols="60"><? echo $art->getUnfilteredSubtitle(); ?></textarea>
                                    </td>
                                </tr>
                                <tr class="bg">
                                    <td class="first" colspan="2"><strong>Summary</strong><br />
                                        <textarea id="Summary" name="Summary" rows="4" cols="60" class="mceAdvanced" style="width: 100%">
                                            <? echo $art->getUnfilteredSummary(); ?>
                                        </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="first" colspan="2"><strong>Body</strong><br />
                                        <textarea cols="40" id="article_body" name="Body" rows="20" class="mceAdvanced" style="width: 100%">
                                            <? echo $art->getUnfilteredBody(); ?>
                                        </textarea>
                                </td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Tag</strong></td>
                                    <td class="last"><input type="text" size="50" name="Tag" value="<? echo $art->getUnfilteredTag(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>Meta Description</strong></td>
                                    <td class="last"><textarea name="MetaDescription" rows="4" cols="50"><? echo $art->getMetaDescription(); ?></textarea></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Meta Keyword</strong></td>
                                    <td class="last"><textarea name="MetaKeyword" rows="4" cols="50"><? echo $art->getMetaKeyword(); ?></textarea></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>Published</strong></td>
                                    <td class="last"><input type="checkbox" name="Published" value="1" <? if($art->getPublished()) echo 'checked="checked"'; ?>/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Comments allowed</strong></td>
                                    <td class="last"><input type="checkbox" name="commentsallowed" value="1"  <? if($art->getCommentsallowed()) echo 'checked="checked"'; ?>/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Created:</strong></td>
                                    <td class="last"><? echo $art->getCreated(); ?></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>Updated:</strong></td>
                                    <td class="last"><? echo $art->getUpdated(); ?></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>&nbsp;</strong></td>
                                <input type="hidden" name="id" value="<? echo $art->getId(); ?>">
                                <input type="hidden" name="indexnumber" value="<? echo $art->getIndexnumber(); ?>">
                                <input type="hidden" name="created" value="<? echo $art->getCreated(); ?>">
                                <input type="hidden" name="updated" value="<? echo $art->getUpdated(); ?>">
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                                <td class="last"><input type="submit" value="Save" name="save" /></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="table">
                        <img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
                        <img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                        <table class="listing" cellpadding="0" cellspacing="0">
                            <tr>
                                <th class="first" width="177">Article Authors</th>
                                <th class="last">Unlink</th>
                            </tr>
                            <?
                            foreach ($art->users() as $ur) {
                                ?>
                            <tr>
                                <td class="first style1"><? echo $ur->getName(); ?> - <? echo $ur->getUsername(); ?></td>
                                <td class="last" width="50"><a href="article.php?action=requestunlinkauthor&idauthor=<? echo $ur->getId(); ?>&idarticle=<? echo $art->getId(); ?>"><img src="../../resources/img/hr.gif" width="16" height="16" alt="add" /></a></td>
                            </tr>
                            <?
                            }
                            ?>
                            <tr>
                            <form name="formlinkauthor" method="post" action="article.php?action=linkauthor&idarticle=<? echo $art->getId(); ?>&list=<?=$lastList?>&pageSelected=<?=$pageSelected?>">
                                <td class="first style1">
                                    <select name="authorid">
                                        <? foreach ($authors as $auth) { ?>
                                        <option value="<? echo $auth->getId(); ?>" ><? echo $auth->getName(); ?> - <? echo $auth->getUsername(); ?></option>
                                        <? } ?>
                                    </select>
                                </td>
                                <td class="last" width="50"><input type="submit" value="Link" name="Link" /></td>
                            </form>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="right-column">
                    <strong class="h">INFO</strong>
                    <div class="box">Here there is a list of all articles, published and not still published.</div>
                </div>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>
