<?

/*
    Copyright (C) 2009-2010  Fabio Mattei <burattino@gmail.com>

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
        <title>Easy Magazine Admin: <?php echo LANG_MENU_PAGES; ?></title>
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
                    <li><span><span><a href="dashboard.php"><?php echo LANG_MENU_DASHBOARD; ?></a></span></span></li>
                    <li><span><span><a href="number.php"><?php echo LANG_MENU_NUMBERS; ?></a></span></span></li>
                    <li><span><span><a href="category.php"><?php echo LANG_MENU_CATEGORIES; ?></a></span></span></li>
                    <li><span><span><a href="article.php"><?php echo LANG_MENU_ARTICLES; ?></a></span></span></li>
                    <li class="active"><span><span><?php echo LANG_MENU_PAGES; ?></span></span></li>
                    <li><span><span><a href="comment.php"><?php echo LANG_MENU_COMMENTS; ?></a></span></span></li>
                    <li><span><span><a href="plugin.php"><?php echo LANG_MENU_PLUGIN; ?></a></span></span></li>
                    <li><span><span><a href="template.php"><?php echo LANG_MENU_TEMPLATE; ?></a></span></span></li>
                    <li><span><span><a href="settings.php"><?php echo LANG_MENU_SETTINGS; ?></a></span></span></li>
                    <li><span><span><a href="user.php"><?php echo LANG_MENU_USERS; ?></a></span></span></li>
                </ul>
                <div id="logout"><a href="../../logout.php"><?php echo LANG_MENU_LOGOUT; ?></a></div>
            </div>
            <div id="middle">
                <div id="left-column">
                    <h3><?php echo LANG_LEFT_GREETINGS; ?>, <? echo $_SESSION['user']->getName() ?></h3><br />
                    <a href="../../index.php" class="link"><?php echo LANG_LEFT_VIEW_WEBSITE; ?></a>
                </div>
                <div id="center-column">
                    <?
                    foreach ($infoarray as $info) {
                        echo '<div class="message info"><p><strong>'.LANG_MSG_INFO.':</strong>: '.$info.'</p></div>';
                    }
                    foreach ($warningarray as $warning) {
                        echo '<div class="message warning"><p><strong>'.LANG_MSG_WARNING.':</strong>: '.$warning.'</p></div>';
                    }
                    foreach ($questionarray as $question) {
                        echo '<div class="message question"><p><strong>'.LANG_MSG_QUESTION.':</strong>: '.$question.'</p></div>';
                    }
                    foreach ($errorarray as $error) {
                        echo '<div class="message error"><p><strong>'.LANG_MSG_ERROR.':</strong>: '.$error.'</p></div>';
                    }
                    ?>
                    <div class="select-bar">
                        <form name="searchform" method="post" action="page.php?list=find">
                            <label>
                                <input type="text" size="50" name="string" />
                            </label>
                            <label>
                                <input type="submit" name="Submit" value="<?php echo LANG_MENU_SEARCH; ?>" />
                            </label>
                        </form>
                    </div>
                    <div class="table">
                        <img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
                        <img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                        <table class="listing" cellpadding="0" cellspacing="0">
                            <tr>
                                <th class="first" width="177"><?php echo LANG_ADMIN_TABLE_TITLE; ?></th>
                                <th><?php echo LANG_ADMIN_TABLE_EDIT; ?></th>
                                <th><?php echo LANG_ADMIN_TABLE_UP; ?></th>
                                <th><?php echo LANG_ADMIN_TABLE_DOWN; ?></th>
                                <th><?php echo LANG_ADMIN_TABLE_PREVIEW; ?></th>
                                <th><?php echo LANG_ADMIN_TABLE_PUBLISHED; ?></th>
                                <th class="last"><?php echo LANG_ADMIN_TABLE_DELETE; ?></th>
                            </tr>

                            <?
                            foreach ($pags as $pg) {
                                ?>
                            <tr>
                                <td class="first style1"><? echo $pg->getTitle(); ?></td>
                                <td><a href="page.php?action=edit&id=<? echo $pg->getId(); ?>&list=<?=$lastList?>"><img src="../../resources/img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
                                <td><a href="page.php?action=up&id=<? echo $pg->getId(); ?>&list=<?=$lastList?>"><img src="../../resources/img/up-arrow.png" width="16" height="16" alt="" /></a></td>
                                <td><a href="page.php?action=down&id=<? echo $pg->getId(); ?>&list=<?=$lastList?>"><img src="../../resources/img/down-arrow.png" width="16" height="16" alt="" /></a></td>
                                <td><a href="page.php?action=preview&id=<? echo $pg->getId(); ?>"><img src="../../resources/img/preview_icon.png" width="16" height="16" alt="" /></a></td>
                                <td>
                                        <? if ($pg->getPublished()) { ?>
                                    <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                        <? } else { ?>
                                    <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                    <? } ?></td>
                                <td class="last"><a href="page.php?action=requestdelete&id=<? echo $pg->getId(); ?>&list=<?=$lastList?>"><img src="../../resources/img/hr.gif" width="16" height="16" alt="add" /></a></td>
                            </tr>
                            <?
                            }
                            ?>
                        </table>
                        <form name="formnew" method="post" action="page.php?list=<?=$lastList?>">
                            <input type="submit" value="<?php echo LANG_ADMIN_TABLE_NEW; ?>" name="new" />
                        </form>
                    </div>
                    <div class="table">
                        <img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
                        <img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                        <form name="form1" enctype="multipart/form-data" method="post" action="page.php?action=save&list=<?=$lastList?>">
                            <table class="listing form" cellpadding="0" cellspacing="0">
                                <tr>
                                    <th class="full" colspan="2"><?php echo LANG_ADMIN_TABLE_EDIT; ?></th>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_TITLE; ?></strong></td>
                                    <td class="last">
                                        <textarea name="Title" rows="1" cols="60"><?= $pag->getUnfilteredTitle(); ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_SUBTITLE; ?></strong></td>
                                    <td class="last">
                                        <textarea name="SubTitle" rows="1" cols="60"><?= $pag->getUnfilteredSubtitle(); ?></textarea>
                                    </td>
                                </tr>
                                <tr class="bg">
                                    <td class="first" colspan="2"><strong><?php echo LANG_ADMIN_TABLE_SUMMARY; ?></strong><br />
                                        <textarea name="Summary" class="mceAdvanced" rows="4" cols="60"><? echo $pag->getUnfilteredSummary(); ?></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="first" colspan="2"><strong><?php echo LANG_ADMIN_TABLE_BODY; ?></strong><br />
                                        <textarea cols="40" id="article_body" class="mceAdvanced" name="Body" rows="20" style="width: 500px; padding: 5px">
                                        <? echo $pag->getUnfilteredBody(); ?>
                                        </textarea>
                                </td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Tag</strong></td>
                                    <td class="last"><input type="text" size="50" name="Tag" value="<? echo $pag->getUnfilteredTag(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>Meta Description</strong></td>
                                    <td class="last"><textarea name="MetaDescription" rows="4" cols="60"><? echo $pag->getMetaDescription(); ?></textarea></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Meta Keyword</strong></td>
                                    <td class="last"><textarea name="MetaKeyword" rows="4" cols="60"><? echo $pag->getMetaKeyword(); ?></textarea></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_PUBLISHED; ?></strong></td>
                                    <td class="last"><input type="checkbox" name="Published" value="1" <? if($pag->getPublished()) echo 'checked="checked"'; ?>/></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_CREATED; ?></strong></td>
                                    <td class="last"><? echo $pag->getCreated(); ?></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_UPDATED; ?></strong></td>
                                    <td class="last"><? echo $pag->getUpdated(); ?></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>&nbsp;</strong></td>
                                <input type="hidden" name="id" value="<? echo $pag->getId(); ?>">
                                <input type="hidden" name="indexnumber" value="<? echo $pag->getIndexnumber(); ?>">
                                <input type="hidden" name="created" value="<? echo $pag->getCreated(); ?>">
                                <input type="hidden" name="updated" value="<? echo $pag->getUpdated(); ?>">
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                                <td class="last"><input type="submit" value="<?php echo LANG_ADMIN_TABLE_SAVE; ?>" name="save" /></td>
                                </tr>
                            </table>
                        </form>
                        <p>&nbsp;</p>
                    </div>
                </div>
                <div id="right-column">
                    <strong class="h"><?php echo LANG_MSG_INFO; ?></strong>
                    <div class="box"><?php echo LANG_ADMIN_PAGE_INFO; ?></div>
                </div>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>
