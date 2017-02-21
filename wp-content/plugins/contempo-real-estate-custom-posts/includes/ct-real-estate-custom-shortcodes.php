<?php

/**
 * Register Custom Shortcodes
 *
 * @link       http://contempographicdesign.com
 * @since      1.0.0
 *
 * @package    Contempo Real Estate Custom Posts
 * @subpackage ct-real-estate-custom-posts/includes
 */

/*-----------------------------------------------------------------------------------*/
/* Listings Shortcode */
/*-----------------------------------------------------------------------------------*/

function ct_listings_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'layout' => 'grid',
			'orderby' => '',
			'order' => '',
			'meta_key' => '',
			'meta_type' => '',
			'number' => '6',
			'type' => '',
			'beds' => '',
			'baths' => '',
			'status' => '',
			'city' => '',
			'state' => '',
			'zipcode' => '',
			'country' => '',
			'community' => '',
			'additional_features' => ''
		), $atts )
	);

	// Output
	echo '<ul class="col span_12 row first">';

		global $post;
		global $ct_options;

    	$args = array(
            'ct_status' => $status,
            'property_type' => $type,
            'beds' => $beds,
            'baths' => $baths,
            'city' => $city,
            'state' => $state,
            'zipcode' => $zipcode,
            'country' => $country,
            'community' => $community,
            'additional_features' => $additional_features,
            'post_type' => 'listings',
            'orderby' => $orderby,
			'order' => $order,
			'meta_key' => $meta_key,
			'meta_type' => 'numeric',
            'posts_per_page' => $number
        );
        $wp_query = new wp_query( $args ); 
        
        $count = 0; if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();

        $city = strip_tags( get_the_term_list( $wp_query->post->ID, 'city', '', ', ', '' ) );
        $state = strip_tags( get_the_term_list( $wp_query->post->ID, 'state', '', ', ', '' ) );
        $zipcode = strip_tags( get_the_term_list( $wp_query->post->ID, 'zipcode', '', ', ', '' ) );
        $country = strip_tags( get_the_term_list( $wp_query->post->ID, 'country', '', ', ', '' ) );

        $beds = strip_tags( get_the_term_list( $wp_query->post->ID, 'beds', '', ', ', '' ) );
	    $baths = strip_tags( get_the_term_list( $wp_query->post->ID, 'baths', '', ', ', '' ) );

	    $ct_use_propinfo_icons = isset( $ct_options['ct_use_propinfo_icons'] ) ? esc_html( $ct_options['ct_use_propinfo_icons'] ) : '';
		$ct_search_results_listing_style = isset( $ct_options['ct_search_results_listing_style'] ) ? $ct_options['ct_search_results_listing_style'] : '';
		$ct_listing_stats_on_off = isset( $ct_options['ct_listing_stats_on_off'] ) ? esc_attr( $ct_options['ct_listing_stats_on_off'] ) : '';
	    
	    $ct_walkscore = isset( $ct_options['ct_enable_walkscore'] ) ? esc_html( $ct_options['ct_enable_walkscore'] ) : '';
	    $ct_rentals_booking = isset( $ct_options['ct_rentals_booking'] ) ? esc_html( $ct_options['ct_rentals_booking'] ) : '';
	    $ct_listing_reviews = isset( $ct_options['ct_listing_reviews'] ) ? esc_html( $ct_options['ct_listing_reviews'] ) : '';

	    if($ct_walkscore == 'yes') {
		    /* Walk Score */
		   	$latlong = get_post_meta($post->ID, "_ct_latlng", true);
		   	if($latlong != '') {
				list($lat, $long) = explode(',',$latlong,2);
				$address = get_the_title() . ct_taxonomy_return('city') . ct_taxonomy_return('state') . ct_taxonomy_return('zipcode');
				$json = ct_get_walkscore($lat,$long,$address);

				$ct_ws = json_decode($json);
			}
		}

        ?>

        <?php if($layout == 'List') { ?>

        	<li class="listing listing-list col span_12 first">

		        <?php do_action('before_listing_list_img'); ?>

		        <?php if(has_post_thumbnail()) { ?>
		        <figure class="col span_6 first">
		            <?php
		                $status_tags = strip_tags( get_the_term_list( $wp_query->post->ID, 'ct_status', '', ' ', '' ) );
						if($status_tags != '') {
							echo '<h6 class="snipe ';
									$status_terms = get_the_terms( $wp_query->post->ID, 'ct_status', array() );
									if ( ! empty( $status_terms ) && ! is_wp_error( $status_terms ) ){
									     foreach ( $status_terms as $term ) {
									       echo esc_html($term->slug) . ' ';
									     }
									 }
								echo '">';
								echo '<span>';
									echo esc_html($status_tags);
								echo '</span>';
							echo '</h6>';
						}
	                ?>
	                <?php if( function_exists('ct_property_type_icon') ) {
	                	ct_property_type_icon();
	            	} ?>
	            	<?php if(function_exists('wpfp_link') || class_exists('Redq_Alike')) {
						echo '<ul class="listing-actions">';
							
							if (function_exists('wpfp_link')) {
								echo '<li>';
									echo '<span class="save-this" data-tooltip="' . __('Favorite','contempo') . '">';
										wpfp_link();
									echo '</span>';
								echo '</li>';
							}

							if(class_exists('Redq_Alike')) {
								echo '<li>';
									echo '<span class="compare-this" data-tooltip="' . __('Compare','contempo') . '">';
										echo do_shortcode('[alike_link vlaue="compare" show_icon="true" icon_class="fa fa-plus-square-o"]');
									echo '</span>';
								echo '</li>';
							}

							if(function_exists('ct_get_listing_views') && $ct_listing_stats_on_off != 'no') {
								echo '<li>';
									echo '<span class="listing-views" data-tooltip="' . ct_get_listing_views(get_the_ID()) . __(' Views','contempo') . '">';
										echo '<i class="fa fa-bar-chart"></i>';
									echo '</span>';
								echo '</li>';
							}

						echo '</ul>';
					} ?>
	                <?php if( function_exists('ct_first_image_linked') ) {
	                	ct_first_image_linked();
	                } ?>
		        </figure>
		        <?php } ?>

		        <?php do_action('before_listing_list_info'); ?>

		        <div class="list-listing-info col span_6">
		            <div class="list-listing-info-inner">
		                <header>
			                <h5 class="marB0"><a href="<?php the_permalink(); ?>"><?php if( function_exists('ct_listing_title') ) { ct_listing_title(); } ?></a></h5>
			                <p class="location muted marB0"><?php echo esc_html($city); ?>, <?php echo esc_html($state); ?> <?php echo esc_html($zipcode); ?> <?php echo esc_html($country); ?></p>
		                </header>
		                <p class="price marB0"><?php if( function_exists('ct_listing_price') ) { ct_listing_price(); } ?></p>
		                
		                <div class="propinfo">
			                <p class="propinfo-excerpt"><?php if( function_exists('ct_excerpt') ) { echo ct_excerpt(25); } ?></p>
			                <ul class="marB0">
								<?php

							    if(ct_has_type('commercial') || ct_has_type('lot') || ct_has_type('land')) { 
							        // Dont Display Bed/Bath
							    } else {
							    	if(!empty($beds)) {
								    	echo '<li class="row beds">';
								    		echo '<span class="muted left">';
								    			if($ct_use_propinfo_icons != 'icons') {
									    			_e('Bed', 'contempo');
									    		} else {
									    			echo '<i class="fa fa-bed"></i>';
									    		}
								    		echo '</span>';
								    		echo '<span class="right">';
								               echo $beds;
								            echo '</span>';
								        echo '</li>';
								    }	
								    if(!empty($baths)) {
								        echo '<li class="row baths">';
								            echo '<span class="muted left">';
								    			if($ct_use_propinfo_icons != 'icons') {
									    			_e('Baths', 'contempo');
									    		} else {
									    			ct_bath_icon();
									    		}
								    		echo '</span>';
								    		echo '<span class="right">';
								               echo $baths;
								            echo '</span>';
								        echo '</li>';
								    }
							    }

							    if($ct_walkscore == 'yes') {
								    if(!empty($ct_ws->walkscore)) {
									    echo '<li class="row walkscore">';
											echo '<span class="muted left">';
												_e('Walk Score&reg;', 'contempo');
											echo '</span>';
											echo '<span class="right">';
												echo '<a class="tooltips" href=" ' . $ct_ws->ws_link , '" target="_blank">';
											        echo $ct_ws->walkscore;
											        echo '<span>' . $ct_ws->description. '</span>';
										        echo '</a>';
									        echo '</span>';
									    echo '</li>';
									}
								}

								include_once ABSPATH . 'wp-admin/includes/plugin.php';
								if($ct_listing_reviews == 'yes' || is_plugin_active('comments-ratings/comments-ratings.php')) {
									global $pixreviews_plugin;
									$ct_rating_avg = $pixreviews_plugin->get_average_rating();
									if($ct_rating_avg != '') {
										echo '<li class="row rating">';
								            echo '<span class="muted left">';
								                if($ct_use_propinfo_icons != 'icons') {
									    			_e('Rating', 'contempo');
									    		} else {
									    			echo '<i class="fa fa-star"></i>';
									    		}
								            echo '</span>';
								            echo '<span class="right">';
								                 echo $pixreviews_plugin->get_average_rating();
								            echo '</span>';
								        echo '</li>';
								    }
								}

							    include_once ABSPATH . 'wp-admin/includes/plugin.php';
								if($ct_rentals_booking == 'yes' || is_plugin_active('booking/wpdev-booking.php')) {
								    if(get_post_meta($post->ID, "_ct_rental_guests", true)) {
								        echo '<li class="row guests">';
								            echo '<span class="muted left">';
								                if($ct_use_propinfo_icons != 'icons') {
									    			_e('Guests', 'contempo');
									    		} else {
									    			echo '<i class="fa fa-group"></i>';
									    		}
								            echo '</span>';
								            echo '<span class="right">';
								                 echo get_post_meta($post->ID, "_ct_rental_guests", true);
								            echo '</span>';
								        echo '</li>';
								    }

								    if(get_post_meta($post->ID, "_ct_rental_min_stay", true)) {
								        echo '<li class="row min-stay">';
								            echo '<span class="muted left">';
								                if($ct_use_propinfo_icons != 'icons') {
									    			_e('Min Stay', 'contempo');
									    		} else {
									    			echo '<i class="fa fa-calendar"></i>';
									    		}
								            echo '</span>';
								            echo '<span class="right">';
								                 echo get_post_meta($post->ID, "_ct_rental_min_stay", true);
								            echo '</span>';
								        echo '</li>';
								    }
								}
							    
							    if(get_post_meta($post->ID, "_ct_sqft", true)) {
							    	if($ct_use_propinfo_icons != 'icons') {
								        echo '<li class="row sqft">';
								            echo '<span class="muted left">';
								    			ct_sqftsqm();
								    		echo '</span>';
								    		echo '<span class="right">';
								                 echo get_post_meta($post->ID, "_ct_sqft", true);
								            echo '</span>';
								        echo '</li>';
								    } else {
								    	echo '<li class="row sqft">';
								            echo '<span class="muted left">';
												ct_listing_size_icon();
								    		echo '</span>';
								    		echo '<span class="right">';
								                 echo get_post_meta($post->ID, "_ct_sqft", true);
								                 echo ' ' . ct_sqftsqm();
								            echo '</span>';
								        echo '</li>';
								    }
							    }
							    
							    if(get_post_meta($post->ID, "_ct_lotsize", true)) {
							        if(get_post_meta($post->ID, "_ct_sqft", true)) {
							            echo '<li class="row lotsize">';
							        }
							            echo '<span class="muted left">';
							    			if($ct_use_propinfo_icons != 'icons') {
								    			_e('Lot Size', 'contempo');
								    		} else {
								    			echo '<i class="fa fa-arrows-alt"></i>';
								    		}
							    		echo '</span>';
							    		echo '<span class="right">';
							                 echo get_post_meta($post->ID, "_ct_lotsize", true) . ' ';
							                 ct_acres();
							            echo '</span>';
							            
							        if((get_post_meta($post->ID, "_ct_sqft", true))) {
							            echo '</li>';
							        }
							    } ?>
		                    </ul>
		                </div>

		                <?php ct_brokered_by(); ?>
		            </div>
		        </div>
			
		    </li>

        <?php } else { ?>
            
	        <li class="listing col span_4 <?php echo $ct_search_results_listing_style; ?> <?php if($count % 3 == 0) { echo 'first'; } ?>">
	            <figure>
	                <?php
		                $status_tags = strip_tags( get_the_term_list( $wp_query->post->ID, 'ct_status', '', ' ', '' ) );
						if($status_tags != '') {
							echo '<h6 class="snipe ';
									$status_terms = get_the_terms( $wp_query->post->ID, 'ct_status', array() );
									if ( ! empty( $status_terms ) && ! is_wp_error( $status_terms ) ){
									     foreach ( $status_terms as $term ) {
									       echo esc_html($term->slug) . ' ';
									     }
									 }
								echo '">';
								echo '<span>';
									echo esc_html($status_tags);
								echo '</span>';
							echo '</h6>';
						}
	                ?>
	                <?php if( function_exists('ct_property_type_icon') ) {
	                	ct_property_type_icon();
	            	} ?>
	                <?php if(function_exists('wpfp_link') || class_exists('Redq_Alike')) {
						echo '<ul class="listing-actions">';
							
							if (function_exists('wpfp_link')) {
								echo '<li>';
									echo '<span class="save-this" data-tooltip="' . __('Favorite','contempo') . '">';
										wpfp_link();
									echo '</span>';
								echo '</li>';
							}

							if(class_exists('Redq_Alike')) {
								echo '<li>';
									echo '<span class="compare-this" data-tooltip="' . __('Compare','contempo') . '">';
										echo do_shortcode('[alike_link vlaue="compare" show_icon="true" icon_class="fa fa-plus-square-o"]');
									echo '</span>';
								echo '</li>';
							}

							if(function_exists('ct_get_listing_views') && $ct_listing_stats_on_off != 'no') {
								echo '<li>';
									echo '<span class="listing-views" data-tooltip="' . ct_get_listing_views(get_the_ID()) . __(' Views','contempo') . '">';
										echo '<i class="fa fa-bar-chart"></i>';
									echo '</span>';
								echo '</li>';
							}

						echo '</ul>';
					} ?>
	                <?php if( function_exists('ct_first_image_linked') ) {
	                	ct_first_image_linked();
	                } ?>
	            </figure>
	            <div class="grid-listing-info">
		            <header>
		                <h5 class="marB0"><a href="<?php the_permalink(); ?>"><?php if( function_exists('ct_listing_title') ) { ct_listing_title(); } ?></a></h5>
		                <p class="location muted marB0"><?php echo esc_html($city); ?>, <?php echo esc_html($state); ?> <?php echo esc_html($zipcode); ?> <?php echo esc_html($country); ?></p>
	                </header>
	                <p class="price marB0"><?php if( function_exists('ct_listing_price') ) { ct_listing_price(); } ?></p>
		            <div class="propinfo">
		            	<p><?php if( function_exists('ct_excerpt') ) { echo ct_excerpt(25); } ?></p>
		                <ul class="marB0">
							<?php

						    if(ct_has_type('commercial') || ct_has_type('lot') || ct_has_type('land')) { 
						        // Dont Display Bed/Bath
						    } else {
						    	if(!empty($beds)) {
							    	echo '<li class="row beds">';
							    		echo '<span class="muted left">';
							    			if($ct_use_propinfo_icons != 'icons') {
								    			_e('Bed', 'contempo');
								    		} else {
								    			echo '<i class="fa fa-bed"></i>';
								    		}
							    		echo '</span>';
							    		echo '<span class="right">';
							               echo $beds;
							            echo '</span>';
							        echo '</li>';
							    }	
							    if(!empty($baths)) {
							        echo '<li class="row baths">';
							            echo '<span class="muted left">';
							    			if($ct_use_propinfo_icons != 'icons') {
								    			_e('Baths', 'contempo');
								    		} else {
								    			ct_bath_icon();
								    		}
							    		echo '</span>';
							    		echo '<span class="right">';
							               echo $baths;
							            echo '</span>';
							        echo '</li>';
							    }
						    }

						    if($ct_walkscore == 'yes') {
							    if(!empty($ct_ws->walkscore)) {
								    echo '<li class="row walkscore">';
										echo '<span class="muted left">';
											_e('Walk Score&reg;', 'contempo');
										echo '</span>';
										echo '<span class="right">';
											echo '<a class="tooltips" href=" ' . $ct_ws->ws_link , '" target="_blank">';
										        echo $ct_ws->walkscore;
										        echo '<span>' . $ct_ws->description. '</span>';
									        echo '</a>';
								        echo '</span>';
								    echo '</li>';
								}
							}

							include_once ABSPATH . 'wp-admin/includes/plugin.php';
							if($ct_listing_reviews == 'yes' || is_plugin_active('comments-ratings/comments-ratings.php')) {
								global $pixreviews_plugin;
								$ct_rating_avg = $pixreviews_plugin->get_average_rating();
								if($ct_rating_avg != '') {
									echo '<li class="row rating">';
							            echo '<span class="muted left">';
							                if($ct_use_propinfo_icons != 'icons') {
								    			_e('Rating', 'contempo');
								    		} else {
								    			echo '<i class="fa fa-star"></i>';
								    		}
							            echo '</span>';
							            echo '<span class="right">';
							                 echo $pixreviews_plugin->get_average_rating();
							            echo '</span>';
							        echo '</li>';
							    }
							}

						    include_once ABSPATH . 'wp-admin/includes/plugin.php';
							if($ct_rentals_booking == 'yes' || is_plugin_active('booking/wpdev-booking.php')) {
							    if(get_post_meta($post->ID, "_ct_rental_guests", true)) {
							        echo '<li class="row guests">';
							            echo '<span class="muted left">';
							                if($ct_use_propinfo_icons != 'icons') {
								    			_e('Guests', 'contempo');
								    		} else {
								    			echo '<i class="fa fa-group"></i>';
								    		}
							            echo '</span>';
							            echo '<span class="right">';
							                 echo get_post_meta($post->ID, "_ct_rental_guests", true);
							            echo '</span>';
							        echo '</li>';
							    }

							    if(get_post_meta($post->ID, "_ct_rental_min_stay", true)) {
							        echo '<li class="row min-stay">';
							            echo '<span class="muted left">';
							                if($ct_use_propinfo_icons != 'icons') {
								    			_e('Min Stay', 'contempo');
								    		} else {
								    			echo '<i class="fa fa-calendar"></i>';
								    		}
							            echo '</span>';
							            echo '<span class="right">';
							                 echo get_post_meta($post->ID, "_ct_rental_min_stay", true);
							            echo '</span>';
							        echo '</li>';
							    }
							}
						    
						    if(get_post_meta($post->ID, "_ct_sqft", true)) {
						    	if($ct_use_propinfo_icons != 'icons') {
							        echo '<li class="row sqft">';
							            echo '<span class="muted left">';
							    			ct_sqftsqm();
							    		echo '</span>';
							    		echo '<span class="right">';
							                 echo get_post_meta($post->ID, "_ct_sqft", true);
							            echo '</span>';
							        echo '</li>';
							    } else {
							    	echo '<li class="row sqft">';
							            echo '<span class="muted left">';
											ct_listing_size_icon();
							    		echo '</span>';
							    		echo '<span class="right">';
							                 echo get_post_meta($post->ID, "_ct_sqft", true);
							                 echo ' ' . ct_sqftsqm();
							            echo '</span>';
							        echo '</li>';
							    }
						    }
						    
						    if(get_post_meta($post->ID, "_ct_lotsize", true)) {
						        if(get_post_meta($post->ID, "_ct_sqft", true)) {
						            echo '<li class="row lotsize">';
						        }
						            echo '<span class="muted left">';
						    			if($ct_use_propinfo_icons != 'icons') {
							    			_e('Lot Size', 'contempo');
							    		} else {
							    			echo '<i class="fa fa-arrows-alt"></i>';
							    		}
						    		echo '</span>';
						    		echo '<span class="right">';
						                 echo get_post_meta($post->ID, "_ct_lotsize", true) . ' ';
						                 ct_acres();
						            echo '</span>';
						            
						        if((get_post_meta($post->ID, "_ct_sqft", true))) {
						            echo '</li>';
						        }
						    } ?>
	                    </ul>
	                </div>
	            </div>
		
	        </li>

		<?php } ?>
        
        <?php
		
		$count++;
		
		if($count % 3 == 0) {
			echo '<div class="clear"></div>';
		}
		
		endwhile; endif;
		wp_reset_postdata();

	echo '</ul>';
	    echo '<div class="clear"></div>';
	
}
add_shortcode( 'ct-listings', 'ct_listings_shortcode' );

