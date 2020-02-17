<?php

function page_navigation($current_page, $total_pages) {
    var $html;
    var $previous_page;
    var $next_page;
    var $difference = $total_pages - $current_page;
    var $low_range = $current_page - 3;
    var $high_range = $current_page + 4;

    if ($total_pages <= 10) {
        for ($i=1; $i<=$total_pages; $i++) {
            $html .= ''.$i.' ';
        }
    } else if ($total_pages > 10 && $difference < 5) {
        $html .= '1 ... ';
        for ($i=($total_pages-5); $i<=$total_pages; $i++) {
            $html .= ''.$i.' ';
        }
    } else if ($total_pages > 10) {
        if ($current_page < 6) {
            for ($i=1; $i<7; $i++) {
                $html .= ''.$i.' ';
            }
            $html .= '... ';
            $html .= ''.$total_pages.' ';
        } else {
            $html = '1 ... ';
            for ($i=$low_range; $i<$high_range; $i++) {
                $html .= ''.$i.' ';
            }
            $html .= '... '.$total_pages.' ';
        }
    }
    if ($current_page == 1) {
        $previous_page = ' << prev';
    } else {
        $previous_page = ' << prev';
    }
    if ($current_page == $total_pages) {
        $next_page = 'next >>';
    } else {
        $next_page = 'next >> ';
    }
    $html = $previous_page . $html . $next_page;

    return $html;
}