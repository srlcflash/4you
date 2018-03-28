<?php

class Paginations {

    static public $total_pages;
    static public $limit = 2;
    static public $prev_c;
    static public $next_c;
    static public $page;
    static public $lastpage;
    static public $lpm1;
    static public $pagination;
    static public $adjacents;
    static public $js_callback;
    static public $id = 0;
    static public $start;
    static public $targetpage;

    static function setTotalPages($total_pages) {
        self::$total_pages = $total_pages;
    }

    static function setPage($page = 0) {
        if (!isset($page) || $page == 0)
            self::$page = 1;
        else
            self::$page = $page;

        if (self::$page)
            self::$start = (self::$page - 1) * self::$limit;    //first item to display on this page
        else
            self::$start = 0;
    }

    static function setLimit($limit = 5) {
        self::$limit = $limit;
    }

    static function setJSCallback($callback, $id = 0) {
        self::$js_callback = $callback;
        self::$id = $id;
    }

    static function makePagination() {
        self::$targetpage = "pagination.php";

        self::$adjacents = 3;

        if (self::$page) {
            self::$start = (self::$page - 1) * self::$limit;
        } else {
            self::$start = 0;
        }

        self::$prev_c = self::$page - 1;
        self::$next_c = self::$page + 1;
        self::$lastpage = ceil(self::$total_pages / self::$limit);
        self::$lpm1 = self::$lastpage - 1;

        // assign local
        $adjacents = self::$adjacents;
        $lastpage = self::$lastpage;
        $page = self::$page;

        $pagination = "";

        $lpm1 = self::$lpm1;

        if ($lastpage > 1) {
            echo $pagination = "<div class=\"paginations\">";
            //prev_cious button
            if ($page > 1)
            //$pagination.= "<a href=\"$targetpage?page=$prev_c\">« prev_cious</a>";
                $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(' . self::$prev_c . ',' . self::$id . ')' . '">Previous</a>';
            else
                $pagination.= "<a class=\"disabled\">Previous</a>";

            //pages	
            if ($lastpage < 7 + ($adjacents * 2)) { //not enough pages to bother breaking it up
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<a class=\"current\">$counter</a>";
                    else
                        $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(' . $counter . ',' . self::$id . ')' . '">' . $counter . '</a>';
                }
            }
            elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
                //close to beginning; only hide later pages
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination.= "<a class=\"current\">$counter</a>";
                        else
                        //$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
                            $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(' . $counter . ',' . self::$id . ')' . '">' . $counter . '</a>';
                    }
                    $pagination.= "...";
                    //$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                    $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(' . $lpm1 . ',' . self::$id . ')' . '">' . $lpm1 . '</a>';
                    //$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
                    $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(' . $lastpage . ',' . self::$id . ')' . '">' . $lastpage . '</a>';
                }
                //in middle; hide some front and some back
                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    //$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                    $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(1,' . self::$id . ')' . '">1</a>';
                    //$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                    $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(2,' . self::$id . ')' . '">2</a>';
                    $pagination.= "...";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<a class=\"current\">$counter</a>";
                        else
                        //$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
                            $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(' . $counter . ',' . self::$id . ')' . '">' . $counter . '</a>';
                    }
                    $pagination.= "...";
                    //$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
                    $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(' . $lpm1 . ',' . self::$id . ')' . '">' . $lpm1 . '</a>';
                    //$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
                    $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(' . $lastpage . ',' . self::$id . ')' . '">' . $lastpage . '</a>';
                }
                //close to end; only hide early pages
                else {
                    //$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
                    $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(1,' . self::$id . ')' . '">1</a>';
                    //$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
                    $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(2,' . self::$id . ')' . '">2</a>';
                    $pagination.= "...";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<a class=\"current\">$counter</a>";
                        else
                        //$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
                            $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(' . $counter . ',' . self::$id . ')' . '">' . $counter . '</a>';
                    }
                }
            }

            //next_c button
            if ($page < $counter - 1)
            //$pagination.= "<a href=\"$targetpage?page=$next_c\">next_c »</a>";
                $pagination.= '<a href="javascript:;" onclick="' . self::$js_callback . '(' . self::$next_c . ',' . self::$id . ')' . '">Next</a>';
            else
                $pagination.= "<a class=\"disabled\">Next</a>";
            $pagination.= "</div>\n";

            self::$pagination = $pagination;
        }
    }

    static function drawPagination() {
        echo self::$pagination;
    }

}

?>