/*-----------------------------------------------------------------------------------*/
/* Add Listings Shortcode to Visual Composer if the plugin is enabled */
/*-----------------------------------------------------------------------------------*/

include_once ABSPATH . 'wp-admin/includes/plugin.php';
if(is_plugin_active('js_composer/js_composer.php')) {

	add_action( 'vc_before_init', 'ct_listings_integrateWithVC' );
	function ct_listings_integrateWithVC() {
	   vc_map( array(
	      "name" => __( "CT Listings", "contempo" ),
	      "base" => "ct-listings",
	      "class" => "",
	      "category" => __( "CT Modules", "contempo"),
	      'description' => __( 'Display listings in standard grid layout.', 'contempo'),
	      "params" => array(
	      	array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Layout", "contempo" ),
	            "param_name" => "layout",
	            "value" => array(
	            	"grid" => "Grid",
	            	"list" => "List",
            	),
	            "description" => __( "Choose the style of grid or list.", "contempo" )
			 ),
			 array(
			    "type" => "textfield",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Number", "contempo" ),
			    "param_name" => "number",
			    "value" => __( "3", "contempo" ),
			    "description" => __( "Enter the number to show.", "contempo" )
			 ),
			 array(
			    "type" => "dropdown",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Order", "contempo" ),
			    "param_name" => "order",
			    "value" => array(
			    	"ASC" => "ASC",
			    	"DESC" => "DESC",
				),
			    "description" => __( "Order ascending or descending.", "contempo" )
			 ),
			 array(
			    "type" => "dropdown",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Order By", "contempo" ),
			    "param_name" => "orderby",
			    "value" => array(
			    	"Date" => "date",
			    	"Meta (Price)" => "meta_value",
				),
			    "description" => __( "Order by Date or Price.", "contempo" )
			 ),
			 array(
			    "type" => "dropdown",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Meta Key", "contempo" ),
			    "param_name" => "meta_key",
			    "value" => array(
			    	"Date" => "",
			    	"Price" => "_ct_price",
				),
			    "description" => __( "If selected price above select Price here.", "contempo" )
			 ),
			 array(
			    "type" => "textfield",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Type", "contempo" ),
			    "param_name" => "type",
			    "value" => "",
			    "description" => __( "Enter the type, e.g. single-family-home, commercial.", "contempo" )
			 ),
			 array(
			    "type" => "textfield",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Beds", "contempo" ),
			    "param_name" => "beds",
			    "value" => "",
			    "description" => __( "Enter the beds, e.g. 2, 3, 4.", "contempo" )
			 ),
			 array(
			    "type" => "textfield",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Baths", "contempo" ),
			    "param_name" => "baths",
			    "value" => "",
			    "description" => __( "Enter the baths, e.g. 2, 3, 4.", "contempo" )
			 ),
			 array(
			    "type" => "textfield",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Status", "contempo" ),
			    "param_name" => "status",
			    "value" => "",
			    "description" => __( "Enter the status, e.g. for-sale, for-rent, open-house.", "contempo" )
			 ),
			 array(
			    "type" => "textfield",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "City", "contempo" ),
			    "param_name" => "city",
			    "value" => "",
			    "description" => __( "Enter the city, e.g. san-diego, los-angeles, new-york.", "contempo" )
			 ),
			 array(
			    "type" => "textfield",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "State", "contempo" ),
			    "param_name" => "state",
			    "value" => "",
			    "description" => __( "Enter the state, e.g. ca, tx, ny.", "contempo" )
			 ),
			 array(
			    "type" => "textfield",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Zip or Postcode", "contempo" ),
			    "param_name" => "zipcode",
			    "value" => "",
			    "description" => __( "Enter the zip or postcode, e.g. 92101, 92065, 94027.", "contempo" )
			 ),
			 array(
			    "type" => "textfield",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Country", "contempo" ),
			    "param_name" => "country",
			    "value" => "",
			    "description" => __( "Enter the country, e.g. usa, england, greece.", "contempo" )
			 ),
			 array(
			    "type" => "textfield",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Community", "contempo" ),
			    "param_name" => "community",
			    "value" => "",
			    "description" => __( "Enter the community, e.g. the-grand-estates, broadstone-apartments.", "contempo" )
			 ),
			 array(
			    "type" => "textfield",
			    "holder" => "div",
			    "class" => "",
			    "heading" => __( "Additional Features", "contempo" ),
			    "param_name" => "additional_features",
			    "value" => "",
			    "description" => __( "Enter the additional features, e.g. pool, gated, beach-frontage.", "contempo" )
			 )
	      )
	   ) );
	}
}

