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
        <title><?php echo LANG_ADMIN_TITLE; ?>: <?php echo LANG_MENU_DASHBOARD; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <style media="all" type="text/css">@import "../../resources/css/all.css";</style>
        <style media="all" type="text/css">@import "../../resources/css/messages.css";</style>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <a href="#" class="logo"><img src="../../resources/img/logo_blu_arancio.gif" alt="" /></a>
                <ul id="top-navigation">
                    <li class="active"><span><span><?php echo LANG_MENU_DASHBOARD; ?></span></span></li>
                    <li><span><span><a href="number.php"><?php echo LANG_MENU_NUMBERS; ?></a></span></span></li>
                    <li><span><span><a href="category.php"><?php echo LANG_MENU_CATEGORIES; ?></a></span></span></li>
                    <li><span><span><a href="article.php"><?php echo LANG_MENU_ARTICLES; ?></a></span></span></li>
                    <li><span><span><a href="page.php"><?php echo LANG_MENU_PAGES; ?></a></span></span></li>
                    <li><span><span><a href="comment.php"><?php echo LANG_MENU_COMMENTS; ?></a></span></span></li>
                    <li><span><span><a href="plugin.php"><?php echo LANG_MENU_PLUGIN; ?></a></span></span></li>
                    <li><span><span><a href="template.php"><?php echo LANG_MENU_TEMPLATE; ?></a></span></span></li>
					<li><span><span><a href="mobiletemplate.php"><?php echo LANG_MENU_MOBILE_TEMPLATE; ?></a></span></span></li>
                    <li><span><span><a href="settings.php"><?php echo LANG_MENU_SETTINGS; ?></a></span></span></li>
                    <li><span><span><a href="user.php"><?php echo LANG_MENU_USERS; ?></a></span></span></li>
                </ul>
                <div id="logout"><a href="../../logout.php"><?php echo LANG_MENU_LOGOUT; ?></a></div>
            </div>
            <div id="middle">
                <div id="left-column">
                    <h3><?php echo LANG_LEFT_GREETINGS; ?>, <?PHP echo $_SESSION['user']->getName() ?></h3><br />
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
                    <div class="table">
                        <img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
                        <img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                        <table class="listing" cellpadding="0" cellspacing="0">
                            <tr>
                                <th class="first"><?php echo LANG_ADMIN_TABLE_UPDATED_ARTICLES; ?></th>
                                <th width="80"><?php echo LANG_ADMIN_TABLE_EDIT; ?></th>
                                <th class="last" width="80"><?php echo LANG_ADMIN_TABLE_PUBLISHED; ?></th>
                            </tr>

                            <?
                            foreach ($arts as $ar) {
                                ?>
                            <tr>
                                <td class="first style1"><?PHP echo $ar->getTitle(); ?></td>
                                <td><a href="article.php?action=edit&id=<?PHP echo $ar->getId(); ?>"><img src="../../resources/img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
                                <td class="last">
                                    <?PHP if ($ar->getPublished()) { ?>
                                    <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                    <?PHP } else { ?>
                                    <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                    <?PHP } ?>

                                </td>
                            </tr>
                            <?
                            }
                            ?>
                        </table>
                    </div>
                    <div class="table">
                        <img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
                        <img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />
                        <table class="listing" cellpadding="0" cellspacing="0">
                            <tr>
                                <th class="first"><?php echo LANG_ADMIN_TABLE_UPDATED_COMMENTS; ?></th>
                                <th width="80"><?php echo LANG_ADMIN_TABLE_EDIT; ?></th>
                                <th class="last" width="80"><?php echo LANG_ADMIN_TABLE_PUBLISHED; ?></th>
                            </tr>

                            <?
                            foreach ($comms as $ar) {
                                ?>
                            <tr>
                                <td class="first style1"><?PHP echo $ar->getTitle(); ?></td>
                                <td><a href="comment.php?action=edit&id=<?PHP echo $ar->getId(); ?>"><img src="../../resources/img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
                                <td class="last">
                                    <?PHP if ($ar->getPublished()) { ?>
                                        <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                    <?PHP } else { ?>
                                        <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                    <?PHP } ?>
                                </td>
                            </tr>
                            <?
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div id="right-column">
                    <strong class="h"><?php echo LANG_MSG_INFO; ?></strong>
                    <div class="box"><?php echo LANG_ADMIN_DASHBOARD_INFO; ?></div>
                </div>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>
