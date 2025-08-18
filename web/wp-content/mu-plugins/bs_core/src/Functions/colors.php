<?php
/**
 * Function for work with colors
 */

/**
 * Get darken color in hex format
 *
 * @param string $hex_color - HEX color (e.g. "#ffffff")
 * @param int    $percent      - Percentage to change to (0-100)
 * @return string           - Darken color in HEX format
 */
function bs_core_colors_get_darken_color_in_hex_format( string $hex_color = '', int $percent = 20 ): string {

	$color = '';

	if ( ! empty( $hex_color ) && $percent > 0 && $percent < 100 ) {

		// Remove # and ; from color code
		$hex_color = str_replace( array( '#', ';' ), '', $hex_color );

		// Break color code into RGB
		$part_r = hexdec( substr( $hex_color, 0, 2 ) );
		$part_g = hexdec( substr( $hex_color, 2, 2 ) );
		$part_b = hexdec( substr( $hex_color, 4, 2 ) );

		// Darken each channel
		$part_r = max( 0, min( 255, $part_r - ( $part_r * $percent / 100 ) ) );
		$part_g = max( 0, min( 255, $part_g - ( $part_g * $percent / 100 ) ) );
		$part_b = max( 0, min( 255, $part_b - ( $part_b * $percent / 100 ) ) );

		// Create darken color
		$color = '#' . str_pad( dechex( (int) $part_r ), 2, '0', STR_PAD_LEFT )
			. str_pad( dechex( (int) $part_g ), 2, '0', STR_PAD_LEFT )
			. str_pad( dechex( (int) $part_b ), 2, '0', STR_PAD_LEFT );
	}

	return $color;
}