/*-----------------------------------------------------------------------------------*/
/* Listings Shortcode */
/*-----------------------------------------------------------------------------------*/

function ct_listings_grid_shortcode( $atts ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'orderby' => '',
			'order' => '',
			'meta_key' => '',
			'meta_type' => '',
			'layout' => '2',
			'type' => '',
			'beds' => '',
			'baths' => '',
			'status' => '',
			'city' => '',
			'state' => '',
			'zipcode' => '',
			'country' => '',
			'community' => '',
			'additional_features' => ''
		), $atts )
	);

	// Output
	echo '<ul class="col span_12 row first">';

		global $post;
		global $ct_options;

    	$args = array(
            'ct_status' => $status,
            'property_type' => $type,
            'beds' => $beds,
            'baths' => $baths,
            'city' => $city,
            'state' => $state,
            'zipcode' => $zipcode,
            'country' => $country,
            'community' => $community,
            'additional_features' => $additional_features,
            'post_type' => 'listings',
            'orderby' => $orderby,
			'order' => $order,
			'meta_key' => $meta_key,
			'meta_type' => 'numeric',
            'posts_per_page' => $layout
        );
        $wp_query = new wp_query( $args ); 
        
        $count = 0; if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();

        $city = strip_tags( get_the_term_list( $wp_query->post->ID, 'city', '', ', ', '' ) );
        $state = strip_tags( get_the_term_list( $wp_query->post->ID, 'state', '', ', ', '' ) );
        $zipcode = strip_tags( get_the_term_list( $wp_query->post->ID, 'zipcode', '', ', ', '' ) );
        $country = strip_tags( get_the_term_list( $wp_query->post->ID, 'country', '', ', ', '' ) );

        $beds = strip_tags( get_the_term_list( $wp_query->post->ID, 'beds', '', ', ', '' ) );
	    $baths = strip_tags( get_the_term_list( $wp_query->post->ID, 'baths', '', ', ', '' ) );

	    $ct_use_propinfo_icons = isset( $ct_options['ct_use_propinfo_icons'] ) ? esc_html( $ct_options['ct_use_propinfo_icons'] ) : '';
		$ct_search_results_listing_style = isset( $ct_options['ct_search_results_listing_style'] ) ? $ct_options['ct_search_results_listing_style'] : '';
		$ct_listing_stats_on_off = isset( $ct_options['ct_listing_stats_on_off'] ) ? esc_attr( $ct_options['ct_listing_stats_on_off'] ) : '';
	    
	    $ct_walkscore = isset( $ct_options['ct_enable_walkscore'] ) ? esc_html( $ct_options['ct_enable_walkscore'] ) : '';
	    $ct_rentals_booking = isset( $ct_options['ct_rentals_booking'] ) ? esc_html( $ct_options['ct_rentals_booking'] ) : '';
	    $ct_listing_reviews = isset( $ct_options['ct_listing_reviews'] ) ? esc_html( $ct_options['ct_listing_reviews'] ) : '';

	    if($ct_walkscore == 'yes') {
		    /* Walk Score */
		   	$latlong = get_post_meta($post->ID, "_ct_latlng", true);
		   	if($latlong != '') {
				list($lat, $long) = explode(',',$latlong,2);
				$address = get_the_title() . ct_taxonomy_return('city') . ct_taxonomy_return('state') . ct_taxonomy_return('zipcode');
				$json = ct_get_walkscore($lat,$long,$address);

				$ct_ws = json_decode($json);
			}
		}

        ?>
        
        <?php if($layout == '2') { ?>
        	<li class="listing col span_6 minimal <?php if($count == 0) { echo 'first'; } ?>">
    	<?php } elseif($layout == '3') { ?>
        	<li class="listing col <?php if($count == 0) { echo 'span_8 first'; } else { echo 'span_4'; } ?> minimal">
        <?php } elseif($layout == '4') { ?>
        	<li class="listing col span_6 minimal <?php if($count == 0 || $count == 2) { echo 'first'; } ?>">
	    <?php } elseif ($layout == '6') { ?>
        	<li class="listing col <?php if($count == 0 || $count == 1) { echo 'span_6'; } else { echo 'span_3'; } ?> minimal <?php if($count == 0 || $count == 2) { echo 'first'; } ?>">
         <?php } elseif ($layout == '7') { ?>
        	<li class="listing col <?php if($count == 0 || $count == 1 || $count == 2) { echo 'span_4'; } else { echo 'span_3'; } ?> minimal <?php if($count == 0 || $count == 3) { echo 'first'; } ?>">
        <?php } elseif($layout == '8') { ?>
        	<li class="listing col span_3 minimal <?php if($count == 0 || $count == 4) { echo 'first'; } ?>">
        <?php } ?>

            <figure>
                <?php
	                $status_tags = strip_tags( get_the_term_list( $wp_query->post->ID, 'ct_status', '', ' ', '' ) );
					if($status_tags != '') {
						echo '<h6 class="snipe ';
								$status_terms = get_the_terms( $wp_query->post->ID, 'ct_status', array() );
								if ( ! empty( $status_terms ) && ! is_wp_error( $status_terms ) ){
								     foreach ( $status_terms as $term ) {
								       echo esc_html($term->slug) . ' ';
								     }
								 }
							echo '">';
							echo '<span>';
								echo esc_html($status_tags);
							echo '</span>';
						echo '</h6>';
					}
                ?>
                <?php if( function_exists('ct_property_type_icon') ) {
                	ct_property_type_icon();
            	} ?>
                <?php if(function_exists('wpfp_link') || class_exists('Redq_Alike')) {
						echo '<ul class="listing-actions">';
							
							if (function_exists('wpfp_link')) {
								echo '<li>';
									echo '<span class="save-this" data-tooltip="' . __('Favorite','contempo') . '">';
										wpfp_link();
									echo '</span>';
								echo '</li>';
							}

							if(class_exists('Redq_Alike')) {
								echo '<li>';
									echo '<span class="compare-this" data-tooltip="' . __('Compare','contempo') . '">';
										echo do_shortcode('[alike_link vlaue="compare" show_icon="true" icon_class="fa fa-plus-square-o"]');
									echo '</span>';
								echo '</li>';
							}

							if(function_exists('ct_get_listing_views') && $ct_listing_stats_on_off != 'no') {
								echo '<li>';
									echo '<span class="listing-views" data-tooltip="' . ct_get_listing_views(get_the_ID()) . __(' Views','contempo') . '">';
										echo '<i class="fa fa-bar-chart"></i>';
									echo '</span>';
								echo '</li>';
							}

						echo '</ul>';
					} ?>
                <?php if( function_exists('ct_first_image_linked') ) {
                	ct_first_image_linked();
                } ?>
            </figure>
            <div class="grid-listing-info">
	            <header>
	                <h5 class="marB0"><a href="<?php the_permalink(); ?>"><?php if( function_exists('ct_listing_title') ) { ct_listing_title(); } ?></a></h5>
	                <p class="location muted marB0"><?php echo esc_html($city); ?>, <?php echo esc_html($state); ?> <?php echo esc_html($zipcode); ?> <?php echo esc_html($country); ?></p>
                </header>
                <p class="price marB0"><?php if( function_exists('ct_listing_price') ) { ct_listing_price(); } ?></p>
	            <div class="propinfo">
	            	<p><?php if( function_exists('ct_excerpt') ) { echo ct_excerpt(25); } ?></p>
	                <ul class="marB0">
						<?php

					    if(ct_has_type('commercial') || ct_has_type('lot') || ct_has_type('land')) { 
					        // Dont Display Bed/Bath
					    } else {
					    	if(!empty($beds)) {
						    	echo '<li class="row beds">';
						    		echo '<span class="muted left">';
						    			if($ct_use_propinfo_icons != 'icons') {
							    			_e('Bed', 'contempo');
							    		} else {
							    			echo '<i class="fa fa-bed"></i>';
							    		}
						    		echo '</span>';
						    		echo '<span class="right">';
						               echo $beds;
						            echo '</span>';
						        echo '</li>';
						    }	
						    if(!empty($baths)) {
						        echo '<li class="row baths">';
						            echo '<span class="muted left">';
						    			if($ct_use_propinfo_icons != 'icons') {
							    			_e('Baths', 'contempo');
							    		} else {
							    			ct_bath_icon();
							    		}
						    		echo '</span>';
						    		echo '<span class="right">';
						               echo $baths;
						            echo '</span>';
						        echo '</li>';
						    }
					    }

					    if($ct_walkscore == 'yes') {
						    if(!empty($ct_ws->walkscore)) {
							    echo '<li class="row walkscore">';
									echo '<span class="muted left">';
										_e('Walk Score&reg;', 'contempo');
									echo '</span>';
									echo '<span class="right">';
										echo '<a class="tooltips" href=" ' . $ct_ws->ws_link , '" target="_blank">';
									        echo $ct_ws->walkscore;
									        echo '<span>' . $ct_ws->description. '</span>';
								        echo '</a>';
							        echo '</span>';
							    echo '</li>';
							}
						}

						include_once ABSPATH . 'wp-admin/includes/plugin.php';
						if($ct_listing_reviews == 'yes' || is_plugin_active('comments-ratings/comments-ratings.php')) {
							global $pixreviews_plugin;
							$ct_rating_avg = $pixreviews_plugin->get_average_rating();
							if($ct_rating_avg != '') {
								echo '<li class="row rating">';
						            echo '<span class="muted left">';
						                if($ct_use_propinfo_icons != 'icons') {
							    			_e('Rating', 'contempo');
							    		} else {
							    			echo '<i class="fa fa-star"></i>';
							    		}
						            echo '</span>';
						            echo '<span class="right">';
						                 echo $pixreviews_plugin->get_average_rating();
						            echo '</span>';
						        echo '</li>';
						    }
						}

					    include_once ABSPATH . 'wp-admin/includes/plugin.php';
						if($ct_rentals_booking == 'yes' || is_plugin_active('booking/wpdev-booking.php')) {
						    if(get_post_meta($post->ID, "_ct_rental_guests", true)) {
						        echo '<li class="row guests">';
						            echo '<span class="muted left">';
						                if($ct_use_propinfo_icons != 'icons') {
							    			_e('Guests', 'contempo');
							    		} else {
							    			echo '<i class="fa fa-group"></i>';
							    		}
						            echo '</span>';
						            echo '<span class="right">';
						                 echo get_post_meta($post->ID, "_ct_rental_guests", true);
						            echo '</span>';
						        echo '</li>';
						    }

						    if(get_post_meta($post->ID, "_ct_rental_min_stay", true)) {
						        echo '<li class="row min-stay">';
						            echo '<span class="muted left">';
						                if($ct_use_propinfo_icons != 'icons') {
							    			_e('Min Stay', 'contempo');
							    		} else {
							    			echo '<i class="fa fa-calendar"></i>';
							    		}
						            echo '</span>';
						            echo '<span class="right">';
						                 echo get_post_meta($post->ID, "_ct_rental_min_stay", true);
						            echo '</span>';
						        echo '</li>';
						    }
						}
					    
					    if(get_post_meta($post->ID, "_ct_sqft", true)) {
					    	if($ct_use_propinfo_icons != 'icons') {
						        echo '<li class="row sqft">';
						            echo '<span class="muted left">';
						    			ct_sqftsqm();
						    		echo '</span>';
						    		echo '<span class="right">';
						                 echo get_post_meta($post->ID, "_ct_sqft", true);
						            echo '</span>';
						        echo '</li>';
						    } else {
						    	echo '<li class="row sqft">';
						            echo '<span class="muted left">';
										ct_listing_size_icon();
						    		echo '</span>';
						    		echo '<span class="right">';
						                 echo get_post_meta($post->ID, "_ct_sqft", true);
						                 echo ' ' . ct_sqftsqm();
						            echo '</span>';
						        echo '</li>';
						    }
					    }
					    
					    if(get_post_meta($post->ID, "_ct_lotsize", true)) {
					        if(get_post_meta($post->ID, "_ct_sqft", true)) {
					            echo '<li class="row lotsize">';
					        }
					            echo '<span class="muted left">';
					    			if($ct_use_propinfo_icons != 'icons') {
						    			_e('Lot Size', 'contempo');
						    		} else {
						    			echo '<i class="fa fa-arrows-alt"></i>';
						    		}
					    		echo '</span>';
					    		echo '<span class="right">';
					                 echo get_post_meta($post->ID, "_ct_lotsize", true) . ' ';
					                 ct_acres();
					            echo '</span>';
					            
					        if((get_post_meta($post->ID, "_ct_sqft", true))) {
					            echo '</li>';
					        }
					    } ?>
                    </ul>
                </div>
            </div>
	
        </li>
        
        <?php
		
		$count++;
		
		if($count === 1) {
			//echo '<div class="clear"></div>';
		}

		if($layout == '2' && $count == '2') {
        	echo '<div class="clear"></div>';
        } elseif($layout == '3' && $count == '3') {
        	echo '<div class="clear"></div>';
        } elseif($layout == '4' && $count == '4') {
        	echo '<div class="clear"></div>';
	    } elseif ($layout == '6' && $count == '6') {
        	echo '<div class="clear"></div>';
        } elseif ($layout == '7' && $count == '7') {
        	echo '<div class="clear"></div>';
        } elseif($layout == '8' && $count == '4') {
        	echo '<div class="clear"></div>';
        }
		
		endwhile; endif;
		wp_reset_postdata();

	echo '</ul>';
	    echo '<div class="clear"></div>';
	
}
add_shortcode( 'ct-listings-grid', 'ct_listings_grid_shortcode' );

