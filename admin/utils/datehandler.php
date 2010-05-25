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

class DateHandler {

    public static function DataFormat($date) {
        $out = date("j",strtotime($date));
        $month = date("m",strtotime($date));
        switch ($month) {
            case '01': $out .= " ".LANG_MONTH_JAN; break;
            case '02': $out .= " ".LANG_MONTH_FEB; break;
            case '03': $out .= " ".LANG_MONTH_MAR; break;
            case '04': $out .= " ".LANG_MONTH_APR; break;
            case '05': $out .= " ".LANG_MONTH_MAY; break;
            case '06': $out .= " ".LANG_MONTH_JUN; break;
            case '07': $out .= " ".LANG_MONTH_JUL; break;
            case '08': $out .= " ".LANG_MONTH_AUG; break;
            case '09': $out .= " ".LANG_MONTH_SEP; break;
            case '10': $out .= " ".LANG_MONTH_OCT; break;
            case '11': $out .= " ".LANG_MONTH_NOV; break;
            case '12': $out .= " ".LANG_MONTH_DEC; break;
        }
        $out .= " ".date("Y",strtotime($date));
        return $out;
    }

    public static function convertMySqlDateTimeToUnixTime($date) {
        return strtotime($date);
    }

}

?>