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

class Remote {

    private static $instance = null;

    public function __construct() {
        $this->commandsBeforeIndex = array();
        $this->commandsBeforePage = array();
        $this->commandsBeforeArticle = array();
        $this->commandsBeforeComments = array();
        $this->commandsBeforeNumber = array();
        $this->commandsBeforeHeader = array();
        $this->commandsBeforeFooter = array();
        $this->commandsAfterIndex = array();
        $this->commandsAfterPage = array();
        $this->commandsAfterArticle = array();
        $this->commandsAfterComments = array();
        $this->commandsAfterNumber = array();
        $this->commandsAfterHeader = array();
        $this->commandsAfterFooter = array();
    }

    public static function getInstance()
    {
        if(self::$instance == null)
        {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    function addCommandBeforeIndex($command) {
        $this->commandsBeforeIndex[] = $command;
    }

    function executeCommandBeforeIndex(){
        foreach ( $this->commandsBeforeIndex as $command ) {
            $command->execute();
        }
    }

    function addCommandBeforePage($command) {
        $this->commandsBeforePage[] = $command;
    }

    function executeCommandBeforePage(){
        foreach ( $this->commandsBeforePage as $command ) {
            $command->execute();
        }
    }

    function addCommandBeforeArticle($command) {
        $this->commandsBeforeArticle[] = $command;
    }

    function executeCommandBeforeArticle(){
        foreach ( $this->commandsBeforeArticle as $command ) {
            $command->execute();
        }
    }

    function addCommandBeforeComments($command) {
        $this->commandsBeforeComments[] = $command;
    }

    function executeCommandBeforeComments(){
        foreach ( $this->commandsBeforeComments as $command ) {
            $command->execute();
        }
    }

    function addCommandBeforeNumber($command) {
        $this->commandsBeforeNumber[] = $command;
    }

    function executeCommandBeforeNumber(){
        foreach ( $this->commandsBeforeNumber as $command ) {
            $command->execute();
        }
    }

    function addCommandBeforeHeader($command) {
        $this->commandsBeforeHeader[] = $command;
    }

    function executeCommandBeforeHeader(){
        foreach ( $this->commandsBeforeHeader as $command ) {
            $command->execute();
        }
    }

    function addCommandBeforeFooter($command) {
        $this->commandsBeforeFooter[] = $command;
    }

    function executeCommandBeforeFooter(){
        foreach ( $this->commandsBeforeFooter as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterIndex($command) {
        $this->commandsAfterIndex[] = $command;
    }

    function executeCommandAfterIndex(){
        foreach ( $this->commandsAfterIndex as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterPage($command) {
        $this->commandsAfterPage[] = $command;
    }

    function executeCommandAfterPage(){
        foreach ( $this->commandsAfterPage as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterArticle($command) {
        $this->commandsAfterArticle[] = $command;
    }

    function executeCommandAfterArticle(){
        foreach ( $this->commandsAfterArticle as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterComments($command) {
        $this->commandsAfterComments[] = $command;
    }

    function executeCommandAfterComments(){
        foreach ( $this->commandsAfterComments as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterNumber($command) {
        $this->commandsAfterNumber[] = $command;
    }

    function executeCommandAfterNumber(){
        foreach ( $this->commandsAfterNumber as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterHeader($command) {
        $this->commandsAfterHeader[] = $command;
    }

    function executeCommandAfterHeader(){
        foreach ( $this->commandsAfterHeader as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterFooter($command) {
        $this->commandsAfterFooter[] = $command;
    }

    function executeCommandAfterFooter(){
        foreach ( $this->commandsAfterFooter as $command ) {
            $command->execute();
        }
    }
}

?>