/*-----------------------------------------------------------------------------------*/
/* Add Listings Shortcode to Visual Composer if the plugin is enabled */
/*-----------------------------------------------------------------------------------*/

include_once ABSPATH . 'wp-admin/includes/plugin.php';
if(is_plugin_active('js_composer/js_composer.php')) {

	add_action( 'vc_before_init', 'ct_listings_grid_integrateWithVC' );
	function ct_listings_grid_integrateWithVC() {
	   vc_map( array(
	      "name" => __( "CT Listings Minimal Grid", "contempo" ),
	      "base" => "ct-listings-grid",
	      "class" => "",
	      "category" => __( "CT Modules", "contempo"),
	      'description' => __( 'Display listings items in a beautiful minimal style grid layout.', 'contempo'),
	      "params" => array(
	         array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Layout", "contempo" ),
	            "param_name" => "layout",
	            "value" => array(
	            	"2" => "2",
	            	"3" => "3",
	            	"4" => "4",
	            	"6" => "6",
	            	"7" => "7",
	            	"8" => "8",
            	),
	            "description" => __( "Choose the grid layout you'd like to use.", "contempo" )
	         ),
	         array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Order", "contempo" ),
	            "param_name" => "order",
	            "value" => array(
	            	"ASC" => "ASC",
	            	"DESC" => "DESC",
            	),
	            "description" => __( "Order ascending or descending.", "contempo" )
	         ),
	         array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Order By", "contempo" ),
	            "param_name" => "orderby",
	            "value" => array(
	            	"Date" => "date",
	            	"Meta (Price)" => "meta_value",
            	),
	            "description" => __( "Order by Date or Price.", "contempo" )
	         ),
	         array(
	            "type" => "dropdown",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Meta Key", "contempo" ),
	            "param_name" => "meta_key",
	            "value" => array(
	            	"Date" => "",
	            	"Price" => "_ct_price",
            	),
	            "description" => __( "If selected price above select Price here.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Type", "contempo" ),
	            "param_name" => "type",
	            "value" => "",
	            "description" => __( "Enter the type, e.g. single-family-home, commercial.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Beds", "contempo" ),
	            "param_name" => "beds",
	            "value" => "",
	            "description" => __( "Enter the beds, e.g. 2, 3, 4.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Baths", "contempo" ),
	            "param_name" => "baths",
	            "value" => "",
	            "description" => __( "Enter the baths, e.g. 2, 3, 4.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Status", "contempo" ),
	            "param_name" => "status",
	            "value" => "",
	            "description" => __( "Enter the status, e.g. for-sale, for-rent, open-house.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "City", "contempo" ),
	            "param_name" => "city",
	            "value" => "",
	            "description" => __( "Enter the city, e.g. san-diego, los-angeles, new-york.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "State", "contempo" ),
	            "param_name" => "state",
	            "value" => "",
	            "description" => __( "Enter the state, e.g. ca, tx, ny.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Zip or Postcode", "contempo" ),
	            "param_name" => "zipcode",
	            "value" => "",
	            "description" => __( "Enter the zip or postcode, e.g. 92101, 92065, 94027.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Country", "contempo" ),
	            "param_name" => "country",
	            "value" => "",
	            "description" => __( "Enter the country, e.g. usa, england, greece.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Community", "contempo" ),
	            "param_name" => "community",
	            "value" => "",
	            "description" => __( "Enter the community, e.g. the-grand-estates, broadstone-apartments.", "contempo" )
	         ),
	         array(
	            "type" => "textfield",
	            "holder" => "div",
	            "class" => "",
	            "heading" => __( "Additional Features", "contempo" ),
	            "param_name" => "additional_features",
	            "value" => "",
	            "description" => __( "Enter the additional features, e.g. pool, gated, beach-frontage.", "contempo" )
	         )
	      )
	   ) );
	}
}

