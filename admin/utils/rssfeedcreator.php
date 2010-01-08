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

require_once(STARTPATH.LIBPATH.FEEDCREATORPATH.'feedcreator.class.php');
require_once(STARTPATH.SYSTEMPATH.'settings.php');
require_once(STARTPATH.UTILSPATH.'datehandler.php');
if (URLTYPE == 'optimized') {
    require_once(STARTPATH.URIPATH.'urimakeroptimized.php');
} else {
    require_once(STARTPATH.URIPATH.'urimakerstandard.php');
}

class rssFeedCreator {

    public static function updatefeed() {
        $outFile = STARTPATH.'contents/feed/feed.xml';

        $rss = new UniversalFeedCreator();
        $rss->useCached();
        $rss->title = Magazine::getMagazineTitle();
        $rss->description = Magazine::getMagazineDescription();
        $rss->link = URIMaker::fromBasePath('');
        $rss->syndicationURL = $outFile;

        // $image = new FeedImage();
        // $image->title = Magazine::getMagazineTitle()." logo";
        // $image->url = "http://www.dailyphp.net/images/logo.gif";
        // $image->link = $_SERVER['HTTP_HOST'].FOLDER;
        // $image->description = 'Feed provided by '.Magazine::getMagazineTitle().' Click to visit.';
        // $rss->image = $image;

        $numbers = Number::findLastNPublished(3);

        foreach ($numbers as $numb) {
            $articles = $numb->articlesPublished();

            foreach ($articles as $art) {
                $author = '';
                foreach ($art->users() as $user) {
                    $author .= $user->getName().' ';
                }

                $item = new FeedItem();
                $item->title = $art->getTitle();
                $item->link = URIMaker::article($art);
                $item->description = $art->getSummary();
                $item->date = DateHandler::convertMySqlDateTimeToUnixTime($art->getCreated());
                $item->source = URIMaker::fromBasePath('');
                $item->author = $author;

                $rss->addItem($item);
            }
        }
        $rss->saveFeed('RSS1.0', $outFile);
    }
}

?>