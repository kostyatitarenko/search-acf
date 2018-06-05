<?php

add_action( 'admin_notices', 'wp_search_acf' );
function wp_search_acf() {
    global $post, $pagenow;
    if($post->post_type){
        $postType = $post->post_type;
    }else{
        $postType = $_GET['post_type'];
    }
    
    $args = array( 
		'post_type'        =>  $postType,
		'post_status'      => 'publish', 
		'order'            => 'DESC', 
		'orderby'          => 'date', 
		's'                => $_POST['term'], 
		'posts_per_page'   => -1 
	); 
    $query = new WP_Query( $args ); 
    
    
    highlight_string("<?php\n\$args =\n" . var_export($args, true) . ";\n?>");
   
    if (  $pagenow == 'edit.php' ){
        echo '	
        <div class ="wrap_acf_search" style="display:none;">	
            <input type="text" value="Search ACF">
            <button id="wp-search_acf-btn" type="button" class="button">Search</button>

        </div>
        ';
    }
   
}
