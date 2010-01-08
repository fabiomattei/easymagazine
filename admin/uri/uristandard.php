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

/*
 * possible URI(s) are:
 *
 * mysite.com/numbers/$number_title/$number_id
 * mysite.com/articles/$article_title/$article_id
 * mysite.com/comments/$article_title/$article_id
 * mysite.com/pages/$page_title/$page_id
 *
 */

require_once(STARTPATH.URIPATH.'/uri.php');

class UriStandard extends URI {

    function evaluate() {
        switch ($this->uri['page']) {
            case 'number':          $router = 'number'; $id = $this->uri['id']; break;
            case 'category':        $router = 'category'; $id = $this->uri['id']; break;
            case 'article':         $router = 'article'; $id = $this->uri['id']; break;
            case 'comments':        $router = 'comments'; $id = $this->uri['id']; break;
            case 'results':         $router = 'results'; $id = 'not required'; break;
            case 'numberslist':     $router = 'numberslist'; $id = 'not required'; break;
            case 'page':            $router = 'page'; $id = $this->uri['id']; break;
            case 'articlesperson':  $router = 'articlesperson'; $id = $this->uri['id']; break;
            case 'people':          $router = 'people'; $id = 'not required'; break;
            default:                $router = 'index'; $id = 'not required';
        }

        $this->arrayURI = array(
            'Router' => $router,
            'id' => $id
        );
    }

}

?>