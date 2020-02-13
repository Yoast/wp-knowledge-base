<?php
/*
Plugin Name: WP Knowledge Base
Version: 1.2.2
Plugin URI: https://mc4wp.com/kb/
Description: WordPress powered documentation for your products. Beautiful.
Author: Danny van Kooten
Author URI: https://dannyvankooten.com/
Text Domain: wp-knowledge-base
Domain Path: /languages/
License: GPL v3

WP Knowledge Base plugin
Copyright (C) 2014-2020, Danny van Kooten - support@dannyvankooten.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

namespace WPKB;

if( ! defined( 'ABSPATH' ) ) {
	exit;
}

// define version
define( 'WPKB_FILE', __FILE__ );
define( 'WPKB_VERSION', '1.2.2' );

// load composer autoloader
if( ! function_exists( 'wpkb' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

// load constants, filters, actions & shortcodes
require __DIR__ . '/src/default-filters.php';
require __DIR__ . '/src/shortcodes.php';

// instantiate object tree
global $wpkb;

$wpkb = wpkb();

$router = new Router();
$router->add_hooks();

$wpkb['plugin'] = $plugin = new Plugin( WPKB_VERSION, __FILE__, __DIR__ );
$wpkb['categories'] = new Term_List( 'wpkb-category' );

// callout boxes
$callouts = new Callouts();
$callouts->add_hooks();
