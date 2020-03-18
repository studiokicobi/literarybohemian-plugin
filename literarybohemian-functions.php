<?php

/*
Plugin Name: Custom Functions for The Literary Bohemian
*/


/* Create Poetry Custom Post Type
   ------------------------------------------------------------------ */
function poetry_init()
{
	$args = array(
		'label' => 'Poetry',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'poetry'),
		'query_var' => true,
		'menu_icon' => 'dashicons-editor-alignleft',
		'taxonomies'  => array('category'),
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
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array('slug' => 'postcard-prose'),
		'query_var' => true,
		'menu_icon' => 'dashicons-editor-paragraph',
		'taxonomies'  => array('category'),
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
		'taxonomies'  => array('category'),
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

?>
