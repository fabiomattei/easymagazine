<?php

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

/*
------------------
Language: English
------------------
*/

// Page Title
define('LANG_ADMIN_TITLE', 'Easy Magazine Admin');

// Menu
define('LANG_MENU_DASHBOARD', 'Dashboard');
define('LANG_MENU_NUMBERS', 'Numbers');
define('LANG_MENU_CATEGORIES', 'Categories');
define('LANG_MENU_ARTICLES', 'Articles');
define('LANG_MENU_PAGES', 'Pages');
define('LANG_MENU_COMMENTS', 'Comments');
define('LANG_MENU_PLUGIN', 'Plugins');
define('LANG_MENU_TEMPLATE', 'Templates');
define('LANG_MENU_MOBILE_TEMPLATE', 'Mobile Templates');
define('LANG_MENU_SETTINGS', 'Settings');
define('LANG_MENU_USERS', 'Users');
define('LANG_MENU_USER', 'User');
define('LANG_MENU_LOGOUT', 'Logout');
define('LANG_MENU_SEARCH', 'Search');
define('LANG_MENU_GO', 'Go');

// Left Column

define('LANG_LEFT_GREETINGS', 'Hello');
define('LANG_LEFT_VIEW_WEBSITE', 'View the website');
define('LANG_LEFT_SHOW_ALL', 'Show All');
define('LANG_LEFT_SHOW_MY_ARTICLES', 'Show My Articles');
define('LANG_LEFT_SHOW_CAT_PUBLISHED', 'Show Published');
define('LANG_LEFT_SHOW_CAT_NOTPUBLISHED', 'Show Not Published');
define('LANG_LEFT_SHOW_NUM_PUBLISHED', 'Show Published');
define('LANG_LEFT_SHOW_NUM_NOTPUBLISHED', 'Show Not Published');
define('LANG_LEFT_SHOW_ALL_COMMENTS', 'View all comments');
define('LANG_LEFT_SHOW_MY_COMMENTS', 'View comments to my articles');

// MESSAGES

define('LANG_MSG_INFO', 'Info');
define('LANG_MSG_QUESTION', 'Question');
define('LANG_MSG_WARNING', 'Warning');
define('LANG_MSG_ERROR', 'Error');

// Admin Table

