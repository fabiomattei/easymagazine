<?php

/*
    Copyright (C) 2009-2012  Fabio Mattei <burattino@gmail.com>

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
        $this->commandsBeforeArticle = array();
        $this->commandsAfterArticle = array();
        $this->commandsBeforeArticlesPerson = array();
        $this->commandsAfterArticlesPerson = array();
        $this->commandsBeforeCategory = array();
        $this->commandsAfterCategory = array();
        $this->commandsBeforeComments = array();
        $this->commandsAfterComments = array();
        $this->commandsBeforeNumber = array();
        $this->commandsAfterNumber = array();
        $this->commandsBeforeNumbersList = array();
        $this->commandsAfterNumbersList = array();
        $this->commandsBeforePage = array();
        $this->commandsAfterPage = array();
        $this->commandsBeforePeople = array();
        $this->commandsAfterPeople = array();
        $this->commandsBeforeResults = array();
        $this->commandsAfterResults = array();
        $this->commandsBeforeIndex = array();
        $this->commandsAfterIndex = array();
        $this->commandsBeforePlugin = array();
        $this->commandsAfterPlugin = array();
        $this->commandsBeforeTag = array();
        $this->commandsAfterTag = array();
        $this->commandsBeforeHeader = array();
        $this->commandsAfterHeader = array();
        $this->commandsBeforeFooter = array();
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

    /* Article Commands Management  */

    function addCommandBeforeArticle($command) {
        $this->commandsBeforeArticle[] = $command;
    }

    function executeCommandBeforeArticle(){
        foreach ( $this->commandsBeforeArticle as $command ) {
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

    /* ArticlesPerson Commands Management  */
    
    function addCommandBeforeArticlesPerson($command) {
        $this->commandsBeforeArticlesPerson[] = $command;
    }

    function executeCommandBeforeArticlesPerson(){
        foreach ( $this->commandsBeforeArticlesPerson as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterArticlesPerson($command) {
        $this->commandsAfterArticlesPerson[] = $command;
    }

    function executeCommandAfterArticlesPerson(){
        foreach ( $this->commandsAfterArticlesPerson as $command ) {
            $command->execute();
        }
    }

    /* Category Commands Management  */
    
    function addCommandBeforeCategory($command) {
        $this->commandsBeforeCategory[] = $command;
    }

    function executeCommandBeforeCategory(){
        foreach ( $this->commandsBeforeCategory as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterCategory($command) {
        $this->commandsAfterCategory[] = $command;
    }

    function executeCommandAfterCategory(){
        foreach ( $this->commandsAfterCategory as $command ) {
            $command->execute();
        }
    }

    /* Comments Commands Management  */
    
    function addCommandBeforeComments($command) {
        $this->commandsBeforeComments[] = $command;
    }

    function executeCommandBeforeComments(){
        foreach ( $this->commandsBeforeComments as $command ) {
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

    /* Number Commands Management  */

    function addCommandBeforeNumber($command) {
        $this->commandsBeforeNumber[] = $command;
    }

    function executeCommandBeforeNumber(){
        foreach ( $this->commandsBeforeNumber as $command ) {
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

    /* NumbersList Commands Management  */

    function addCommandBeforeNumbersList($command) {
        $this->commandsBeforeNumbersList[] = $command;
    }

    function executeCommandBeforeNumbersList(){
        foreach ( $this->commandsBeforeNumbersList as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterNumbersList($command) {
        $this->commandsAfterNumbersList[] = $command;
    }

    function executeCommandAfterNumbersList(){
        foreach ( $this->commandsAfterNumbersList as $command ) {
            $command->execute();
        }
    }

    /* Page Commands Management  */

    function addCommandBeforePage($command) {
        $this->commandsBeforePage[] = $command;
    }

    function executeCommandBeforePage(){
        foreach ( $this->commandsBeforePage as $command ) {
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

    /* People Commands Management  */

    function addCommandBeforePeople($command) {
        $this->commandsBeforePeople[] = $command;
    }

    function executeCommandBeforePeople(){
        foreach ( $this->commandsBeforePeople as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterPeople($command) {
        $this->commandsAfterPeople[] = $command;
    }

    function executeCommandAfterPeople(){
        foreach ( $this->commandsAfterPeople as $command ) {
            $command->execute();
        }
    }

    /* Results Commands Management  */
    
    function addCommandBeforeResults($command) {
        $this->commandsBeforeResults[] = $command;
    }

    function executeCommandBeforeResults(){
        foreach ( $this->commandsBeforeResults as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterResults($command) {
        $this->commandsAfterResults[] = $command;
    }

    function executeCommandAfterResults(){
        foreach ( $this->commandsAfterResults as $command ) {
            $command->execute();
        }
    }

    /* Index Commands Management  */

    function addCommandBeforeIndex($command) {
        $this->commandsBeforeIndex[] = $command;
    }

    function executeCommandBeforeIndex(){
        foreach ( $this->commandsBeforeIndex as $command ) {
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
    
    /* Plugin Commands Management  */

    function addCommandBeforePlugin($command) {
        $this->commandsBeforePlugin[] = $command;
    }

    function executeCommandBeforePlugin(){
        foreach ($this->commandsBeforePlugin as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterPlugin($command) {
        $this->commandsAfterPlugin[] = $command;
    }

    function executeCommandAfterPlugin(){
        foreach ($this->commandsAfterPlugin as $command ) {
            $command->execute();
        }
    }

    /* Tag Commands Management  */

    function addCommandBeforeTag($command) {
        $this->commandsBeforeTag[] = $command;
    }

    function executeCommandBeforeTag(){
        foreach ($this->commandsBeforeTag as $command ) {
            $command->execute();
        }
    }

    function addCommandAfterTag($command) {
        $this->commandsAfterTag[] = $command;
    }

    function executeCommandAfterTag(){
        foreach ($this->commandsAfterTag as $command ) {
            $command->execute();
        }
    }

    /* Header Commands Management  */

    function addCommandBeforeHeader($command) {
        $this->commandsBeforeHeader[] = $command;
    }

    function executeCommandBeforeHeader(){
        foreach ( $this->commandsBeforeHeader as $command ) {
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

    /* Footer Commands Management  */

    function addCommandBeforeFooter($command) {
        $this->commandsBeforeFooter[] = $command;
    }

    function executeCommandBeforeFooter(){
        foreach ( $this->commandsBeforeFooter as $command ) {
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
