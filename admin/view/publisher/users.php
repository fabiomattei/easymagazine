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
        <title><?php echo LANG_ADMIN_TITLE; ?>: <?php echo LANG_MENU_USERS; ?></title>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <style media="all" type="text/css">@import "../../resources/css/all.css";</style>
        <style media="all" type="text/css">@import "../../resources/css/messages.css";</style>
        <?PHP require_once('../../view/common/tinymcesetup.php'); ?>
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
                    <li><span><span><a href="page.php"><?php echo LANG_MENU_PAGES; ?></a></span></span></li>
                    <li><span><span><a href="comment.php"><?php echo LANG_MENU_COMMENTS; ?></a></span></span></li>
                    <li><span><span><a href="plugin.php"><?php echo LANG_MENU_PLUGIN; ?></a></span></span></li>
                    <li><span><span><a href="template.php"><?php echo LANG_MENU_TEMPLATE; ?></a></span></span></li>
                    <li><span><span><a href="settings.php"><?php echo LANG_MENU_SETTINGS; ?></a></span></span></li>
                    <li class="active"><span><span><?php echo LANG_MENU_USERS; ?></span></span></li>
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
                                <th class="first" width="377"><?php echo LANG_ADMIN_TABLE_NAME; ?> - <?php echo LANG_ADMIN_TABLE_USERNAME; ?></th>
                                <th><?php echo LANG_ADMIN_TABLE_EDIT; ?></th>
                                <th><?php echo LANG_ADMIN_TABLE_PUBLISHER; ?></th>
                                <th><?php echo LANG_ADMIN_TABLE_PUBLISHED; ?></th>
                                <th class="last"><?php echo LANG_ADMIN_TABLE_DELETE; ?></th>
                            </tr>

                            <?
                            foreach ($userps as $ar) {
                                ?>
                            <tr>
                                <td class="first style1"><?PHP echo $ar->getName(); ?> - <?PHP echo $ar->getUsername(); ?></td>
                                <td><a href="user.php?action=edit&id=<?PHP echo $ar->getId(); ?>"><img src="../../resources/img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
                                <td>
                                        <?PHP if ($ar->getRole()=='publisher') { ?>
                                    <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                        <?PHP } else { ?>
                                    <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                    <?PHP } ?></td>
                                    <td>
                                        <?PHP if ($ar->getToshow()==1) { ?>
                                    <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                        <?PHP } else { ?>
                                    <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                    <?PHP } ?></td>
                                <td class="last"><a href="user.php?action=requestdelete&id=<?PHP echo $ar->getId(); ?>"><img src="../../resources/img/hr.gif" width="16" height="16" alt="add" /></a></td>
                            </tr>
                            <?
                            }
                            ?>
                        </table>
                        <form name="formnew" method="post" action="user.php">
                            <input type="submit" value="New" name="new" />
                        </form>
                    </div>
                    <div class="table">
                        <img src="../../resources/img/bg-th-left.gif" width="8" height="7" alt="" class="left" />
                        <img src="../../resources/img/bg-th-right.gif" width="7" height="7" alt="" class="right" />

                        <table class="listing form" cellpadding="0" cellspacing="0">
                            <form name="form1" enctype="multipart/form-data" method="post" action="user.php?action=save">
                                <tr>
                                    <th class="full" colspan="2"><?php echo LANG_ADMIN_TABLE_EDIT; ?></th>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong><?php echo LANG_ADMIN_TABLE_NAME; ?></strong></td>
                                    <td class="last"><input type="text" size="50" name="Name" value="<?PHP echo $userp->getName(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_USERNAME; ?></strong></td>
                                    <td class="last"><input type="text" size="50" name="Username" value="<?PHP echo $userp->getUsername(); ?>"/></td>
                                </tr>                    
                                <tr class="bg">
                                    <td class="first" colspan="2"><strong><?php echo LANG_ADMIN_TABLE_BODY; ?></strong><br />
                                        <textarea cols="40" id="article_body" name="Body" rows="20" class="mceAdvanced" style="width: 100%"><?PHP echo $userp->getUnfilteredBody(); ?></textarea>
                                </td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong>Email</strong></td>
                                    <td class="last"><input type="text" size="50" name="Email" value="<?PHP echo $userp->getEmail(); ?>"/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>MSN</strong></td>
                                    <td class="last"><input type="text" size="50" name="MSN" value="<?PHP echo $userp->getMsn(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong>Skype</strong></td>
                                    <td class="last"><input type="text" size="50" name="Skype" value="<?PHP echo $userp->getSkype(); ?>"/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_ROLE; ?></strong></td>
                                    <td class="last">
                                        <input type="radio" name="Role" value="publisher" <?PHP if($userp->getRole()=='publisher') echo 'checked="checked"'; ?> /> <?php echo LANG_ADMIN_TABLE_PUBLISHER; ?>
                                        <input type="radio" name="Role" value="journalist" <?PHP if($userp->getRole()=='journalist') echo 'checked="checked"'; ?> /> <?php echo LANG_ADMIN_TABLE_JOURNALIST; ?>
                                    </td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_SHOW_IN_PEOPLE_PAGE; ?></strong></td>
                                    <td class="last"><input type="checkbox" name="toshow" value="1" <?PHP if($userp->getToshow()=='1') echo 'checked="checked"'; ?>/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_CREATED; ?></strong></td>
                                    <td class="last"><?PHP echo $userp->getCreated(); ?></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_UPDATED; ?></strong></td>
                                    <td class="last"><?PHP echo $userp->getUpdated(); ?></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>&nbsp;</strong></td>
                                <input type="hidden" name="id" value="<?PHP echo $userp->getId(); ?>">
                                <input type="hidden" name="created" value="<?PHP echo $userp->getCreated(); ?>">
                                <input type="hidden" name="updated" value="<?PHP echo $userp->getUpdated(); ?>">
                                <input type="hidden" name="Password" value="<?PHP echo $userp->getPassword(); ?>">
                                <td class="last">
                                    <input type="submit" value="<?php echo LANG_ADMIN_TABLE_SAVE; ?>" name="save" />
                                </td>
                                </tr>
                            </form>
                        </table>
                        <br />
                        <table class="listing form" cellpadding="0" cellspacing="0">
                            <form name="form1" enctype="multipart/form-data" method="post" action="user.php?action=savePassword">
                                <tr>
                                    <th class="full" colspan="2"><?php echo LANG_ADMIN_TABLE_CHANGE_PASSWORD; ?></th>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong><?php echo LANG_ADMIN_TABLE_OLD_PASSWORD; ?></strong></td>
                                    <td class="last"><input type="password" name="OldPassword" value=""/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong><?php echo LANG_ADMIN_TABLE_NEW_PASSWORD; ?></strong></td>
                                    <td class="last"><input type="password" name="NewPassword1" value=""/></td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong><?php echo LANG_ADMIN_TABLE_RETYPE_PASSWORD; ?></strong></td>
                                    <td class="last"><input type="password" name="NewPassword2" value=""/></td>
                                </tr>
                                 <tr class="bg">
                                    <td class="first">&nbsp;</td>
                                <input type="hidden" name="id" value="<?PHP echo $userp->getId(); ?>">
                                <input type="hidden" name="created" value="<?PHP echo $userp->getCreated(); ?>">
                                <input type="hidden" name="updated" value="<?PHP echo $userp->getUpdated(); ?>">
                                <td class="last"><input type="submit" value="<?php echo LANG_ADMIN_TABLE_SAVE; ?>" name="save" /></td>
                                </tr>
                            </table>
                        </form>
                        <p>&nbsp;</p>
                    </div>
                </div>
                <div id="right-column">
                    <strong class="h"><?php echo LANG_MSG_INFO; ?></strong>
                    <div class="box"><?php echo LANG_ADMIN_USERS_INFO; ?></div>
                </div>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>
