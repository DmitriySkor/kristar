# BlueSky Core
## Description :
A set of basic functions for operation with WordPress themes and plugins.

## Author :
Sergiy Pushenko.

## Plugin information :
<table>
    <tr>
        <td>Plugin name</td>
        <td>bs_core</td>
    </tr>
    <tr>
        <td>Plugin version</td>
        <td>1.15.0</td>
    </tr>
    <tr>
        <td>WordPress version</td>
        <td>6.6 - 6.8.1</td>
    </tr>
    <tr>
        <td>PHP version</td>
        <td>8.0 - 8.2</td>
    </tr>
</table>

## Function :
### Function for work with colors ( [colors.php](src/Functions/colors.php) ) :
- bs_core_colors_get_darken_color_in_hex_format() - Get darken color in hex format.

### Functions relating to debug ( [debug](src/Functions/debug.php) ) :
- bs_core_debug - Display debugging information on the screen.
- bs_core_debug_add_line_in_debug_log - Add a line to the debug.log file.

### Functions for preparing HTML code ( [html](src/Functions/html.php) ) :
- bs_core_html_get_tag_attributes_as_string - Get attributes for HTML tags as a string.
- bs_core_html_print_tag_attributes - Prints attributes of an HTML tag.
- bs_core_html_print_a_or_tag - Print tag `<a>` if not empty link or user tag ( `<div>` by default ).
- bs_core_html_get_a_attrs_for_ext_or_int_link - Get an array of attributes for an external or internal link.
- bs_core_html_add_tag_in_text - Add tag into text.
- bs_core_html_get_template_part_text - Get template part text.

### Functions for media files ( [media](src/Functions/media.php) ) :
- bs_core_media_get_attachment_image - Get attachment image.
- bs_core_media_print_attachment_image - Print attachment image.
- bs_core_media_get_srcset_attr_for_image - get the srcset attribute for a theme image.
- bs_core_media_print_attachment_video - Print attachment video.
- bs_core_media_get_svg_content_from_file - Get the contents of an SVG file.
- bs_core_media_print_svg_content_from_file - Print the contents of an SVG file.
- bs_core_media_get_svg_content_from_file_by_id - Get the contents of an SVG file by ID.
- bs_core_media_print_svg_content_from_file_by_id - Print the contents of an SVG file by ID.

### Function for Nav menus ( [menu](src/Functions/menu.php) ) :
- bs_core_menu_get_nav_menu_id_by_item_id - Get navigation menu id by item id.
- bs_core_menu_get_related_nav_menu_id_by_nav_menu_id - Get related navigation menu id by navigation menu id.
- bs_core_menu_get_icon_id_of_menu_item - Get the icon ID of the menu item.
- bs_core_menu_get_icon_url_of_menu_item - Get the icon url of the menu item.
- bs_core_menu_get_menu_items - Get WP menu items.

### Functions for WordPress plugins ( [plugins](src/Functions/plugins.php) ) :
- bs_core_plugins_get_mu_plugins_url - Get the plugin URL in the mu-plugins directory.
- bs_core_plugins_get_mu_plugins_dir - Get the plugin patch in the mu-plugins directory.
- bs_core_plugins_get_plugin_url - Get the plugin URL in the plugins directory.
- bs_core_plugins_get_plugin_dir - Get the plugin patch in the plugins directory.
- bs_core_plugins_get_uploads_url - Get the uploads url in the uploads directory.
- bs_core_plugins_get_uploads_dir - Get the uploads patch in the uploads directory.
- bs_core_plugins_get_template_part - Get template part from plugin or main theme or children theme.
- bs_core_plugins_get_template_path - Get the path to a template in a plugin or main/child theme.

### Function for work with posts ( [posts](src/Functions/posts.php) ) :
- bs_core_posts_get_archive_number_articles - Getting archive number articles.
- bs_core_posts_get_archive_pagination_parameters - Getting archive pagination parameters.
- bs_core_posts_get_term_names - Returns a list of taxonomy names in the selected form.
- bs_core_posts_array_to_str_with_separator - Converts an array to a string with separator.
