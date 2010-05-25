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



class Paginator {

    private $rows_per_page = 10; //Number of records to display per page
    private $total_rows = 0; //Total number of rows returned by the query
    private $links_per_page = 5; //Number of links to display per page
    private $append = ""; //Paremeters to append to pagination links
    private $collection;
    private $page = 1;
    private $max_pages = 0;
    private $offset = 0;
    
    /**
     * This static function is useful for the administration because
     * the manager needs to reload information every time.
     *
     * @param <type> $collection
     * @param <type> $page
     * @param <type> $perpage
     * @return <type>
     */
    public static function paginate($collection, $page, $perpage = 10) {
        $offset = ($page - 1 ) * $perpage;
        return array_slice($collection, $offset, $perpage);
    }

    /**
     * Constructor
     *
     * @param resource $connection Mysql connection link
     * @param string $sql SQL query to paginate. Example : SELECT * FROM users
     * @param integer $rows_per_page Number of records to display per page. Defaults to 10
     * @param integer $links_per_page Number of links to display per page. Defaults to 5
     * @param string $append Parameters to be appended to pagination links
     */
    public function __construct($collection, $rows_per_page = 10, $links_per_page = 5, $append = "") {
        $this->collection = $collection;
        $this->rows_per_page = (int)$rows_per_page;
        if (intval($links_per_page ) > 0) {
            $this->links_per_page = (int)$links_per_page;
        } else {
            $this->links_per_page = 5;
        }
        $this->append = $append;
        $this->page = 1;
    }

    /**
     * Executes the SQL query and initializes internal variables
     *
     * @access public
     * @return resource
     */
    public function rowsToShow($page) {
        $this->page = $page;
        $this->total_rows = count($this->collection);

        //Max number of pages
        $this->max_pages = ceil($this->total_rows / $this->rows_per_page );
        if ($this->links_per_page > $this->max_pages) {
            $this->links_per_page = $this->max_pages;
        }

        //Check the page value just in case someone is trying to input an aribitrary value
        if ($this->page > $this->max_pages || $this->page <= 0) {
            $this->page = 1;
        }

        //Calculate Offset
        $this->offset = $this->rows_per_page * ($this->page - 1);

        //Fetch the required result set
        return array_slice($this->collection, $this->offset, $this->rows_per_page);
    }

    /**
     * Display the link to the first page
     *
     * @access public
     * @param string $tag Text string to be displayed as the link. Defaults to 'First'
     * @return string
     */
    public function renderFirst($pagelink) {
        if ($this->total_rows == 0)
            return FALSE;

        if ($this->page == 1) {
            return LANG_PAGINATOR_FIRST;
        } else {
            return '<a href="'.$pagelink.'&page=1' . $this->append . '">'.LANG_PAGINATOR_FIRST.'</a> ';
        }
    }

    /**
     * Display the link to the last page
     *
     * @access public
     * @param string $tag Text string to be displayed as the link. Defaults to 'Last'
     * @return string
     */
    function renderLast($pagelink) {
        if ($this->total_rows == 0)
            return FALSE;

        if ($this->page == $this->max_pages) {
            return LANG_PAGINATOR_LAST;
        } else {
            return ' <a href="'.$pagelink.'&page=' . $this->max_pages . '&' . $this->append . '">'.LANG_PAGINATOR_LAST.'</a>';
        }
    }

    /**
     * Display the next link
     *
     * @access public
     * @param string $tag Text string to be displayed as the link. Defaults to '>>'
     * @return string
     */
    function renderNext($pagelink, $tag = '&gt;&gt;') {
        if ($this->total_rows == 0)
            return FALSE;

        if ($this->page < $this->max_pages) {
            return '<a href="'.$pagelink.'&page=' . ($this->page + 1) . '&' . $this->append . '">' . $tag . '</a>';
        } else {
            return $tag;
        }
    }

    /**
     * Display the previous link
     *
     * @access public
     * @param string $tag Text string to be displayed as the link. Defaults to '<<'
     * @return string
     */
    function renderPrev($pagelink, $tag = '&lt;&lt;') {
        if ($this->total_rows == 0)
            return FALSE;

        if ($this->page > 1) {
            return ' <a href="'.$pagelink.'&page=' . ($this->page - 1) . '&' . $this->append . '">' . $tag . '</a>';
        } else {
            return " $tag";
        }
    }

    /**
     * Display the page links
     *
     * @access public
     * @return string
     */
    function renderNav($pagelink, $prefix = '<span class="page_link">', $suffix = '</span>') {
        if ($this->total_rows == 0)
            return FALSE;

        $batch = ceil($this->page / $this->links_per_page );
        $end = $batch * $this->links_per_page;
        if ($end == $this->page) {
        //$end = $end + $this->links_per_page - 1;
        //$end = $end + ceil($this->links_per_page/2);
        }
        if ($end > $this->max_pages) {
            $end = $this->max_pages;
        }
        $start = $end - $this->links_per_page + 1;
        $links = '';

        for($i = $start; $i <= $end; $i ++) {
            if ($i == $this->page) {
                $links .= $prefix . " $i " . $suffix;
            } else {
                $links .= ' ' . $prefix . '<a href="'.$pagelink.'&page=' . $i . '&' . $this->append . '">' . $i . '</a>' . $suffix . ' ';
            }
        }

        return $links;
    }

    /**
     * Display full pagination navigation
     *
     * @access public
     * @return string
     */
    public function renderFullNav($pagelink) {
        if (count($this->collection) > $this->rows_per_page) {
            $out = $this->renderFirst($pagelink) . '&nbsp;' . $this->renderPrev($pagelink) . '&nbsp;' . $this->renderNav($pagelink) . '&nbsp;' . $this->renderNext($pagelink) . '&nbsp;' . $this->renderLast($pagelink);
        } else {
            $out ='';
        }
        return $out;
    }

}

?>