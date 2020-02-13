<?php

namespace WPKB;

use WP_Screen;

class Callouts {

	const SHORTCODE = 'wpkb_callout';

	protected $default_atts = array(
		'type' => 'info'
	);

	public function __construct() {

	}

	public function add_hooks() {
		// register shortcode
		add_shortcode( self::SHORTCODE, array( $this, 'shortcode' ) );
	}

	/**
	 * @param array  $atts
	 * @param string $content
	 *
	 * @return string
	 */
	public function shortcode( $atts = array(), $content = '' ) {
		$atts = shortcode_atts( $this->default_atts, $atts, self::SHORTCODE );
		$output = '<div class="alert alert--' . $atts['type'] . '">';
		$output .= $this->get_icon( $atts['type'] );
		$output .= '<span class="alert__content">' . trim( $content ) . '</span>';
		$output .= '</div>';
		return $output;
	}

	/**
	 * Retrieves the correct alert icon.
	 *
	 * @param string $type The type of alert.
	 *
	 * @return string The alert icon plus wrapping HTML.
	 */
	private function get_icon( $type ) {
		switch( $type ) {
			case 'success':
				$icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" role="img" aria-hidden="true" focusable="false"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"/></svg>';
				break;
			case 'error':
				$icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" role="img" aria-hidden="true" focusable="false"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"/></svg>';
				break;
			case 'warning':
				$icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" role="img" aria-hidden="true" focusable="false"><path d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"/></svg>';
				break;
			case 'info':
			default:
				$icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" role="img" aria-hidden="true" focusable="false"><path d="M256 8C119.043 8 8 119.083 8 256c0 136.997 111.043 248 248 248s248-111.003 248-248C504 119.083 392.957 8 256 8zm0 110c23.196 0 42 18.804 42 42s-18.804 42-42 42-42-18.804-42-42 18.804-42 42-42zm56 254c0 6.627-5.373 12-12 12h-88c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h12v-64h-12c-6.627 0-12-5.373-12-12v-24c0-6.627 5.373-12 12-12h64c6.627 0 12 5.373 12 12v100h12c6.627 0 12 5.373 12 12v24z"/></svg>';
				break;
			}

		return '<span class="alert__icon">' . $icon . '</span>';
	}
}
