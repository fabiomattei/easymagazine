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

class FileWriter {

    public static function writePlugInIncluder($dirList) {
        $filename = STARTPATH.'system/pluginIncluder.php';

        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "Cannot open file ($filename)";
            exit;
        }

        FileWriter::write($handle, '<?PHP ');

        foreach ($dirList as $key => $value) {
            $toWrite = ' require_once(PLUGINPATH.\''.$key.'/index.php\'); ';
            FileWriter::write($handle, $toWrite);
        }

        FileWriter::write($handle, ' ?>');

        fclose($handle);
    }

    public static function writeTemplateIncluder($dir) {
        $filename = STARTPATH.'system/templateIncluder.php';

        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "Cannot open file ($filename)";
            exit;
        }

        FileWriter::write($handle, '<?PHP ');

        $toWrite = ' define(\'TEMPLATEPATH\', \'contents/templates/'.$dir.'/\'); ';
        FileWriter::write($handle, $toWrite);

        FileWriter::write($handle, ' ?>');

        fclose($handle);
    }

    public static function writeSettingsFile($settingsindb) {
        $filename = STARTPATH.'system/settings.php';

        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "Cannot open file ($filename)";
            exit;
        }

        FileWriter::write($handle, '<?PHP ');

        $toWrite = ' define(\'TITLE\', \''.$settingsindb['title']->getValue().'\'); ';
        FileWriter::write($handle, $toWrite);
        $toWrite = ' define(\'DESCRIPTION\', "'.$settingsindb['description']->getValue().'"); ';
        FileWriter::write($handle, $toWrite);
        $toWrite = ' define(\'URLTYPE\', \''.$settingsindb['urltype']->getValue().'\'); ';
        FileWriter::write($handle, $toWrite);
        $toWrite = ' define(\'PUBLISHER\', \''.$settingsindb['publisher']->getValue().'\'); ';
        FileWriter::write($handle, $toWrite);
        $toWrite = ' define(\'RIGHTS\', \''.$settingsindb['rights']->getValue().'\'); ';
        FileWriter::write($handle, $toWrite);

        FileWriter::write($handle, ' ?>');

        fclose($handle);
    }

    private static function write($handle, $toWrite) {
        if (fwrite($handle, $toWrite) === FALSE) {
            echo "Cannot write to file ($filename)";
            exit;
        }
    }

}

?>