define('LANG_ADMIN_TABLE_NAME', 'Name');
define('LANG_ADMIN_TABLE_TITLE', 'Title');
define('LANG_ADMIN_TABLE_EDIT', 'Edit');
define('LANG_ADMIN_TABLE_UP', 'Up');
define('LANG_ADMIN_TABLE_DOWN', 'Down');
define('LANG_ADMIN_TABLE_PUBLISHED', 'Published');
define('LANG_ADMIN_TABLE_DELETE', 'Delete');
define('LANG_ADMIN_TABLE_NEW', 'New');
define('LANG_ADMIN_TABLE_SUBTITLE', 'Sub Title');
define('LANG_ADMIN_TABLE_SUMMARY', 'Summary');
define('LANG_ADMIN_TABLE_BODY', 'Body');
define('LANG_ADMIN_TABLE_CREATED', 'Created');
define('LANG_ADMIN_TABLE_UPDATED', 'Updated');
define('LANG_ADMIN_TABLE_DESCRIPTION', 'Description');
define('LANG_ADMIN_TABLE_SAVE', 'Save');
define('LANG_ADMIN_TABLE_REPLAY', 'Replay');
define('LANG_ADMIN_TABLE_NUMBER', 'Number');
define('LANG_ADMIN_TABLE_ARTICLE', 'Article');
define('LANG_ADMIN_TABLE_CATEGORY', 'Category');
define('LANG_ADMIN_TABLE_ARTICLES', 'Articles');
define('LANG_ADMIN_TABLE_COMMENTS', 'Comments');
define('LANG_ADMIN_TABLE_PREVIEW', 'Preview');
define('LANG_ADMIN_TABLE_ARTICLEAUTORS', 'Article Authors');
define('LANG_ADMIN_TABLE_AUTHORLINK', 'Link');
define('LANG_ADMIN_TABLE_AUTHORUNLINK', 'Unlink');
define('LANG_ADMIN_TABLE_UPDATED_ARTICLES', 'Updated Articles');
define('LANG_ADMIN_TABLE_UPDATED_COMMENTS', 'Updated Comments');
define('LANG_ADMIN_TABLE_INFO', 'Info');
define('LANG_ADMIN_TABLE_ADMIN', 'Admin');
define('LANG_ADMIN_TABLE_ACTIVATE', 'Activate');
define('LANG_ADMIN_TABLE_DEACTIVATE', 'Deactivate');
define('LANG_ADMIN_TABLE_ACTIVATED', 'Activated');
define('LANG_ADMIN_TABLE_LANGUAGE', 'Language');
define('LANG_ADMIN_TABLE_MAGAZINE_TITLE', 'Magazine Title');
define('LANG_ADMIN_TABLE_MAGAZINE_DESCRIPTION', 'Magazine Description');
define('LANG_ADMIN_TABLE_URLTYPE', 'URL Type');
define('LANG_ADMIN_TABLE_ROLE', 'Role');
define('LANG_ADMIN_TABLE_PUBLISHER', 'Publisher');
define('LANG_ADMIN_TABLE_JOURNALIST', 'Journalist');
define('LANG_ADMIN_TABLE_RIGHTS', 'Rights');
define('LANG_ADMIN_TABLE_ADMINISTRATION_EMAIL', 'Administration Email');
define('LANG_ADMIN_TABLE_EPUBFILENAME', 'Epub filename');
define('LANG_ADMIN_TABLE_WEBSITEURL', 'Website URL');
define('LANG_ADMIN_TABLE_FACEBOOK', 'Send to Facebook button');
define('LANG_ADMIN_TABLE_TWITTER', 'Send to Twitter button');
define('LANG_ADMIN_TABLE_USERNAME', 'Username');
define('LANG_ADMIN_TABLE_SHOW_IN_PEOPLE_PAGE', 'Show in People page');
define('LANG_ADMIN_TABLE_CHANGE_PASSWORD', 'Change Password');
define('LANG_ADMIN_TABLE_OLD_PASSWORD', 'Old Passwrd');
define('LANG_ADMIN_TABLE_NEW_PASSWORD', 'New Password');
define('LANG_ADMIN_TABLE_RETYPE_PASSWORD', 'Retype new Password');
define('LANG_ADMIN_TABLE_SIGNATURE', 'Signature');
define('LANG_ADMIN_TABLE_ON', 'On');
define('LANG_ADMIN_TABLE_OFF', 'Off');

// Admin Table Tooltips

define('LANG_ADMIN_TABLE_TIP_COMMENT', 'In order to allow the readers to comment an article, comments need to be activated in the article and in the corresponding number.');

// ADMIN INFO

