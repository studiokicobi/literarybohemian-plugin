<?php

/*
Plugin Name: Custom Functions for The Literary Bohemian
*/


/* Add Adobe fonts: Grad, three weights, Sofia Pro Semi-bold
   ------------------------------------------------------------------ */
function add_adobe_fonts() {
	wp_enqueue_style( 'adobe_fonts', 'https://use.typekit.net/kzw7rfp.css' );
}

add_action( 'wp_enqueue_scripts', 'add_adobe_fonts' );



/* Add menus
   ------------------------------------------------------------------ */

	 if (function_exists('add_theme_support')) {
		 add_theme_support('nav-menus');
	 }

	 function tlb_menus() {
		 register_nav_menus(
			 array(
				 'menu-1' => esc_html__( 'Primary', 'literarybohemian' ),
				 'menu-2' => esc_html__( 'Secondary Menu', 'literarybohemian' ),
				 'menu-3' => esc_html__( 'Tertiary Menu', 'literarybohemian' ),
				 'menu-4' => esc_html__( 'Social Channels', 'literarybohemian' )
			 )
		 );
	 }
	 add_action( 'init', 'tlb_menus' );


/* Create Poetry Custom Post Type
   ------------------------------------------------------------------ */
function poetry_init()
{
	$args = array(
		'label' => 'Poetry',
		'public' => true,
		'has_archive' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'poetry'),
		'query_var' => true,
		'menu_icon' => 'dashicons-editor-alignleft',
		'taxonomies'  => array('category', 'post_tag'),
		//'show_in_rest' => true, // true = Gutenberg, but we're leaving this out for now.
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'trackbacks',
			'custom-fields',
			'comments',
			'revisions',
			'thumbnail',
			'author',
			'page-attributes',
		)
	);
	register_post_type('poetry', $args);
}
add_action('init', 'poetry_init');


/* Create Postcard Prose Custom Post Type
   ------------------------------------------------------------------ */
function postcard_prose_init()
{
	$args = array(
		'label' => 'Postcard Prose',
		'public' => true,
		'has_archive' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'postcard-prose'),
		'query_var' => true,
		'menu_icon' => 'dashicons-editor-paragraph',
		'taxonomies'  => array('category', 'post_tag'),
		//'show_in_rest' => true,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'trackbacks',
			'custom-fields',
			'comments',
			'revisions',
			'thumbnail',
			'author',
			'page-attributes',
		)
	);
	register_post_type('postcard_prose', $args);
}
add_action('init', 'postcard_prose_init');


/* Create Travel Notes Custom Post Type
   ------------------------------------------------------------------ */
function travel_notes_init()
{
	$args = array(
		'label' => 'Travel Notes',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'travel-notes'),
		'query_var' => true,
		'menu_icon' => 'dashicons-location-alt',
		'taxonomies'  => array('category', 'post_tag'),
		//'show_in_rest' => true,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'trackbacks',
			'custom-fields',
			'comments',
			'revisions',
			'thumbnail',
			'author',
			'page-attributes',
		)
	);
	register_post_type('travel_notes', $args);
}
add_action('init', 'travel_notes_init');


/* Create Author Bio Custom Post Type
   ------------------------------------------------------------------ */
function bio_init()
{
	$args = array(
		'label' => 'Author Bios',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'bio'),
		'query_var' => true,
		'menu_icon' => 'dashicons-buddicons-replies',
		'show_in_rest' => true,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'trackbacks',
			'custom-fields',
			'comments',
			'revisions',
			'thumbnail',
			'author',
			'page-attributes',
		)
	);
	register_post_type('bio', $args);
}
add_action('init', 'bio_init');


/* Create Book Reviews Custom Post Type
   ------------------------------------------------------------------ */
function book_reviews_init()
{
	$args = array(
		'label' => 'Book Reviews',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'book-reviews'),
		'query_var' => true,
		'menu_icon' => 'dashicons-book-alt',
		'show_in_rest' => true,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'trackbacks',
			'custom-fields',
			'comments',
			'revisions',
			'thumbnail',
			'author',
			'page-attributes',
		)
	);
	register_post_type('book_reviews', $args);
}
add_action('init', 'book_reviews_init');


