<?php
/**
 * Functions relating to debug.
 */

/**
 * Print variables for debugging.
 *
 * @param mixed $variable         - Data for debugging
 * @param bool  $light_background - True - display data on a light background
 * @return void
 */
function bs_core_debug( mixed $variable = '', bool $light_background = false ): void {

	if ( $light_background ) {
		echo '<pre style="background-color:white;color:black;">';
	} else {
		echo '<pre>';
	}

	var_dump( $variable );
	echo '</pre>';
}

/**
 * Add a line to the debug.log file
 *
 * @param int    $message_type - Message type:
 *      0 - Indentation outside
 *      1 - Indentation inside,
 *      2 - Separator,
 *      3 - Text,
 *      4 - Module,
 *      5 - Notice,
 *      6 - Warning,
 *      7 - Error,
 * @param string $message_text  - Message text.
 * @param int    $message_level - Message level: 0 - 4 (us for message type: 2 - 6)
 *
 * @return void
 */
function bs_core_debug_add_line_in_debug_log( int $message_type = 0, string $message_text = '', int $message_level = 0 ): void {

	if ( in_array( $message_type, array( 0, 1, 2 ) ) || ( in_array( $message_type, array( 3, 4, 5, 6, 7 ) ) && ! empty( $message_text ) ) ) {

		$message_levels = array(
			0 => ' ',
			1 => ' - ',
			2 => ' -- ',
			3 => ' --- ',
			4 => ' ---- ',
		);

		$message_list = array(
			0 => ' ',
			1 => '-',
			2 => '---------------------------------------------------------------------------------------------',
			3 => '-' . $message_levels[ $message_level ] . $message_text,
			4 => '-' . $message_levels[ $message_level ] . 'Module : ' . $message_text,
			5 => '-' . $message_levels[ $message_level ] . 'Notice : ' . $message_text,
			6 => '-' . $message_levels[ $message_level ] . 'Warning : ' . $message_text,
			7 => '-' . $message_levels[ $message_level ] . 'Error : ' . $message_text,
		);

		error_log( $message_list[ $message_type ] );
	}
}
