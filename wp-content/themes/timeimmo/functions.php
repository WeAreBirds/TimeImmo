<?php  

//pagination
if( !function_exists( 'theme_pagination' ) ) {
  
    function theme_pagination() {
  
  global $wp_query, $wp_rewrite;
  $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
  
  $pagination = array(
    'base' => @add_query_arg('page','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
          'show_all' => false,
          'end_size'     => 1,
          'mid_size'     => 2,
    'type' => 'list',
    'next_text' => '»',
    'prev_text' => '«'
  );
  
  if( $wp_rewrite->using_permalinks() )
    $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
  
  if( !empty($wp_query->query_vars['s']) )
    $pagination['add_args'] = array( 's' => str_replace( ' ' , '+', get_query_var( 's' ) ) );
    
  echo str_replace('page/1/','', paginate_links( $pagination ) );
    } 
}

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

register_sidebar(array(
'name' => 'page_contact_adresse',
'id' => 'page_contact_adresse',
'before_widget' => '',
'after_widget' => '',
'before_title' => '',
'after_title' => '',
)); 

register_sidebar(array(
'name' => 'page_contact_infos',
'id' => 'page_contact_infos',
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
      'public' => true,
      'supports' => array(
      'title',
      'editor',
      'thumbnail',
      'title',
      'editor',
      // 'author',
      'thumbnail',
      // 'excerpt',
      // 'trackbacks',
      'custom-fields',
      'comments',
      'page-attributes'
      ),
    )
  );

  register_post_type( 'liste',
    array(
      'label' => 'Annonces',
      'labels' => array(
        'name' => __( 'Annonces immo' ),
        'singular_name' => __( 'Liste' )
      ),
      'public' => true,
  		'supports' => array(
  		'title',
  		'editor',
  		'thumbnail',
  		'title',
  		'editor',
  		// 'author',
  		'thumbnail',
  		// 'custom-fields',
  		// 'comments',
  		'page-attributes'
      ),
    )
  );

  register_post_type( 'Agent',
    array(
      'labels' => array(
        'name' => __( 'Agent' ),
        'singular_name' => __( 'Agent' )
      ),
		'public' => true
      )
  );

};

register_taxonomy(
  'categorie',
  'liste',
  array(
    'label' => 'categorie',
    'labels' => array(
    'name' => 'categorie',
    'singular_name' => 'categorie',
    'all_items' => 'Toutes les categorie',
    'edit_item' => 'Éditer la categorie',
    'view_item' => 'Voir la categorie',
    'update_item' => 'Mettre à jour la categorie',
    'add_new_item' => 'Ajouter une categorie',
    'new_item_name' => 'Nouvelle categorie',
    'search_items' => 'Rechercher parmi les categories',
    'popular_items' => 'categorie les plus utilisés'
  ),
  'hierarchical' => true
  )
);
register_taxonomy(
  'biens',
  'liste',
  array(
    'label' => 'type de bien',
    'labels' => array(
    'name' => 'biens',
    'singular_name' => 'biens',
    'all_items' => 'Toutes les categorie',
    'edit_item' => 'Éditer la categorie',
    'view_item' => 'Voir la categorie',
    'update_item' => 'Mettre à jour la categorie',
    'add_new_item' => 'Ajouter une categorie',
    'new_item_name' => 'Nouvelle categorie',
    'search_items' => 'Rechercher parmi les categories',
    'popular_items' => 'categorie les plus utilisés'
  ),
  'hierarchical' => true
  )
);
register_taxonomy_for_object_type( 'liste', 'categorie' );
register_taxonomy_for_object_type( 'biens', 'categorie' );

?>