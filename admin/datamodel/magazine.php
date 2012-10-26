<?php

/*
	Copyright (C) 2009-2012  Fabio Mattei <burattino@gmail.com>

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

require_once(STARTPATH.SYSTEMPATH.'settings.php');
require_once(STARTPATH.DATAMODELPATH.'option.php');

class Magazine {

    public static function getMagazineTitle() {
        return TITLE;
    }

    public static function getMagazineDescription() {
        return DESCRIPTION;
    }

    public static function getMagazinePublisher() {
        return PUBLISHER;
    }

    public static function getMagazineRights() {
        return RIGHTS;
    }

    public static function getMagazineLanguage() {
        return LANGUAGE;
    }

    public static function getEpubName() {
        return EPUBNAME;
    }

    public static function getWebSiteURL() {
        return WEBSITEURL;
    }

    public static function getAdministrationEmail() {
        $email = Option::findFirstByNameAndType('email', 'settings');
        return $email->getValue();
    }
}

?>