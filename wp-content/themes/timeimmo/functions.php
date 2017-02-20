<?php  

add_theme_support( 'post-thumbnails');
 
//enleve la taille hauteur des thumbnail
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );
 
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}; 

//ajout menu dynamique
register_nav_menus( array(
        'top' => 'Navigation principale',
    ) );   add_theme_support( 'menus' );

?>