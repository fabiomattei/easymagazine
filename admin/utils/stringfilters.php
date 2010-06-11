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

class StringFilter {

    public static function removeTags($string) {
        return strip_tags($string, '<p><b><i><strong><em><span><il><ul><ol><table><td><th><tr>');
    }

    public static function removeTagsStrict($string) {
        return strip_tags($string, '<b><i><strong><em><span><il><ul><ol>');
    }

    /**
     * This method creates a clean string that doesn't create confusion in
     * the URL of the website.
     *
     * @param <String> $text
     * @return <String>
     */
    public static function cleanStringForUrl($text) {
        //REMOVE BEGINNING AND ENDING SPACES
        $text = trim($text);
        //CLEAN OUT ALL NON-ALPHA NUMERICAL CHARACTERS
        $out = preg_filter("/[^A-Za-z0-9]/", '_', $text);

        return $out;
    }

}

?>
