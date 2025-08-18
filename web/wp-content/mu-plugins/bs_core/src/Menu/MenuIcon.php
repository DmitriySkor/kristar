<?php
/**
 * Menu icon class
 */

namespace BlueSky\MuPlugin\CorePlugin\Menu;

use WP_Post;
use stdClass;

class MenuIcon {

	public function __construct() {

		// Add icon field to menu items
		add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'bs_core_menu_icon_add_icon_field_to_menu_items' ), 10, 5 );

		// Save the icon field of the menu item
		add_action( 'wp_update_nav_menu_item', array( $this, 'bs_core_menu_icon_save_icon_field_of_menu_items' ), 10, 3 );

		// Register script for icon field of menu items
		add_action( 'admin_print_footer_scripts', array( $this, 'bs_core_menu_icon_register_script_for_icon_field_of_menu_items' ) );

		// Connect function for work with Media API WP
		add_action( 'admin_enqueue_scripts', array( $this, 'bs_core_menu_icon_connect_media_api_wp' ) );

		return true;
	}

	/**
	 * Add icon field to menu items
	 *
	 * @param string        $item_id           Menu item ID as a numeric string.
	 * @param WP_Post       $menu_item         Menu item data object.
	 * @param int           $depth             Depth of menu item. Used for padding.
	 * @param stdClass|null $args              An object of menu item arguments.
	 * @param int           $current_object_id Nav menu ID.
	 */
	public function bs_core_menu_icon_add_icon_field_to_menu_items( string $item_id, WP_Post $menu_item, int $depth, stdClass|null $args, int $current_object_id ): void {

		$menu_with_icons     = get_theme_support( 'bs_core_icon_in_nav_menu' );
		$nav_menu_id         = bs_core_menu_get_nav_menu_id_by_item_id( $item_id );
		$related_nav_menu_id = bs_core_menu_get_related_nav_menu_id_by_nav_menu_id( $nav_menu_id );

		if ( ! empty( $menu_with_icons[0] ) && is_array( $menu_with_icons[0] ) && ! empty( $related_nav_menu_id ) && in_array( $related_nav_menu_id, $menu_with_icons[0], true ) ) {
			$menu_image = bs_core_menu_get_icon_id_of_menu_item( $item_id );
			$menu_image = ( ! empty( $menu_image ) ) ? $menu_image : '';
			?>
			<div class="field-custom description1 description-wide1">
				<label for="edit-menu-item-image-<?php echo $item_id; ?>">
					<?php _e( 'Image for menu', 'bs_core' ); ?>
				</label>
				<input type="hidden" id="edit-menu-item-image-<?php echo $item_id; ?>" class="widefat code edit-menu-item-image" name="menu-item-image[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $menu_image ); ?>" />
				<br/>
				<button class="button upload-menu-image" style="margin: 5px 0 5px 0;display: <?php echo $menu_image ? 'none' : 'inline-block'; ?>">
					<?php _e( 'Choose Image', 'bs_core' ); ?>
				</button>
				<img class="menu-item-preview" src="<?php echo wp_get_attachment_image_url( $menu_image, 'thumbnail' ); ?>" style="border: solid black 1px; padding: 5px; margin: 5px 5px 5px 0px;max-width: 100px; display: <?php echo $menu_image ? 'inline-block' : 'none'; ?>;">
				<button class="button remove-menu-image" style="margin: 5px 0 5px 0;display: <?php echo $menu_image ? 'inline-block' : 'none'; ?>">
					<?php _e( 'Remove', 'bs_core' ); ?>
				</button>
			</div>
			<?php
		}
	}

	/**
	 * Save the icon field of the menu item
	 *
	 * @param $menu_id
	 * @param $menu_item_db_id
	 * @param $menu_item_args
	 * @return void
	 */
	public function bs_core_menu_icon_save_icon_field_of_menu_items( $menu_id, $menu_item_db_id, $menu_item_args ): void {
		if ( isset( $_REQUEST['menu-item-image'][ $menu_item_db_id ] ) ) {
			$menu_image = sanitize_text_field( $_REQUEST['menu-item-image'][ $menu_item_db_id ] );
			update_post_meta( $menu_item_db_id, '_menu_item_image', $menu_image );
		}
	}

	/**
	 * Register script for icon field of menu items
	 *
	 * @return void
	 */
	public function bs_core_menu_icon_register_script_for_icon_field_of_menu_items(): void {
		global $pagenow;

		$menu_with_icons = get_theme_support( 'bs_core_icon_in_nav_menu' );
		if ( 'nav-menus.php' == $pagenow && ! empty( $menu_with_icons[0] ) ) {
			?>
			<script>
				jQuery(document).ready(function($) {
					$(document).on('click', '.upload-menu-image', function(e) {
						e.preventDefault();
						var button = $(this);
						var custom_uploader = wp.media({
							title: '<?php _e( 'Choose Image', 'bs_core' ); ?>', // Заголовок всплывающего окна
							button: {
								text: '<?php _e( 'Choose Image', 'bs_core' ); ?>' // Текст кнопки выбора изображения
							},
							multiple: false
						})
							.on('select', function() {
								var attachment = custom_uploader.state().get('selection').first().toJSON();
								button.siblings('.edit-menu-item-image').val(attachment.id);
								console.log( button.siblings() );

								button.siblings('.menu-item-preview').attr('src', attachment.url).show();
								button.siblings('.remove-menu-image').show();
								button.hide();
							})
							.open();
					});

					$(document).on('click', '.remove-menu-image', function(e) {
						e.preventDefault();
						var button = $(this);
						button.siblings('.edit-menu-item-image').val('');
						button.siblings('.menu-item-preview').hide();
						button.siblings('.upload-menu-image').show();
						button.hide();
					});
				});
			</script>
			<?php
		}
	}

	/**
	 * Connect function for work with Media API WP
	 *
	 * @return void
	 */
	function bs_core_menu_icon_connect_media_api_wp(): void {
		wp_enqueue_media();
	}
}
