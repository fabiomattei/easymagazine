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

class Taghandler {

    /**
     * This method trasforms the input string, containing a list of comma separated tags,
     * in a string cotaining all necessary links for the website.
     *
     * @param <string> $tags
     * @return string
     */
    public static function tagsToLink($tags) {
        $tags = trim($tags);

        $arraytag = preg_split('/,/', $tags);
        $out = '';
        foreach ($arraytag as $singleTag) {
            $singleTag = trim($singleTag);
            $link = URIMaker::tag($singleTag);
            $out .= '<a href="'.$link.'" Title="'.$singleTag.'">'.$singleTag.'</a> ';
        }
        return $out;
    }

}

?>