/* Create Logbook Custom Post Type
   ------------------------------------------------------------------ */
function logbook_init()
{
	$args = array(
		'label' => 'Logbook Posts',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'article'),
		'query_var' => true,
		'menu_icon' => 'dashicons-flag',
		'show_in_rest' => true,
		'taxonomies'  => array('category'),
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'trackbacks',
			'custom-fields',
			'comments',
			'revisions',
			'thumbnail',
			'author',
			'page-attributes',
		)
	);
	register_post_type('logbook', $args);
}
add_action('init', 'logbook_init');


/* Add custom field column to dashboard:
 * add the author name to Poetry, Postcard Prose,
 * and Travel Notes custom post type lists.
   ------------------------------------------------------------------ */

function add_acf_columns($columns)
{
	return array_merge($columns, array(
		'name' => __('Author')
	));
}
// Poetry
// ------------------------------------------------------------------ */
add_filter('manage_poetry_posts_columns', 'add_acf_columns');

function poetry_custom_column($column, $post_id)
{
	switch ($column) {
		case 'name':
			echo get_post_meta($post_id, 'name', true);
			break;
	}
}
add_action('manage_poetry_posts_custom_column', 'poetry_custom_column', 10, 2);

// Postcard Prose
// ------------------------------------------------------------------ */
add_filter('manage_postcard_prose_posts_columns', 'add_acf_columns');

function postcard_prose_custom_column($column, $post_id)
{
	switch ($column) {
		case 'name':
			echo get_post_meta($post_id, 'name', true);
			break;
	}
}
add_action('manage_postcard_prose_posts_custom_column', 'postcard_prose_custom_column', 10, 2);

// Travel Notes
// ------------------------------------------------------------------ */
add_filter('manage_travel_notes_posts_columns', 'add_acf_columns');

function travel_notes_custom_column($column, $post_id)
{
	switch ($column) {
		case 'name':
			echo get_post_meta($post_id, 'name', true);
			break;
	}
}
add_action('manage_travel_notes_posts_custom_column', 'travel_notes_custom_column', 10, 2);


/* Remove columns from dashboard
   ------------------------------------------------------------------ */
function my_manage_columns($columns)
{
	unset($columns['comments']);
	unset($columns['author']);
	return $columns;
}

function my_column_init()
{
	add_filter('manage_posts_columns', 'my_manage_columns');
}
add_action('admin_init', 'my_column_init');


/* Add custom post types to the default tag query
   ------------------------------------------------------------------ */
/**
 * This will make sure that the custom post types shows up in the tag archive pages.
 * The idea here is to list both normal posts and cpt named doc under the same tag name.
 *
 * @refer https://wordpress.stackexchange.com/a/285162/90061
 */

function add_cpt_to_taxonomy_archive( $query ) {

  if ( is_tag() && $query->is_archive() && empty( $query->query_vars['suppress_filters'] ) ) {

  $query->set( 'post_type', array(
       'post', 'postcard_prose', 'poetry', 'travel_notes',
    ));
  }
  return $query;
}
add_filter( 'pre_get_posts', 'add_cpt_to_taxonomy_archive' );



/* Create destination unknown links (used in header)
   ------------------------------------------------------------------ */
add_action('init','destination_unknown_add_rewrite');
function destination_unknown_add_rewrite() {
	global $wp;
	$wp->add_query_var('destination-unknown');
	add_rewrite_rule('destination-unknown/?$', 'index.php?destination-unknown=1', 'top');
}

add_action('template_redirect','destination_unknown_template');
function destination_unknown_template() {
	if (get_query_var('destination-unknown') == 1) {

		$posts = get_posts( array(
			'post_type' => array('poetry', 'postcard_prose', 'travel_notes',),
			'post_status' => 'publish',
			'orderby' => 'rand',
			'numberposts' => '1',
		));
		foreach($posts as $post) {
			$link = get_permalink($post);
		}
		wp_redirect($link,307);
		exit;
	}
}


