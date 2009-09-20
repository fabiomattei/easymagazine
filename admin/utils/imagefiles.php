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

class ImageFiles {

    public static function savefile($date, $file) {
        if (!$file['error']) {
            $path = ImageFiles::checkAndCreatePath($date);
            move_uploaded_file($file['tmp_name'], $path.'/'.$file['name']);
        }
    }

    public static function deletefile($date, $filename) {
        if (file_exists(ImageFiles::filepath($date, $filename)) && $filename != '') {
            unlink(ImageFiles::filepath($date, $filename));
        }
    }

    public static function fileexists($date, $filename) {
        return file_exists(ImageFiles::filepath($date, $filename));
    }

    public static function filepath($date, $filename) {
        $completepath = STARTPATH.'contents/img/'.ImageFiles::fileShortPath($date, $filename);
        return $completepath;
    }

    public static function fileShortPath($date, $filename) {
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        $shortPath = $year.'/'.$month.'/'.$day.'/'.$filename;
        return $shortPath;
    }

    public static function checkAndCreatePath($date) {
        return ImageFiles::checkAndCreatePathFromPath($date, STARTPATH.'contents/img/');
    }

    public static function checkAndCreatePathFromPath($date, $path) {
        $year = substr($date, 0, 4);
        $month = substr($date, 5, 2);
        $day = substr($date, 8, 2);
        if (!file_exists($path.$year)) {
            mkdir($path.$year);
        }
        if (!file_exists($path.$year.'/'.$month)) {
            mkdir($path.$year.'/'.$month);
        }
        if (!file_exists($path.$year.'/'.$month.'/'.$day)) {
            mkdir($path.$year.'/'.$month.'/'.$day);
        }
        return $path.$year.'/'.$month.'/'.$day;
    }

    /**
     * Finds the extention of a file
     *
     * @param <String> $filename
     * @return <String>
     */
    public static function findexts($filename) {
        $filename = strtolower($filename) ;
        $exts = split("[/\\.]", $filename) ;
        $n = count($exts)-1;
        $exts = $exts[$n];
        return $exts;
    }

    /**
     * Returns the right mime tipe for an image discovering
     * the type from the name
     *
     * @param <type> $filename
     * @return <type>
     */
    public static function mimetype($filename) {
        $type = ImageFiles::findexts($filename);
        $out = '';
        if ($type == 'jpg' || $type == 'jpeg') $out = 'image/jpeg';
        if ($type == 'gif') $out = 'image/gif';
        if ($type == 'png') $out = 'image/png';
        return $out;
    }

}

?>