<?php

namespace WPKB;

use WP_Post;

class Router {

	/**
	 * @var string
	 */
	private $slug;

	/**
	 * @var null|\WP_Post
	 */
	public $archive_page;

	/**
	 * Types constructor.
	 *
	 * @param int $archive_page_id
	 */
	public function __construct( $archive_page_id = 0 ) {

		if( $archive_page_id > 0 ) {
			$this->archive_page = get_post( $archive_page_id );
		}

		$this->slug = $this->determine_base_slug();
	}

	/**
	 * @return string
	 */
	public function determine_base_slug() {

		if( $this->archive_page instanceof WP_Post ) {
			return $this->archive_page->post_name;
		}

		// TODO: Add text-option for this
		return defined( 'WPKB_POST_TYPE_SLUG' ) ? WPKB_POST_TYPE_SLUG : 'help';
	}

	/**
	 * Add hooks
	 */
	public function add_hooks() {
		add_action( 'init', array( $this, 'register' ), 1 );

		if( $this->archive_page instanceof WP_Post ) {
			add_filter( 'request', array( $this, 'modify_post_type_archive_request') );
		}
	}

	/**
	 * @param array $query_vars
	 *
	 * @return array
	 */
	public function modify_post_type_archive_request( $query_vars ) {

		// only trigger for KB post type archive (without additional args)
		if( is_admin() || ! isset( $query_vars['post_type'] ) || $query_vars['post_type'] !== 'wpkb-article' || count( $query_vars ) > 1 ) {
			return $query_vars;
		}

		return array(
			'post_type' => 'page',
			'page_id' => $this->archive_page->ID,
			'pagename' => $this->archive_page->post_name,
		);
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
				'query_var' => true
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
				'supports' => array( 'title', 'editor', 'author', 'revisions' ) //todo: finish migration to comments API & use that interface
			)
		);

	}

}
