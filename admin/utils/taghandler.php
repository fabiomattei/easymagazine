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

    public static function tagsToLink($tags) {
        //REMOVE BEGINNING AND ENDING SPACES
        $tags = trim($tags);

        // TODO: Check split string function with PHP 5.3
        $arraytag = split(' ', $tags);
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