if(version_compare(PHP_VERSION, '5.6.0') >= 0) {

	/*-----------------------------------------------------------------------------------*/
	/* Info Grid 3 Shortcode */
	/*-----------------------------------------------------------------------------------*/

	function ct_info_grid_three_shortcode( $atts ) {

		// Attributes
		extract( shortcode_atts(
			array(
				'ct_item_title_one' => '',
				'ct_item_link_one' => '',
				'ct_item_description_one' => '',
				'ct_item_image_one' => '',
				'ct_item_title_two' => '',
				'ct_item_link_two' => '',
				'ct_item_description_two' => '',
				'ct_item_image_two' => '',
				'ct_item_title_three' => '',
				'ct_item_link_three' => '',
				'ct_item_description_three' => '',
				'ct_item_image_three' => '',
			), $atts )
		);

		// Output
		$output = '<ul class="item-grid grid-three-item">';
			$output .= '<li class="grid-item col span_8 first">';
				$output .= '<a href="' . $ct_item_link_one . '">';
					$output .= '<figure>';
						$output .= '<img src="' . wp_get_attachment_image_src($ct_item_image_one, 'full')[0] . '" / >';
					$output .= '</figure>';
					$output .= '<div class="grid-item-info">';
						$output .= '<h4>' . $ct_item_title_one . '</h4>';
						$output .= '<p>' . stripslashes($ct_item_description_one) . '</p>';
					$output .= '</div>';
				$output .= '</a>';
			$output .= '</li>';
			$output .= '<li class="grid-item col span_4">';
				$output .= '<a href="' . $ct_item_link_two . '">';
					$output .= '<figure>';
						$output .= '<img src="' . wp_get_attachment_image_src($ct_item_image_two, 'full')[0] . '" / >';
					$output .= '</figure>';
					$output .= '<div class="grid-item-info">';
						$output .= '<h4>' . $ct_item_title_two . '</h4>';
						$output .= '<p>' . stripslashes($ct_item_description_two) . '</p>';
					$output .= '</div>';
				$output .= '</a>';
			$output .= '</li>';
			$output .= '<li class="grid-item col span_4">';
				$output .= '<a href="' . $ct_item_link_three . '">';
					$output .= '<figure>';
						$output .= '<img src="' . wp_get_attachment_image_src($ct_item_image_three, 'full')[0] . '" / >';
					$output .= '</figure>';
					$output .= '<div class="grid-item-info">';
						$output .= '<h4>' . $ct_item_title_three . '</h4>';
						$output .= '<p>' . stripslashes($ct_item_description_three) . '</p>';
					$output .= '</div>';
				$output .= '</a>';
			$output .= '</li>';
				$output .= '<div class="clear"></div>';
		$output .= '</ul>';	

		return $output;
		
	}
	add_shortcode( 'ct-info-grid-three', 'ct_info_grid_three_shortcode' );

	/*-----------------------------------------------------------------------------------*/
	/* Add Info Grid 3 Shortcode to Visual Composer if the plugin is enabled */
	/*-----------------------------------------------------------------------------------*/

	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if(is_plugin_active('js_composer/js_composer.php')) {

		add_action( 'vc_before_init', 'ct_info_grid_three_integrateWithVC' );
		function ct_info_grid_three_integrateWithVC() {
			$ct_prefix = 'ct_';
			vc_map( array(
			  'name' => __( 'CT 3 Item Grid', 'contempo' ),
			  'description' => __( 'Display any three content items in a beautiful grid layout.', 'contempo'),
			  'base' => 'ct-info-grid-three',
			  'class' => '',
			  'category' => __( 'CT Modules', 'contempo'),
			  'params' => array(
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Title', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_title_one',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the title here.', 'contempo' ),
			        'group' => 'item_1'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Link', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_link_one',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the URL here, e.g. http://yourlink.com', 'contempo' ),
			        'group' => 'item_1'
			    ),
			    array(
			        'type' => 'textarea',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Description', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_description_one',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the description here.', 'contempo' ),
			        'group' => 'item_1'
			    ),
	 		    array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Image', 'contempo' ),
					'param_name' => $ct_prefix . 'item_image_one',
					'value' => __( '', 'contempo' ),
					'description' => __( 'Upload an image here.', 'contempo' ),
					'group' => 'item_1'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Title', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_title_two',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the title here.', 'contempo' ),
			        'group' => 'item_2'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Link', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_link_two',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the URL here, e.g. http://yourlink.com', 'contempo' ),
			        'group' => 'item_2'
			    ),
			    array(
			        'type' => 'textarea',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Description', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_description_two',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the description here.', 'contempo' ),
			        'group' => 'item_2'
			    ),
	 		    array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Image', 'contempo' ),
					'param_name' => $ct_prefix . 'item_image_two',
					'value' => __( '', 'contempo' ),
					'description' => __( 'Upload an image here.', 'contempo' ),
					'group' => 'item_2'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Title', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_title_three',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the title here.', 'contempo' ),
			        'group' => 'item_3'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Link', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_link_three',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the URL here, e.g. http://yourlink.com', 'contempo' ),
			        'group' => 'item_3'
			    ),
			    array(
			        'type' => 'textarea',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Description', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_description_three',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the description here.', 'contempo' ),
			        'group' => 'item_3'
			    ),
	 		    array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Image', 'contempo' ),
					'param_name' => $ct_prefix . 'item_image_three',
					'value' => __( '', 'contempo' ),
					'description' => __( 'Upload an image here.', 'contempo' ),
					'group' => 'item_3'
			    ),
			  )
			) );
		}
	}

	/*-----------------------------------------------------------------------------------*/
	/* Info Grid 6 Shortcode */
	/*-----------------------------------------------------------------------------------*/

	function ct_info_grid_six_shortcode( $atts ) {

		// Attributes
		extract( shortcode_atts(
			array(
				'ct_item_title_one' => '',
				'ct_item_link_one' => '',
				'ct_item_description_one' => '',
				'ct_item_image_one' => '',
				'ct_item_title_two' => '',
				'ct_item_link_two' => '',
				'ct_item_description_two' => '',
				'ct_item_image_two' => '',
				'ct_item_title_three' => '',
				'ct_item_link_three' => '',
				'ct_item_description_three' => '',
				'ct_item_image_three' => '',
				'ct_item_title_four' => '',
				'ct_item_link_four' => '',
				'ct_item_description_four' => '',
				'ct_item_image_four' => '',
				'ct_item_title_five' => '',
				'ct_item_link_five' => '',
				'ct_item_description_five' => '',
				'ct_item_image_five' => '',
				'ct_item_title_six' => '',
				'ct_item_link_six' => '',
				'ct_item_description_six' => '',
				'ct_item_image_six' => '',
			), $atts )
		);

		// Output
		$output = '<ul class="item-grid grid-six-item">';
			$output .= '<li class="grid-item col span_8 first">';
				$output .= '<a href="' . $ct_item_link_one . '">';
					$output .= '<figure>';
						$output .= '<img src="' . wp_get_attachment_image_src($ct_item_image_one, 'full')[0] . '" / >';
					$output .= '</figure>';
					$output .= '<div class="grid-item-info">';
						$output .= '<h4>' . $ct_item_title_one . '</h4>';
						$output .= '<p>' . stripslashes($ct_item_description_one) . '</p>';
					$output .= '</div>';
				$output .= '</a>';
			$output .= '</li>';
			$output .= '<li class="grid-item col span_4">';
				$output .= '<a href="' . $ct_item_link_two . '">';
					$output .= '<figure>';
						$output .= '<img src="' . wp_get_attachment_image_src($ct_item_image_two, 'full')[0] . '" / >';
					$output .= '</figure>';
					$output .= '<div class="grid-item-info">';
						$output .= '<h4>' . $ct_item_title_two . '</h4>';
						$output .= '<p>' . stripslashes($ct_item_description_two) . '</p>';
					$output .= '</div>';
				$output .= '</a>';
			$output .= '</li>';
			$output .= '<li class="grid-item col span_4">';
				$output .= '<a href="' . $ct_item_link_three . '">';
					$output .= '<figure>';
						$output .= '<img src="' . wp_get_attachment_image_src($ct_item_image_three, 'full')[0] . '" / >';
					$output .= '</figure>';
					$output .= '<div class="grid-item-info">';
						$output .= '<h4>' . $ct_item_title_three . '</h4>';
						$output .= '<p>' . stripslashes($ct_item_description_three) . '</p>';
					$output .= '</div>';
				$output .= '</a>';
			$output .= '</li>';
				$output .= '<div class="clear"></div>';
			$output .= '<div class="col span_4 first">';
				$output .= '<li class="grid-item col span_12 first">';
					$output .= '<a href="' . $ct_item_link_four . '">';
						$output .= '<figure>';
							$output .= '<img src="' . wp_get_attachment_image_src($ct_item_image_four, 'full')[0] . '" / >';
						$output .= '</figure>';
						$output .= '<div class="grid-item-info">';
							$output .= '<h4>' . $ct_item_title_four . '</h4>';
							$output .= '<p>' . stripslashes($ct_item_description_four) . '</p>';
						$output .= '</div>';
					$output .= '</a>';
				$output .= '</li>';
				$output .= '<li class="grid-item col span_12 first">';
					$output .= '<a href="' . $ct_item_link_five . '">';
						$output .= '<figure>';
							$output .= '<img src="' . wp_get_attachment_image_src($ct_item_image_five, 'full')[0] . '" / >';
						$output .= '</figure>';
						$output .= '<div class="grid-item-info">';
							$output .= '<h4>' . $ct_item_title_five . '</h4>';
							$output .= '<p>' . stripslashes($ct_item_description_five) . '</p>';
						$output .= '</div>';
					$output .= '</a>';
				$output .= '</li>';
			$output .= '</div>';
			$output .= '<div class="col span_8">';
				$output .= '<li class="grid-item col span_12 first">';
					$output .= '<a href="' . $ct_item_link_six . '">';
						$output .= '<figure>';
							$output .= '<img src="' . wp_get_attachment_image_src($ct_item_image_six, 'full')[0] . '" / >';
						$output .= '</figure>';
						$output .= '<div class="grid-item-info">';
							$output .= '<h4>' . $ct_item_title_six . '</h4>';
							$output .= '<p>' . stripslashes($ct_item_description_six) . '</p>';
						$output .= '</div>';
					$output .= '</a>';
				$output .= '</li>';
			$output .= '</div>';
				$output .= '<div class="clear"></div>';
		$output .= '</ul>';	

		return $output;
		
	}
	add_shortcode( 'ct-info-grid-six', 'ct_info_grid_six_shortcode' );

	/*-----------------------------------------------------------------------------------*/
	/* Add Info Grid 3 Shortcode to Visual Composer if the plugin is enabled */
	/*-----------------------------------------------------------------------------------*/

	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if(is_plugin_active('js_composer/js_composer.php')) {

		add_action( 'vc_before_init', 'ct_info_grid_six_integrateWithVC' );
		function ct_info_grid_six_integrateWithVC() {
			$ct_prefix = 'ct_';
			vc_map( array(
			  'name' => __( 'CT 6 Item Grid', 'contempo' ),
			  'description' => __( 'Display any six content items in a beautiful grid layout.', 'contempo'),
			  'base' => 'ct-info-grid-six',
			  'class' => '',
			  'category' => __( 'CT Modules', 'contempo'),
			  'params' => array(
			  	// Item 1
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Title', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_title_one',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the title here.', 'contempo' ),
			        'group' => 'item_1'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Link', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_link_one',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the URL here, e.g. http://yourlink.com', 'contempo' ),
			        'group' => 'item_1'
			    ),
			    array(
			        'type' => 'textarea',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Description', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_description_one',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the description here.', 'contempo' ),
			        'group' => 'item_1'
			    ),
	 		    array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Image', 'contempo' ),
					'param_name' => $ct_prefix . 'item_image_one',
					'value' => __( '', 'contempo' ),
					'description' => __( 'Upload an image here.', 'contempo' ),
					'group' => 'item_1'
			    ),
			    // Item 2
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Title', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_title_two',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the title here.', 'contempo' ),
			        'group' => 'item_2'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Link', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_link_two',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the URL here, e.g. http://yourlink.com', 'contempo' ),
			        'group' => 'item_2'
			    ),
			    array(
			        'type' => 'textarea',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Description', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_description_two',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the description here.', 'contempo' ),
			        'group' => 'item_2'
			    ),
	 		    array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Image', 'contempo' ),
					'param_name' => $ct_prefix . 'item_image_two',
					'value' => __( '', 'contempo' ),
					'description' => __( 'Upload an image here.', 'contempo' ),
					'group' => 'item_2'
			    ),
			    // Item 3
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Title', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_title_three',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the title here.', 'contempo' ),
			        'group' => 'item_3'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Link', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_link_three',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the URL here, e.g. http://yourlink.com', 'contempo' ),
			        'group' => 'item_3'
			    ),
			    array(
			        'type' => 'textarea',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Description', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_description_three',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the description here.', 'contempo' ),
			        'group' => 'item_3'
			    ),
	 		    array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Image', 'contempo' ),
					'param_name' => $ct_prefix . 'item_image_three',
					'value' => __( '', 'contempo' ),
					'description' => __( 'Upload an image here.', 'contempo' ),
					'group' => 'item_3'
			    ),
			    // Item 4
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Title', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_title_four',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the title here.', 'contempo' ),
			        'group' => 'item_4'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Link', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_link_four',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the URL here, e.g. http://yourlink.com', 'contempo' ),
			        'group' => 'item_4'
			    ),
			    array(
			        'type' => 'textarea',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Description', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_description_four',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the description here.', 'contempo' ),
			        'group' => 'item_4'
			    ),
	 		    array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Image', 'contempo' ),
					'param_name' => $ct_prefix . 'item_image_four',
					'value' => __( '', 'contempo' ),
					'description' => __( 'Upload an image here.', 'contempo' ),
					'group' => 'item_4'
			    ),
			    // Item 5
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Title', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_title_five',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the title here.', 'contempo' ),
			        'group' => 'item_5'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Link', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_link_five',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the URL here, e.g. http://yourlink.com', 'contempo' ),
			        'group' => 'item_5'
			    ),
			    array(
			        'type' => 'textarea',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Description', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_description_five',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the description here.', 'contempo' ),
			        'group' => 'item_5'
			    ),
	 		    array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Image', 'contempo' ),
					'param_name' => $ct_prefix . 'item_image_five',
					'value' => __( '', 'contempo' ),
					'description' => __( 'Upload an image here.', 'contempo' ),
					'group' => 'item_5'
			    ),
			    // Item 6
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Title', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_title_six',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the title here.', 'contempo' ),
			        'group' => 'item_6'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Link', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_link_six',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the URL here, e.g. http://yourlink.com', 'contempo' ),
			        'group' => 'item_6'
			    ),
			    array(
			        'type' => 'textarea',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Description', 'contempo' ),
			        'param_name' => $ct_prefix . 'item_description_six',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the description here.', 'contempo' ),
			        'group' => 'item_6'
			    ),
	 		    array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Image', 'contempo' ),
					'param_name' => $ct_prefix . 'item_image_six',
					'value' => __( '', 'contempo' ),
					'description' => __( 'Upload an image here.', 'contempo' ),
					'group' => 'item_6'
			    ),
			  )
			) );
		}
	}
}

