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

class AllControllersCommons {

    public static function loadlanguage() {
        if (file_exists('costants.php')) {
            $pathlang = '';
        } elseif (file_exists('../costants.php')) {
            $pathlang = '../';
        } elseif (file_exists('../../costants.php')) {
            $pathlang = '../../';
        } elseif (file_exists('../../../costants.php')) {
            $pathlang = '../../../';
        }

        require_once($pathlang.'costants.php');
        require_once($pathlang.SYSTEMPATH.'settings.php');

        switch (LANGUAGE) {
            case 'en':
                $lang_file = 'en.php';
                break;

            case 'it':
                $lang_file = 'it.php';
                break;

            case 'pt':
                $lang_file = 'pt.php';
                break;

            default:
                $lang_file = 'en.php';

        }

        require_once($pathlang.LANGUAGESPATH.$lang_file);
    }

}

?>