define('LANG_ADMIN_PAGE_INFO', 'Here there is a list of all pages, published and not still published.');
define('LANG_ADMIN_ARTICLE_INFO', 'Here you can handle the articles of the magazine.
    You can create new articles or edit the one you have the right to edit for.');
define('LANG_ADMIN_CATEGORY_INFO', 'Here there is a list of all categories, you will need it to classify your articles.<br />
    An article belongs only to a category.<br />
    Only the published ones will be visible in the website.');
define('LANG_ADMIN_NUMBER_INFO', 'Here there is a list of all numbers, published and not still published.<br />
    You can modify the numbers order, clicking on the gree arrows (Up and Down).<br />
    In order to publish the epub file of a number, please, click in the corresponding Epub column.');
define('LANG_ADMIN_DASHBOARD_INFO', 'Here you can take a quick look on your magazine, the lists show the last Articles and Comments modifyed');
define('LANG_ADMIN_PLUGIN_INFO', 'Here there is a list of all plug-in.<br />
    You can download new plugins from www.easymagazine.org website, in order to install you need just to
    copy the new plugin folder in to the folder "contents/plug_in" than you can activate it
    clicking the green flag in the menu');
define('LANG_ADMIN_TEMPLATE_INFO', 'Here there is a list of all templates available for the website.
    You can download new templates from www.easymagazine.org website, in order to install you need just to
    copy the new template folder in to the folder "contents/templates" than you can activate it
    clicking the green flag in the menu');
define('LANG_ADMIN_SETTINGS_INFO', 'Here there is a list of settings to manage the magazine.');
define('LANG_ADMIN_USERS_INFO', 'Here there is a list of all user, their right to access the system and their personal informations.');
define('LANG_ADMIN_USER_INFO', 'Here you can handle your personal information.');
define('LANG_ADMIN_COMMENTS_INFO', 'Here there is a list of all comments.
    You can see approved comments and comment to approve.<br />
    You can approve a comment and eventualy respond to the comment.');

// Controller GENERAL

define('LANG_CON_GENERAL_YES', 'yes');
define('LANG_CON_GENERAL_NO', 'no');


// Controller ARTICLE

define('LANG_CON_ARTICLE_NO_MACH', 'No articles corresponding to search criteria');
define('LANG_CON_ARTICLE_DO_YOU_WANT_DELETE', 'Do you really want to delete the article: ');
define('LANG_CON_ARTICLE_DELETED', 'Article deleted');
define('LANG_CON_ARTICLE_DO_YOU_WANT_UNLINK', 'Do you really want to unlink the author ');
define('LANG_CON_ARTICLE_FROM_ARTICLE', ' from the article: ');
define('LANG_CON_ARTICLE_AUTHOR_UNLINKED', 'Author unlinked');
define('LANG_CON_ARTICLE_BEFORE_LINK', 'Before to link an article to a writer you need to save the article');
define('LANG_CON_ARTICLE_AUTHOR_LINKED', 'Author linked');
define('LANG_CON_ARTICLE_MOVED_UP', 'Article moved up in the list');
define('LANG_CON_ARTICLE_MOVED_DOWN', 'Article moved down in the list');
define('LANG_CON_ARTICLE_SAVED', 'Article saved');

// Controller CATEGORY

define('LANG_CON_CATEGORY_NO_MACH', 'No category corresponding to search criteria');
define('LANG_CON_CATEGORY_DO_YOU_WANT_DELETE', 'Do you really want to delete the category: ');
define('LANG_CON_CATEGORY_DELETED', 'Category deleted');
define('LANG_CON_CATEGORY_MOVED_UP', 'Category moved up in the list');
define('LANG_CON_CATEGORY_MOVED_DOWN', 'Category moved down in the list');
define('LANG_CON_CATEGORY_SAVED', 'Category saved');

// Controller COMMENT

define('LANG_CON_COMMENT_NO_MACH', 'No comment corresponding to search criteria');
define('LANG_CON_COMMENT_DO_YOU_WANT_DELETE', 'Do you really want to delete the comment: ');
define('LANG_CON_COMMENT_DELETED', 'Comment deleted');
define('LANG_CON_COMMENT_ASSOCIATED_ARTICLE', 'A comment must be associated to an article');
define('LANG_CON_COMMENT_SAVED', 'Comment saved');

// Controller NUMBER

define('LANG_CON_NUMBER_NO_MACH', 'No numbers corresponding to search criteria');
define('LANG_CON_NUMBER_DO_YOU_WANT_DELETE', 'Do you really want to delete the number: ');
define('LANG_CON_NUMBER_DELETED', 'Number deleted');
define('LANG_CON_NUMBER_EPUB_CREATED', 'Epub file created for number: ');
define('LANG_CON_NUMBER_MOVED_UP', 'Number moved up in the list');
define('LANG_CON_NUMBER_MOVED_DOWN', 'Number moved down in the list');
define('LANG_CON_NUMBER_SAVED', 'Number saved');

// Controller PAGE

define('LANG_CON_PAGE_NO_MACH', 'No page corresponding to search criteria');
define('LANG_CON_PAGE_DO_YOU_WANT_DELETE', 'Do you really want to delete the page: ');
define('LANG_CON_PAGE_DELETED', 'Page deleted');
define('LANG_CON_PAGE_MOVED_UP', 'Page moved up in the list');
define('LANG_CON_PAGE_MOVED_DOWN', 'Page moved down in the list');
define('LANG_CON_PAGE_SAVED', 'Page saved');

// Controller USER

define('LANG_CON_USER_PASSWORD_NO_MACH', 'Passwords do not match');
define('LANG_CON_USER_DO_YOU_WANT_DELETE', 'Do you really want to delete the user: ');
define('LANG_CON_USER_DELETED', 'User deleted');
define('LANG_CON_USER_PASSWORD_MODIFIED', 'Password successfully modified');
define('LANG_CON_USER_SAVED', 'User saved');
define('LANG_CON_USER_WITH_SAME_USERNAME', 'The username you chose is already used by somebody else');

// Router Comments

define('LANG_ROUTER_COMMENT_COMSAVED', 'Comment saved, it will be checked then published');
define('LANG_ROUTER_COMMENT_FILL_ALL_FIELDS', 'Fill all the fields please');
define('LANG_ROUTER_COMMENT_WRITE_CAPTCHA', 'Please type the right Captcha');
define('LANG_ROUTER_COMMENT_COM_NOT_ALLOWED', 'Comments not allowed');

// Router Search

define('LANG_ROUTER_SEARCH_RESULTS_FOR', 'Results for: ');
define('LANG_ROUTER_SEARCH_NO_RESULTS', 'No Results!');
define('LANG_ROUTER_SEARCH_RESULTS', 'Results: ');
define('LANG_ROUTER_SEARCH_NO_MATCHES', 'No Article matches with your search criteria');

// Paginator Results

define('LANG_PAGINATOR_FIRST', 'First');
define('LANG_PAGINATOR_LAST', 'Last');

// MONTHS

define('LANG_MONTH_JAN', 'January');
define('LANG_MONTH_FEB', 'February');
define('LANG_MONTH_MAR', 'March');
define('LANG_MONTH_APR', 'April');
define('LANG_MONTH_MAY', 'May');
define('LANG_MONTH_JUN', 'June');
define('LANG_MONTH_JUL', 'July');
define('LANG_MONTH_AUG', 'August');
define('LANG_MONTH_SEP', 'September');
define('LANG_MONTH_OCT', 'October');
define('LANG_MONTH_NOV', 'November');
define('LANG_MONTH_DEC', 'December');

// LOGIN NEW PASSWORD PAGE

define('LANG_LOGIN_NEW_PASSWORD_SENT', 'New password sent to your email, check it and try again.');
define('LANG_LOGIN_NEW_PASSWORD_FROM', 'New Password from');
define('LANG_LOGIN_DEAR', 'Dear');
define('LANG_LOGIN_NEW_PASSWORD_IS', 'your new password is');
define('LANG_LOGIN_USERNAME_PASSWORD_WRONG', 'Username or password wrong');
define('LANG_LOGIN_TRY_AGAIN', 'Click here in order to try again');
define('LANG_LOGIN_MESSAGE', 'If you lost your password please type your username and email and you will recevive a new password.');
define('LANG_LOGIN_LOGOUT_DONE', 'Logout done!');
define('LANG_LOGIN_CLICK_TO_LOGIN', 'Click me if you need to login');
define('LANG_LOGIN_TITLE_LOGIN', 'Easy Magazine: Administration Login Page');
define('LANG_LOGIN_TITLE_LOGOUT', 'Easy Magazine: Administration Logout page');
define('LANG_LOGIN_TITLE_ERROR', 'Easy Magazine: Login Error Page');
define('LANG_LOGIN_TITLE_PASSWORD_SEND', 'Easy Magazine: Password Sending Page');

// PREVIEW

define('LANG_PREVIEW_BACK_BUTTON', 'Back to the administration');

?>