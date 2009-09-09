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

require_once(STARTPATH.LIBPATH.PCLZIPPATH.'pclzip.lib.php');
require_once(STARTPATH.DATAMODELPATH.'magazine.php');

class ePugCreator {

    private $epubfilename;
    private $epubFolderName;
    private $number;

    /**
     * This method handles the complete publication of an epub file related
     * to a number.
     *
     * @param Number $number
     */
    public function writeEPugForNumber($number) {
        $this->number = $number;
        $this->epubfilename = STARTPATH.EPUBSPATH.'number_'.$number->getId().'.epub';
        $this->epubFolderName = STARTPATH.EPUBSPATH.'number_'.$number->getId().'/';

        $this->cleanNumber($number);

        $this->createFolder($this->epubFolderName);

        $this->writeMimeTypeFile();
        $this->writeContentOPFFile();
        $this->writecoverxhtmlFile();
        // creates all files

        $this->zipFolder($this->epubFolderName);

        $this->deleteFolder($this->epubFolderName);
    }

    /**
     * This method deletes an existing epug publication of the number
     *
     * @param Number $number
     */
    private function cleanNumber($number) {
        if (file_exists($this->epubfilename)) {
            unlink($this->epubfilename);
        }
    }

    /**
     * This method creates the folder to contains all files needed by epub
     * file format
     *
     * @param String $dir (The folder name)
     */
    private function createFolder($dir) {
        mkdir($dir, 0700);
    }

    /**
     * This method zips all files in the folder and creates
     * the epub file
     *
     */
    private function zipFolder() {
        $archive = new PclZip($this->epubfilename);
        $v_list = $archive->add($this->epubFolderName, PCLZIP_OPT_REMOVE_PATH, STARTPATH.EPUBSPATH);
    }

    /**
     * This method deletes a folder with all tree contained
     * NB. $dir must end with a /.
     *
     * @param String $dir
     * @return the exit code of rmdir
     */
    private function deleteFolder($dir) {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir) || is_link($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!$this->deleteFolder($dir . "/" . $item)) {
                chmod($dir . "/" . $item, 0777);
                if (!$this->deleteFolder($dir . "/" . $item)) return false;
            };
        }
        return rmdir($dir);
    }

    public function writeMimeTypeFile() {
        $filename = $this->epubFolderName.'mimetype';

        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "Cannot open file ($filename)";
            exit;
        }

        ePugCreator::write($handle, 'application/epub+zip');

        fclose($handle);
    }

    public function writeContentOPFFile() {
        $filename = $this->epubFolderName.'content.opf';

        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "Cannot open file ($filename)";
            exit;
        }

        $text = '<?xml version="1.0" encoding="UTF-8"?>
<package xmlns="http://www.idpf.org/2007/opf" version="2.0" unique-identifier="PragmaticBook">
  <metadata xmlns:opf="http://www.idpf.org/2007/opf" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <dc:language>en</dc:language>
    <dc:title>'.$this->number->getTitle().'</dc:title>
    <dc:publisher>'.Magazine::getMagazinePublisher().'</dc:publisher>
    <dc:rights>'.Magazine::getMagazineRights().'</dc:rights>
    <meta name="cover" content="cover-image"/>
  </metadata>
  <manifest>
    <item id="bookshelf-css" href="css/bookshelf.css" media-type="text/css"/>
    <item id="book_local-css" href="css/book_local.css" media-type="text/css"/>
    <item id="pt" href="page-template.xpgt" media-type="application/vnd.adobe-page-template+xml"/>
    <item id="cover" href="cover.xhtml" media-type="application/xhtml+xml"/>
    <item id="cover-image" href="images/cover.jpg" media-type="image/jpeg"/>
    <item id="joe-image" href="images/joe.jpg" media-type="image/jpeg"/>
    <item id="wiggly-image" href="images/WigglyRoad.jpg" media-type="image/jpeg"/>
    <item id="ncx" href="toc.ncx" media-type="application/x-dtbncx+xml"/>';

    foreach ($this->number->articles() as $article) {
            $text.='<item id="article'.$article->getId().'" href="article'.$article->getId().'.html" media-type="application/xhtml+xml" />
            ';
            if ($article->imageExists()) {
                $text.='<item id="img'.$article->getId().'" href="images/fading-jars.jpg" media-type="image/jpeg"/>';
            }
        }

    $text .= '  <spine toc="ncx">
    <itemref idref="cover" linear="no"/>
';
        foreach ($this->number->articles() as $article) {
            $text.='<itemref idref="article'.$article->getId().'" />
            ';
        }

  $text .= '</spine>
  <guide>
    <reference type="cover" title="Cover" href="cover.xhtml"/>
  </guide>
</package>
';

        ePugCreator::write($handle, $text);

        fclose($handle);
    }

    public function writecoverxhtmlFile() {
        $filename = $this->epubFolderName.'cover.xhtml';

        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "Cannot open file ($filename)";
            exit;
        }

        $text = '<?xml version="1.0" encoding="UTF-8" ?>
<!DOCTYPE html PUBLIC
	  "-//W3C//DTD XHTML 1.1//EN"
	  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
  <head>
    <title>'.$this->number->getTitle().'</title>
    <link rel="stylesheet" href="css/bookshelf.css" type="text/css" />
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  </head>
  <body>
    <div>
      <img src="images/cover.jpg"
	   alt="'.Magazine::getMagazinePublisher().'"
	   title="'.$this->number->getTitle().'" />
    </div>
  </body>
</html>';

        ePugCreator::write($handle, $text);

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