/* Create bidirectional posts (for Bios)
   https://www.advancedcustomfields.com/resources/bidirectional-relationships/
   ------------------------------------------------------------------ */

function bidirectional_acf_update_value( $value, $post_id, $field  ) {

	// vars
	$field_name = $field['name'];
	$field_key = $field['key'];
	$global_name = 'is_updating_' . $field_name;

	// bail early if this filter was triggered from the update_field() function called within the loop below
	// - this prevents an inifinte loop
	if( !empty($GLOBALS[ $global_name ]) ) return $value;

	// set global variable to avoid inifite loop
	// - could also remove_filter() then add_filter() again, but this is simpler
	$GLOBALS[ $global_name ] = 1;

	// loop over selected posts and add this $post_id
	if( is_array($value) ) {

		foreach( $value as $post_id2 ) {

			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);

			// allow for selected posts to not contain a value
			if( empty($value2) ) {
				$value2 = array();
			}

			// bail early if the current $post_id is already found in selected post's $value2
			if( in_array($post_id, $value2) ) continue;

			// append the current $post_id to the selected post's 'related_posts' value
			$value2[] = $post_id;

			// update the selected post's value (use field's key for performance)
			update_field($field_key, $value2, $post_id2);
		}
	}

	// find posts which have been removed
	$old_value = get_field($field_name, $post_id, false);

	if( is_array($old_value) ) {
		foreach( $old_value as $post_id2 ) {

			// bail early if this value has not been removed
			if( is_array($value) && in_array($post_id2, $value) ) continue;

			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);

			// bail early if no value
			if( empty($value2) ) continue;

			// find the position of $post_id within $value2 so we can remove it
			$pos = array_search($post_id, $value2);

			// remove
			unset( $value2[ $pos] );

			// update the un-selected post's value (use field's key for performance)
			update_field($field_key, $value2, $post_id2);
		}
	}

	// reset global varibale to allow this filter to function as per normal
	$GLOBALS[ $global_name ] = 0;

	// return
    return $value;
}

add_filter('acf/update_value/name=related_posts', 'bidirectional_acf_update_value', 10, 3);



// /*
//  * Hide posts from Dashboard. We only use Custom Post Types.
//  */
// function lb_remove_menus()
// {
//
// 	// remove_menu_page( 'index.php' );                  //Dashboard
// 	// remove_menu_page( 'jetpack' );                    //Jetpack
// 	remove_menu_page('edit.php');                   	 //Posts
// 	// remove_menu_page( 'upload.php' );                 //Media
// 	//remove_menu_page('edit.php?post_type=page');       //Pages
// 	remove_menu_page('edit-comments.php');          	 //Comments
// 	// remove_menu_page( 'themes.php' );                 //Appearance
// 	// remove_menu_page( 'plugins.php' );                //Plugins
// 	// remove_menu_page( 'users.php' );                  //Users
// 	// remove_menu_page( 'tools.php' );                  //Tools
// 	// remove_menu_page( 'options-general.php' );        //Settings
//
// }
// add_action('admin_menu', 'lb_remove_menus');


// /*
//  * Reorder the dashboard menu items
//  */
// function custom_menu_order($menu_ord)
// {
// 	if (!$menu_ord) return true;
// 	return array(
// 		'index.php', // Dashboard
// 		'upload.php', // Media
//
// 		'themes.php', // Appearance
// 		'plugins.php', // Plugins
// 		'users.php', // Users
// 		'tools.php', // Tools
// 		'options-general.php', // Settings
//
// 		// 'edit.php?post_type=poetry', // Poetry
// 		'edit.php?post_type=page' // Pages
//
// 	);
// }
// add_filter('custom_menu_order', 'custom_menu_order');
// add_filter('menu_order', 'custom_menu_order');


/*
 * Rename Dashboard menu items
 */
// add_filter('gettext', 'change_post_to_article');
// add_filter('ngettext', 'change_post_to_article');
//
// function change_post_to_article($translated)
// {
// 	$translated = str_replace('Dashboard', 'Home', $translated);
// 	$translated = str_replace('Page', 'Static Page', $translated);
// 	return $translated;
// }



?>
