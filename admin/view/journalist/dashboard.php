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
                    <li class="active"><span><span>Dashboard</span></span></li>
                    <li><span><span><a href="number.php">Numbers</a></span></span></li>
                    <li><span><span><a href="article.php">Articles</a></span></span></li>
                    <li><span><span><a href="page.php">Pages</a></span></span></li>
                    <li><span><span><a href="comment.php">Comments</a></span></span></li>
                    <li><span><span><a href="plugin.php">Plugin</a></span></span></li>
                    <li><span><span><a href="template.php">Template</a></span></span></li>
                    <li><span><span><a href="user.php">Users</a></span></span></li>
                </ul>
            </div>
            <div id="middle">
                <div id="left-column">
                    <h3>Hello, <? echo $_SESSION['user']->getName() ?></h3><br />
                    <a href="#" class="link">View the website</a>
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
                                <th class="first">Updated Articles</th>
                                <th width="80">Edit</th>
                                <th class="last" width="80">Published</th>
                            </tr>

                            <?
                            foreach ($arts as $ar) {
                                ?>
                            <tr>
                                <td class="first style1"><? echo $ar->getTitle(); ?></td>
                                <td><a href="article.php?action=edit&id=<? echo $ar->getId(); ?>"><img src="../../resources/img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
                                <td class="last">
                                    <? if ($ar->getPublished()) { ?>
                                    <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                    <? } else { ?>
                                    <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                    <? } ?>

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
                                <th class="first">Last comments</th>
                                <th width="80">Edit</th>
                                <th class="last" width="80">Published</th>
                            </tr>

                            <?
                            foreach ($comms as $ar) {
                                ?>
                            <tr>
                                <td class="first style1"><? echo $ar->getTitle(); ?></td>
                                <td><a href="comment.php?action=edit&id=<? echo $ar->getId(); ?>"><img src="../../resources/img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
                                <td class="last">
                                    <? if ($ar->getPublished()) { ?>
                                        <img src="../../resources/img/tic.png" width="16" height="16" alt="save" />
                                    <? } else { ?>
                                        <img src="../../resources/img/cross.png" width="16" height="16" alt="save" />
                                    <? } ?>
                                </td>
                            </tr>
                            <?
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div id="right-column">
                    <strong class="h">INFO</strong>
                    <div class="box">Here you can take a quick look on your magazine, the lists show the last Articles and Comments modifyed  </div>
                </div>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>
