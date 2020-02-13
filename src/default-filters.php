<?php

defined( 'ABSPATH' ) or exit;

add_filter( 'use_block_editor_for_post', 'wpkb_gutenberg', 10, 2 );

function wpkb_gutenberg( $use_block_editor, $post ) {
    if ( $post->post_type === 'wpkb-article' ) {
        return true;
    }
    return $use_block_editor;
}

require __DIR__ . '/table-of-contents/filters.php';
