<?php
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$totalPage =  $query->max_num_pages;

    echo '<div class="paging-navigation" page="'.$paged.'">';
    if($paged <= 1){
        echo '<a class="next disabled" >Prev</a>';
    }else{
        echo '<a class="next" href="'. get_permalink() .'?paged='.($paged -1).'">Prev</a>';

    }
    if( $paged -2 > 0){
        echo '<a href="'. get_permalink() .'?paged='.($paged -2) .'" >' . ($paged - 2) . '</a>';
    } 
    if( $paged - 1 > 0){
        echo '<a href="'. get_permalink() .'?paged='.($paged -1 ).'" >' . ($paged - 1) . '</a>';
    } 
    echo '<a href="'. get_permalink() .'?paged='.$paged.'"  class="current-page"  >' . ($paged) . '</a>';
    if( $paged + 1 <= $totalPage){
        echo '<a href="'. get_permalink() .'?paged='.($paged + 1) .'" >' . ($paged + 1) . '</a>';
    } 
    if( $paged + 2 <= $totalPage){
        echo '<a href="'. get_permalink() .'?paged='.($paged + 2) .'" >' . ($paged + 2) . '</a>';
    } 
    if($totalPage <=  $paged){
        echo '<a class="next disabled" >Next</a>';
    }else{
        echo '<a class="next"  href="'. get_permalink() .'?paged='.($paged + 1).'">Next</a>';
        
    }
    echo '</div>';
