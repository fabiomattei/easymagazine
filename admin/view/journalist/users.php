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
        <title>Easy Magazine Admin: User</title>
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
                    <li><span><span><a href="article.php">Articles</a></span></span></li>
                    <li><span><span><a href="comment.php">Comments</a></span></span></li>
                    <li class="active"><span><span>Users</span></span></li>
                </ul>
                <div id="logout"><a href="../../logout.php">logout</a></div>
            </div>
            <div id="middle">
                <div id="left-column">
                    <h3>Hello, <? echo $_SESSION['user']->getName() ?></h3><br />
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

                        <table class="listing form" cellpadding="0" cellspacing="0">
                            <form name="form1" enctype="multipart/form-data" method="post" action="user.php?action=save">
                                <tr>
                                    <th class="full" colspan="2">Edit</th>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong>Name</strong></td>
                                    <td class="last"><input type="text" size="50" name="Name" value="<? echo $userp->getName(); ?>"/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Username</strong></td>
                                    <td class="last"><input type="text" size="50" name="Username" value="<? echo $userp->getUsername(); ?>"/></td>
                                </tr>                    <tr>
                                    <td class="first" colspan="2"><strong>Body</strong><br />
                                        <script src="../../../lib/textileeditor/teh/javascripts/prototype.js" type="text/javascript"></script>
                                        <textarea cols="40" id="article_body" name="Body" rows="20" style="width: 500px; padding: 5px"><? echo $userp->getUnfilteredBody(); ?></textarea>
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
                                    <td class="first" width="172"><strong>Email</strong></td>
                                    <td class="last"><input type="text" size="50" name="Email" value="<? echo $userp->getEmail(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>MSN</strong></td>
                                    <td class="last"><input type="text" size="50" name="MSN" value="<? echo $userp->getMsn(); ?>"/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first" width="172"><strong>Skype</strong></td>
                                    <td class="last"><input type="text" size="50" name="Skype" value="<? echo $userp->getSkype(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>Show Image</strong></td>
                                    <td class="last">
                                        <? if ($userp->imageExists()) { ?>
                                        <img src="<? echo $userp->imagePath(); ?>"
                                             <a href="page.php?action=deleteimg&id=<? echo $userp->getId(); ?>">Delete image</a>
                                             <? } else { ?>
                                        &nbsp;
                                        <? } ?>
                                    </td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Image File</strong></td>
                                    <td class="last"><input type="file" name="Image" value="" /></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>Image file name:</strong></td>
                                    <td class="last"><? echo $userp->getImgfilename(); ?></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Image Alternative Text:</strong></td>
                                    <td class="last"><input type="text" size="50" name="ImageAlt" value="<? echo $userp->getImgAlt(); ?>"/></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>Image Caption:</strong></td>
                                    <td class="last"><input type="text" size="50" name="ImageCaption" value="<? echo $userp->getImgCaption(); ?>"/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>Created:</strong></td>
                                    <td class="last"><? echo $userp->getCreated(); ?></td>
                                </tr>
                                <tr>
                                    <td class="first"><strong>Updated:</strong></td>
                                    <td class="last"><? echo $userp->getUpdated(); ?></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>&nbsp;</strong></td>
                                <input type="hidden" name="id" value="<? echo $userp->getId(); ?>">
                                <input type="hidden" name="created" value="<? echo $userp->getCreated(); ?>">
                                <input type="hidden" name="updated" value="<? echo $userp->getUpdated(); ?>">
                                <input type="hidden" name="Password" value="<? echo $userp->getPassword(); ?>">
                                <td class="last">
                                    <input type="submit" value="Save" name="save" />
                            </form>
                            </td>
                            </tr>
                        </table>
                        <br />
                        <table class="listing form" cellpadding="0" cellspacing="0">
                            <form name="form1" enctype="multipart/form-data" method="post" action="user.php?action=savePassword">
                                <tr>
                                    <th class="full" colspan="2">Change Password</th>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong>Old Passwrd</strong></td>
                                    <td class="last"><input type="password" name="OldPassword" value=""/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>New Password</strong></td>
                                    <td class="last"><input type="password" name="NewPassword1" value=""/></td>
                                </tr>
                                <tr>
                                    <td class="first" width="172"><strong>Retype new Password</strong></td>
                                    <td class="last"><input type="password" name="NewPassword2" value=""/></td>
                                </tr>
                                <tr class="bg">
                                    <td class="first"><strong>&nbsp;</strong></td>
                                <input type="hidden" name="id" value="<? echo $userp->getId(); ?>">
                                <input type="hidden" name="created" value="<? echo $userp->getCreated(); ?>">
                                <input type="hidden" name="updated" value="<? echo $userp->getUpdated(); ?>">
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
                    <div class="box">Here there is a list of all user and their informations.</div>
                </div>
            </div>
            <div id="footer"></div>
        </div>
    </body>
</html>
