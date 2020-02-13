<?php
use WPKB\Article_List;
use WPKB\ServiceContainer;

/**
 * Getter function for services
 *
 * @param string $service (optional)
 *
 * @return mixed|ServiceContainer
 * @throws Exception
 */
function wpkb( $service = null ) {
	static $instance;

	if( ! $instance ) {
		$instance = new ServiceContainer();
	}

	if( $service ) {
		return $instance->get( $service );
	}

	return $instance;
}

/**
 * @param $args
 *
 * @return Article_List
 */
function wpkb_article_list( $args ) {
	return new Article_List( $args );
}

/**
 * @return string
 */
function wpkb_category_list() {
	return wpkb('categories');
}

require_once __DIR__ . '/table-of-contents/functions.php';