if(version_compare(PHP_VERSION, '5.6.0') >= 0) {

	/*-----------------------------------------------------------------------------------*/
	/* Agent Shortcode */
	/*-----------------------------------------------------------------------------------*/

	function ct_agent_shortcode( $atts ) {

		// Attributes
		extract( shortcode_atts(
			array(
				'ct_agent_name' => '',
				'ct_agent_title' => '',
				'ct_agent_link' => '',
				'ct_agent_description' => '',
				'ct_agent_image' => '',
			), $atts )
		);

		$href = vc_build_link($ct_agent_link);

		// Output
		$output = '<div class="vc-agent">';
			if($href['url'] !='' && $href['target'] != '') {
				$output .= '<a href="' . $href['url'] . '" title="' . $href['title'] . '" target="' . $href['target'] . '">';
			} elseif($href['url'] != '') {
				$output .= '<a href="' . $href['url'] . '" title="' . $href['title'] . '">';
			}
				if(!empty($ct_agent_image)) {
					$output .= '<figure>';
						$output .= '<img src="' . wp_get_attachment_image_src($ct_agent_image, 'full')[0] . '" alt="' . $ct_agent_name . '" />';
					$output .= '</figure>';
				}
			if($href['url'] !='') {
				$output .= '</a>';
			}
				$output .= '<div class="vc-agent-info">';

					if(!empty($ct_agent_name) || !empty($ct_agent_title)) {
						$output .= '<header>';
					}

						if($href['url'] !='' && $href['target'] != '') {
							$output .= '<a href="' . $href['url'] . '" title="' . $href['title'] . '" target="' . $href['target'] . '">';
						} elseif($href['url'] != '') {
							$output .= '<a href="' . $href['url'] . '" title="' . $href['title'] . '">';
						}
							if(!empty($ct_agent_name)) {
								$output .= '<h4>' . $ct_agent_name . '</h4>';
							}
						if($href['url'] !='') {
							$output .= '</a>';
						}
						if(!empty($ct_agent_title)) {
							$output .= '<h6 class="muted">' . $ct_agent_title . '</h6>';
						}

					if(!empty($ct_agent_name) || !empty($ct_agent_title)) {
						$output .= '</header>';
					}

					if(!empty($ct_agent_description)) {
						$output .= '<p>' . stripslashes($ct_agent_description) . '</p>';
					}
					if($href['url'] !='' && $href['target'] != '') {
						$output .= '<a class="btn" href="' . $href['url'] . '" title="' . $href['title'] . '" target="' . $href['target'] . '">';
					} elseif($href['url'] != '') {
						$output .= '<a class="btn" href="' . $href['url'] . '" title="' . $href['title'] . '">';
					}
						$output .= __('View Profile', 'contempo');

					if($href['url'] !='') {
						$output .= '</a>';
					}

				$output .= '</div>';
			$output .= '</a>';
		$output .= '</div>';

		return $output;
		
	}
	add_shortcode( 'ct-agent', 'ct_agent_shortcode' );

	/*-----------------------------------------------------------------------------------*/
	/* Add Info Grid 3 Shortcode to Visual Composer if the plugin is enabled */
	/*-----------------------------------------------------------------------------------*/

	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if(is_plugin_active('js_composer/js_composer.php')) {

		add_action( 'vc_before_init', 'ct_agent_integrateWithVC' );
		function ct_agent_integrateWithVC() {
			$ct_prefix = 'ct_';
			vc_map( array(
			  'name' => __( 'CT Agent', 'contempo' ),
			  'description' => __( 'Display your agents image, name, title &amp; description with a link to their profile.', 'contempo'),
			  'base' => 'ct-agent',
			  'class' => '',
			  'category' => __( 'CT Modules', 'contempo'),
			  'params' => array(
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Name', 'contempo' ),
			        'param_name' => $ct_prefix . 'agent_name',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the name here.', 'contempo' ),
			        'group' => 'agent'
			    ),
			    array(
			        'type' => 'textfield',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Title', 'contempo' ),
			        'param_name' => $ct_prefix . 'agent_title',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the title here.', 'contempo' ),
			        'group' => 'agent'
			    ),
			    array(
			        'type' => 'vc_link',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Link', 'contempo' ),
			        'param_name' => $ct_prefix . 'agent_link',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the URL here, e.g. http://yourlink.com', 'contempo' ),
			        'group' => 'agent'
			    ),
			    array(
			        'type' => 'textarea',
			        'holder' => 'div',
			        'class' => '',
			        'heading' => __( 'Description', 'contempo' ),
			        'param_name' => $ct_prefix . 'agent_description',
			        'value' => __( '', 'contempo' ),
			        'description' => __( 'Enter the description here.', 'contempo' ),
			        'group' => 'agent'
			    ),
	 		    array(
					'type' => 'attach_image',
					'holder' => 'div',
					'class' => '',
					'heading' => __( 'Image', 'contempo' ),
					'param_name' => $ct_prefix . 'agent_image',
					'value' => __( '', 'contempo' ),
					'description' => __( 'Upload an image here.', 'contempo' ),
					'group' => 'agent'
			    ),
			  )
			) );
		}
	}
}

?>