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

class Social {

    /**
     * This method creates the links to the most common social networks
     *
     * @param <String> $text
     * @return <String>
     */
    public static function createLinks($url, $title, $target = '_blank', $siteKeywords = '') {
        //REMOVE BEGINNING AND ENDING SPACES
        $title = trim($title);
        $siteKeywords = trim($siteKeywords);

        $out = '';

        if (defined('SOCIAL_FACEBOOK') AND constant('SOCIAL_FACEBOOK')=='ON') {
            $out .= '<a href="http://www.facebook.com/share.php?u='.$url.'&t='.$title.'" title="Segnala su Facebook" rel="nofollow"><img src="'.URIMaker::fromBasePath('admin/resources/img/social/bookmark_facebook.png').'" width="20" height="20" alt="add to facebook" title=" &#64; to facebook " /></a>';
        }
        if (defined('SOCIAL_TWITTER') AND constant('SOCIAL_TWITTER')=='ON') {
            $out .= '<a href="http://twitter.com/home?status='.$url.'" title="Click to send this page to Twitter!" target="'.$target.'" rel="nofollow"><img src="'.URIMaker::fromBasePath('admin/resources/img/social/bookmark_twitter.png').'" width="20" height="20" alt="add to twitter" title=" &#64; to twitter " /></a>';
        }
        return $out;
    }

}

?>
