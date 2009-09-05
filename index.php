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

define('STARTPATH', '');
require_once('costants.php');
require_once('settings.php');

require_once(PLUGINPATH.'pluginIncluder.php');
require_once(TEMPLATEBASEPATH.'templateIncluder.php');
require_once(ROUTERPATH.'routerfactory.php');

if (URLTYPE == 'optimized') {
    require_once(URIPATH.'urioptimized.php');
    if (isset($_GET['uri'])) {
        $uri = new UriOptimized($_GET['uri']);
        $uri->evaluate();
        $arURI = $uri->getArrayuri();
    } else {
        $arURI = array('Router' => 'index');
    }
} else {
    require_once(URIPATH.'uristandard.php');
     if (isset($_GET['page'])) {
        $uri = new UriStandard($_GET);
        $uri->evaluate();
        $arURI = $uri->getArrayuri();
    } else {
        $arURI = array('Router' => 'index');
    }
}

$routerFactory = new RouterFactory();

$router = $routerFactory->createRouter($arURI);

$router->show();

?>