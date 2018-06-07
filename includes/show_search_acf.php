<?php

add_action( 'admin_notices', 'wp_search_acf' );
function wp_search_acf() {
    global $pagenow,  $post;

    if ($post->post_type) {
        $postType = $post->post_type;
    }else{
        $postType = $_GET['post_type'];
    }
    
	$args = array( 
		'post_type'        => $postType, 
		'post_status'      => 'publish', 
		'order'            => 'DESC', 
		'orderby'          => 'date', 
		's'                => $_POST['term'], 
		'posts_per_page'   => -1 
	); 
    // $query = new WP_Query( $args ); 
    $query =  get_posts( $args );
    
    // <input type="text" value="Search ACF">
    //      <button id="wp-search_acf-btn" type="button" class="button">Search</button>

    if (  $pagenow == 'edit.php' ){
        echo '
        <div class ="wrap_acf_search" style="display:none;">	
        <form  method="get">
            <input  type="text" name="s" placeholder="Search ACF" value="'.$_GET['s'].'"/>
            <input type="submit"  value="Search"/>
        </form>
        </div>
        ';
    }
    

    
}


// add_filter( 'posts_join', 'segnalazioni_search_join' );
// function segnalazioni_search_join ( $join ) {
//     global $pagenow, $wpdb;

//     // I want the filter only when performing a search on edit page of Custom Post Type named "segnalazioni".
//     if ( is_admin() && 'edit.php' === $pagenow  && ! empty( $_GET['s'] ) ) {    
//         $join .= 'LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
//     }
//     return $join;
// }

// add_filter( 'posts_where', 'segnalazioni_search_where' );
// function segnalazioni_search_where( $where ) {
//     global $pagenow, $wpdb;

//     // I want the filter only when performing a search on edit page of Custom Post Type named "segnalazioni".
//     if ( is_admin() && 'edit.php' === $pagenow && ! empty( $_GET['s'] ) ) {
//         $where = preg_replace(
//             "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
//             "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where );
//     }
//     return $where;
// }

function cf_search_join( $join ) {
    global $wpdb;   
    $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    return $join;
}
add_filter('posts_join', 'cf_search_join' );

function cf_search_where( $where ) {
    global $wpdb;
    $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

function cf_search_distinct( $where ) {
    global $wpdb;
    return "DISTINCT";
    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

