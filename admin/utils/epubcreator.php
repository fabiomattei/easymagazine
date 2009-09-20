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

    public function __construct($number) {
        $this->number = $number;
        $this->epubfilename = STARTPATH.EPUBSPATH.'number_'.$number->getId().'.epub';
        $this->epubFolderName = STARTPATH.EPUBSPATH.'number_'.$number->getId().'/';
    }

    /**
     * This method handles the complete publication of an epub file related
     * to a number.
     *
     * @param Number $number
     */
    public function writeEPubForNumber() {
        $this->cleanNumber($this->number);

        $this->createFolder($this->epubFolderName);
        $this->createFolder($this->epubFolderName.'META-INF/');
        $this->createFolder($this->epubFolderName.'images/');

        $this->writeMimeTypeFile();
        $this->writeContentOPFFile();
        $this->writecoverxhtmlFile();
        $this->writecontainerXmlFile();
        $this->writetocncxFile();
        $this->writetochtmlFile();
        $this->writeStyleCssFile();
        $this->writeArticlesFile();

        $this->zipFolder($this->epubFolderName);

        $this->deleteFolder($this->epubFolderName);
    }

    /**
     * This method checks if there is an epub pubblication for
     * the number
     *
     * @param Number $number
     */
    public function fileEPubExistsForNumber() {
        return file_exists($this->epubfilename);
    }

    /**
     * This method returns the path of the Epub pubblication
     * of the number
     *
     * @param Number $number
     */
    public function pathFileEPugForNumber() {
        return $this->epubfilename;
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
<package xmlns="http://www.idpf.org/2007/opf" version="2.0" unique-identifier="BookId">
  <metadata xmlns:opf="http://www.idpf.org/2007/opf" xmlns:dc="http://purl.org/dc/elements/1.1/">
    <dc:language>en</dc:language>
    <dc:title>'.$this->number->getTitle().'</dc:title>
    <dc:publisher>'.Magazine::getMagazinePublisher().'</dc:publisher>
    <dc:rights>'.Magazine::getMagazineRights().'</dc:rights>
    <dc:creator>Author contentopf file</dc:creator>
    <dc:date>2009-09-15</dc:date>
    <dc:subject>Fiction</dc:subject>
    <dc:identifier id="BookId">web-books-12345</dc:identifier>
  </metadata>
  <manifest>
    <item id="ncx" href="toc.ncx" media-type="application/x-dtbncx+xml" />
    <item id="cover" href="cover.xhtml" media-type="application/xhtml+xml" />
    <item id="WTOC" href="TOC.html" media-type="application/xhtml+xml" />
    <item id="style" href="style.css" media-type="text/css" />';

        if ($this->number->imageExists()) {
            $target = $this->number->imagePath();
            ImageFiles::checkAndCreatePathFromPath($this->number->getCreated(), $this->epubFolderName.'images/');
            $link = $this->epubFolderName.'images/'.ImageFiles::fileShortPath($this->number->getCreated(), $this->number->getImgfilename());
            copy($target, $link);
            $text.='<item id="imgn'.$this->number->getId().'" href="images/'.ImageFiles::fileShortPath($this->number->getCreated(), $this->number->getImgfilename()).'.jpg" media-type="'.ImageFiles::mimetype($this->number->imagePath()).'"/>';
        }

        foreach ($this->number->articles() as $article) {
            $text.='<item id="article'.$article->getId().'" href="article'.$article->getId().'.html" media-type="application/xhtml+xml" />
            ';
            if ($article->imageExists()) {
                $target = $article->imagePath();
                ImageFiles::checkAndCreatePathFromPath($article->getCreated(), $this->epubFolderName.'images/');
                $link = $this->epubFolderName.'images/'.ImageFiles::fileShortPath($article->getCreated(), $article->getImgfilename());
                copy($target, $link);
                $text.='<item id="img'.$article->getId().'" href="images/'.ImageFiles::fileShortPath($article->getCreated(), $article->getImgfilename()).'.jpg" media-type="'.ImageFiles::mimetype($this->number->imagePath()).'"/>';
            }
        }

        $text .= '</manifest>
<spine toc="ncx">
    <itemref idref="cover" />
';
        foreach ($this->number->articlesPublished() as $article) {
            $text.='<itemref idref="article'.$article->getId().'" />
            ';
        }

        $text .= '</spine>
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
<link rel="stylesheet" href="style.css" type="text/css" />
  <head>
    <title>'.$this->number->getTitle().'</title>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
  </head>
  <body>
    <p class="CENTER">
      ';
        if ($this->number->imageExists()) {
            $text.='<img src="images/'.ImageFiles::fileShortPath($this->number->getCreated(), $this->number->getImgfilename()).'" />';
        }
        $text.='
    </p>
  </body>
</html>';

        ePugCreator::write($handle, $text);

        fclose($handle);
    }

    public function writecontainerXmlFile() {
        $filename = $this->epubFolderName.'META-INF/container.xml';

        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "Cannot open file ($filename)";
            exit;
        }

        $text = '<?xml version="1.0"?>
