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

define('STARTPATH', '../');

class ImageFiles {

    public static function savefile($date, $file) {
        if (!$file['error']) {
            $path = checkAndCreatePath($date);
            move_uploaded_file($file['tmp_name'], $path.'/'.$file['name']);
        }
    }

    public static function deletefile($date, $filename) {
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        $completepath = STARTPATH.'/contents/img/'.$year.'/'.$month.'/'.$day.'/'.$filename;
        if (file_exists($completepath)) {
            unlink($completepath);
        }
    }

    public static function fileexixts($date, $filename) {
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        $completepath = STARTPATH.'/contents/img/'.$year.'/'.$month.'/'.$day.'/'.$filename;
        return file_exists($completepath);
    }

    public static function imagepath($date, $filename) {
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        $completepath = STARTPATH.'/contents/img/'.$year.'/'.$month.'/'.$day.'/'.$filename;
        return $completepath;
    }

    public static function checkAndCreatePath($date) {
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        if (!file_exists(STARTPATH.'/contents/img/'.$year)) { 
            mkdir(STARTPATH.'contents/img/'.$year);
        }
        if (!file_exists(STARTPATH.'/contents/img/'.$year.'/'.$month)) {
            mkdir(STARTPATH.'contents/img/'.$year.'/'.$month);
        }
        if (!file_exists(STARTPATH.'/contents/img/'.$year.'/'.$month.'/'.$day)) {
            mkdir(STARTPATH.'contents/img/'.$year.'/'.$month.'/'.$day);
        }
        return STARTPATH.'contents/img/'.$year.'/'.$month.'/'.$day;
    }

}

?>
