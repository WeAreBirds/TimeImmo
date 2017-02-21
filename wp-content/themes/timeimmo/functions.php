<?php  

//Active les images à la une
add_theme_support( 'post-thumbnails' );
 
//enleve la taille hauteur des thumbnail
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );
 
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}; 

//ajout menu dynamique
register_nav_menus( array(
        'Top' => 'Navigation principale',
        // 'Footer' => 'Navigation Secondaire',
    ) );   add_theme_support( 'menus' );

//ajout widget

register_sidebar(array(
'name' => 'menu haut telephone',
'id' => 'header_phone',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<span class="title">',
'after_title' => '<span>',
)); 

register_sidebar(array(
'name' => 'menu haut adresse',
'id' => 'header_adress',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<span class="title">',
'after_title' => '<span>',
)); 

register_sidebar(array(
'name' => 'footer text',
'id' => 'footer_text',
'before_widget' => '',
'after_widget' => '',
'before_title' => '',
'after_title' => '',
)); 

register_sidebar(array(
'name' => 'footer_contact',
'id' => 'footer_contact',
'before_widget' => '',
'after_widget' => '',
'before_title' => '',
'after_title' => '',
)); 

// if ( function_exists('register_sidebar') ) {
//     register_sidebar( array('before_widget' => '<div class="box">', 'after_widget' => '</div>', 'before_title' => '<h2>', 'after_title' => '</h2>') );
// }

//ajout custom post type
add_action( 'init', 'create_post_type' );

function create_post_type() {

  register_post_type( 'AvisClient',
    array(
      'labels' => array(
        'name' => __( 'Avis client' ),
        'singular_name' => __( 'AvisClient' )
      ),
      'public' => true
    )
  );

  register_post_type( 'Blog',
    array(
      'labels' => array(
        'name' => __( 'Blog' ),
        'singular_name' => __( 'Blog' )
      ),
      'public' => true
    )
  );

  register_post_type( 'Liste',
    array(
      'labels' => array(
        'name' => __( 'Annonces immo' ),
        'singular_name' => __( 'Liste' )
      ),
      'public' => true
    )
  );

};

?>


