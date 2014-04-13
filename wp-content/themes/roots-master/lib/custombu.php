<?php

/* ---------------------------------------------------------------------- */
/*	Portfolio
/* ---------------------------------------------------------------------- */

// Register Custom Post Type: 'Portfolio'
function ss_framework_register_post_type_slider() {

	$labels = array(
		'name'               => __( 'Slider', 'ss_framework' ),
		'singular_name'      => __( 'Project', 'ss_framework' ),
		'add_new'            => __( 'Add New', 'ss_framework' ),
		'add_new_item'       => __( 'Add New Project', 'ss_framework' ),
		'edit_item'          => __( 'Edit Project', 'ss_framework' ),
		'new_item'           => __( 'New Project', 'ss_framework' ),
		'view_item'          => __( 'View Project', 'ss_framework' ),
		'search_items'       => __( 'Search Projects', 'ss_framework' ),
		'not_found'          => __( 'No projects found', 'ss_framework' ),
		'not_found_in_trash' => __( 'No projects found in Trash', 'ss_framework' ),
		'parent_item_colon'  => __( 'Parent Project:', 'ss_framework' ),
		'menu_name'          => __( 'Slider', 'ss_framework' ),
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'          => array( 'slider-categories' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array( 'slug' => 'slider-item' ),
		'capability_type'     => 'post',
		'menu_position'       => null,
		'menu_icon'           => SS_BASE_URL . 'functions/assets/img/icon-portfolio.png'
	);

	register_post_type( 'slider', $args );

} 
add_action('init', 'ss_framework_register_post_type_slider');

// Register Taxonomy: 'Categories'
function ss_framework_register_taxonomy_categories() {

	$labels = array(
		'name'                       => __( 'Categories', 'ss_framework' ),
		'singular_name'              => __( 'Category', 'ss_framework' ),
		'search_items'               => __( 'Search Categories', 'ss_framework' ),
		'popular_items'              => __( 'Popular Categories', 'ss_framework' ),
		'all_items'                  => __( 'All Categories', 'ss_framework' ),
		'parent_item'                => __( 'Parent Category', 'ss_framework' ),
		'parent_item_colon'          => __( 'Parent Category:', 'ss_framework' ),
		'edit_item'                  => __( 'Edit Category', 'ss_framework' ),
		'update_item'                => __( 'Update Category', 'ss_framework' ),
		'add_new_item'               => __( 'Add New Category', 'ss_framework' ),
		'new_item_name'              => __( 'New Category', 'ss_framework' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'ss_framework' ),
		'add_or_remove_items'        => __( 'Add or remove Categories', 'ss_framework' ),
		'choose_from_most_used'      => __( 'Choose from most used Categories', 'ss_framework' ),
		'menu_name'                  => __( 'Categories', 'ss_framework' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'slider-category' ),
		'query_var'         => true
	);

	register_taxonomy( 'slider-categories', array('slider'), $args );

} 
add_action( 'init', 'ss_framework_register_taxonomy_categories' );

// Custom colums for 'slider'
function ss_framework_edit_slider_columns() {

	$columns = array(
		'cb'                   => '<input type="checkbox" />',
		'title'                => __( 'Name', 'ss_framework' ),
		'slider-categories' => __( 'Categories', 'ss_framework' ),
		'date'                 => __( 'Date', 'ss_framework' )
              //  'slide_count' => __( 'Slide Count', 'ss_framework' ),
		//'shortcode'   => __( 'Shortcode', 'ss_framework' )
	);

	return $columns;

}
add_action('manage_edit-slider_columns', 'ss_framework_edit_slider_columns');

// Custom colums content for 'Portfolio'
function ss_framework_manage_slider_columns( $column, $post_id ) {

	global $post;

	switch ( $column ) {


		case 'slider-categories':

			$terms = get_the_terms( $post_id, 'slider-categories' );

			if ( empty( $terms ) )
				break;

				$out = array();

				foreach ( $terms as $term ) {
					
					$out[] = sprintf( '<a href="%s">%s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'slider-categories' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'slider-categories', 'display' ) )
					);

				}

				echo join( ', ', $out );

			break;
                        
/*
		case 'shortcode':
			
			echo '<span class="shortcode-field">[slider id="'. $post->post_name . '"]</span>';

			break;*/
		
		default:
			break;
	}

}
add_action('manage_slider_posts_custom_column', 'ss_framework_manage_slider_columns', 10, 2);
/*
if ( ! function_exists( 'Sliders' ) ) :
function unregister_post_type( $post_type ) {
    global $wp_post_types;
    if ( isset( $wp_post_types[ $post_type ] ) ) {
        unset( $wp_post_types[ $post_type ] );
        return true;
    }
    return false;
}
endif;
*/