<?php

namespace WPKB;

use WP_Post;

class Router {

	/**
	 * @var string
	 */
	private $slug = 'help';

	/**
	 * Types constructor.
	 */
	public function __construct() {
	}

	/**
	 * Add hooks
	 */
	public function add_hooks() {
		add_action( 'init', array( $this, 'register' ), 1 );
	}

	/**
	 * Register the various types
	 */
	public function register() {
		$labels = array(
			'name'              => __( 'Help categories', 'wp-knowledge-base' ),
			'singular_name'     => __( 'Help category', 'wp-knowledge-base' ),
			'menu_name'         => __( 'Help categories' )
		);

		// register docs taxonomy: category
		register_taxonomy(
			'wpkb-category',
			'wpkb-article',
			array(
				'labels' => $labels,
				'rewrite' => array(
					'with_front' => false,
					'slug' => $this->slug . '/category'
				),
				'hierarchical' => true,
				'query_var' => true,
				'show_in_rest' => true,
			)
		);
		register_taxonomy_for_object_type( 'wpkb-category', 'wpkb-article' );



		$labels = array(
			'name'               => _x( 'Help articles', 'post type general name', 'wp-knowledge-base' ),
			'singular_name'      => _x( 'Help article', 'post type singular name', 'wp-knowledge-base' ),
			'new_item'           => __( 'New Help article', 'wp-knowledge-base' ),
			'update_item'        => __( 'Update Help article', 'wp-knowledge-base' ),
			'edit_item'          => __( 'Edit Help article', 'wp-knowledge-base' ),
			'add_new_item'       => __( 'Add new Help article', 'wp-knowledge-base' )
		);

		// register docs post type
		register_post_type(
			'wpkb-article',
			array(
				'public' => true,
				'labels' => $labels,
				'hierarchical' => true,
				'rewrite' => array( 'with_front' => false, 'slug' => $this->slug ),
				'taxonomies' => array( 'wpkb-category', 'wpkb-keyword' ),
				'has_archive' => true,
				'menu_icon'   => 'dashicons-info',
				'supports' => array( 'title', 'editor', 'author', 'revisions' ),
				'show_in_rest' => true,
			)
		);

	}

}
