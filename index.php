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


include('costants.php');

include(PLUGINPATH.'commandSandBox/index.php');
include(ROUTERPATH.'routerfactory.php');
include(URIPATH.'uridefault.php');

if (isset ($_GET['uri'])) {
    $uridefault = new UriDefault($_GET['uri']);
    $uridefault->evaluate();
    $arURI = $uridefault->getArrayuri();
} else {
    $arURI = array('Router' => 'index');
}

$routerFactory = new RouterFactory();

$router = $routerFactory->createRouter($arURI);

$router->show();

?>
