<?php

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

class Pagination {

    public static function calculatePageNumbers($num_results) {
        if ($num_results == 0) return 1;
        $remainder = $num_results % 10;
        if ($remainder == 0) $num_pages = $num_results/10;
        else $num_pages = intval($num_results/10 + 1);
        return $num_pages;
    }

}

?>