<container version="1.0" xmlns="urn:oasis:names:tc:opendocument:xmlns:container">
  <rootfiles>
    <rootfile full-path="OPS/content.opf" media-type="application/oebps-package+xml" />
  </rootfiles>
</container>';

        ePugCreator::write($handle, $text);

        fclose($handle);
    }

    public function writeStyleCssFile() {
        $filename = $this->epubFolderName.'style.css';

        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "Cannot open file ($filename)";
            exit;
        }

        $text = 'body { text-align: justify; }
div.header { color: black; margin-top: 1.5em; margin-bottom: 1.5em; border-bottom: 1px solid black;  text-align: center; }
a { text-decoration: none }
p { text-indent: 4% }
p.noindent { text-indent: 0% }
h4 { color: black; font-size: large; font-weight: bold; text-indent: 0%; margin-top: 1.5em; margin-bottom: 1.5em;}
h5 { font-size: medium; font-weight: bold; text-indent: 0%; margin-top: 1.5em; margin-bottom: 1.5em;}
h6 { font-size: medium; font-weight: bold; text-indent: 0%; margin-top: 1.5em; margin-bottom: 1.5em; text-align: center;}
.CENTER { text-align: center;  text-indent: 0em; }
.RIGHT { text-align: right; }
.center { text-align: center;  text-indent: 0em; }
.right { text-align: right; }
.small { font-size: small; }
.large { font-size: large; }
    .smcap    { font-variant: small-caps;}
    .figcenter   {	text-align: center;  margin-top: 2em; margin-bottom: 2em;  text-indent: 0em;}
    .caption { font-size: small;  text-indent: 0%; text-align: center }
    hr { width: 33%; text-align: center  }
table.cell {
	border-width: 3px;
	border-style: outset;
	border-color: green;
	border-collapse: collapse;
	margin-left: auto;
	margin-right: auto;
	margin-top: 1.5em;
	margin-bottom: 1.5em;
}
table.cell td {
	border-width: 1px;
	padding: 10px;
	border-style: inset;
	border-color: red;
	text-align: center;
}';

        ePugCreator::write($handle, $text);

        fclose($handle);
    }

    public function writetocncxFile() {
        $filename = $this->epubFolderName.'toc.ncx';

        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "Cannot open file ($filename)";
            exit;
        }

        $text = '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE ncx PUBLIC "-//NISO//DTD ncx 2005-1//EN" "http://www.daisy.org/z3986/2005/ncx-2005-1.dtd">
<ncx xmlns="http://www.daisy.org/z3986/2005/ncx/" xml:lang="en" version="2005-1">
  <head>
      <meta name="dtb:uid" content="web-books-12345" />
      <meta name="dtb:depth" content="2" />
      <meta name="dtb:totalPageCount" content="0" />
      <meta name="dtb:maxPageNumber" content="0" />
   </head>
    <docTitle>
         <text>'.$this->number->getTitle().'</text>
    </docTitle>
  <navMap>';


        foreach ($this->number->articlesPublished() as $article) {
            $text .= '<navPoint id="navpoint-'.$article->getId().'" playOrder="'.$article->getId().'">
      <navLabel>
        <text>'.$article->getTitle().'</text>
      </navLabel>
        <content src="article'.$article->getId().'.html" />
    </navPoint>';
        }
        $text.='</navMap>
            </ncx>';

        ePugCreator::write($handle, $text);

        fclose($handle);
    }

    public function writetochtmlFile() {
        $filename = $this->epubFolderName.'TOC.html';

        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "Cannot open file ($filename)";
            exit;
        }

        $text = '<?xml version="1.0" encoding="utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta name="generator" content="Web Books Publishing" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>'.$this->number->getTitle().'</title>
</head>
<body>';
      foreach ($this->number->articlesPublished() as $article) {
            $text .= '<p><a href=\'article'.$article->getId().'.html\'>'.$article->getTitle().'</a></p>';
        }

$text .= '
</body>
</html>';

        ePugCreator::write($handle, $text);

        fclose($handle);
    }

    public function writeArticlesFile() {
        foreach ($this->number->articlesPublished() as $article) {
            $filename = $this->epubFolderName.'article'.$article->getId().'.html';

            $handle = fopen($filename, 'w');
            if (!$handle) {
                echo "Cannot open file ($filename)";
                exit;
            }

            $text = '<?xml version="1.0" encoding="utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta name="generator" content="Web Books Publishing" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>'.$article->getTitle().'</title>
</head>

<body>
	<div class="header">
	     <h2>'.$article->getTitle().'</h2>
	</div>';
            if ($article->imageExists()) {
                $text.='<img src="images/'.ImageFiles::fileShortPath($article->getCreated(), $article->getImgfilename()).'" />';
            }
            $text.='<div>'.$article->getSummary().'<br /><br />'.$article->getBody().'
</div>
</body>
</html>';

            ePugCreator::write($handle, $text);

            fclose($handle);
        }
    }

    private static function write($handle, $toWrite) {
        if (fwrite($handle, $toWrite) === FALSE) {
            echo "Cannot write to file ($filename)";
            exit;
        }
    }

}

?>