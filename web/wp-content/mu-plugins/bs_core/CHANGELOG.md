# Changelog
All notable changes to this extension will be documented in this file.

## [1.15.0] - 2025-06-28
### Added :
- Function bs_core_debug_add_line_in_debug_log - Add a line to the debug.log file.

## [1.14.2] - 2025-06-20
### Updated :
- Function bs_core_media_get_attachment_image - Updated the procedure for outputting Alt text for the image. First manually specified, then from the media storage, and only then empty..

## [1.14.1] - 2025-06-10
### Fixed :
- Function bs_core_media_get_attachment_image - Added image status check when outputting image by ID.

## [1.14.0] - 2025-06-04
### Added :
- Function bs_core_media_get_attachment_image - Get attachment image.

## [1.13.1] - 2025-05-28
### Updated :
- Function bs_core_debug - Update description.

## [1.13.0] - 2025-05-05
### Added :
- Function bs_core_colors_get_darken_color_in_hex_format() - Get darken color in hex format

## [1.12.1] - 2025-04-10
### Updated :
- Function bs_core_html_get_a_attrs_for_ext_or_int_link - added attribute rel="noopener" fo external link.

## [1.12.0] - 2025-03-27
### Added :
- Function bs_core_html_get_tag_attributes_as_string - Get attributes for HTML tags as a string.
- Function bs_core_html_get_a_attrs_for_ext_or_int_link - Get an array of attributes for an external or internal link.
### Updated :
- Function bs_core_html_print_tag_attributes - bs_core_html_get_tag_attributes_as_string function used to insert tags.
- Function bs_core_media_print_attachment_image - bs_core_html_get_tag_attributes_as_string function used to insert tags..
- Function bs_core_media_print_attachment_video - bs_core_html_get_tag_attributes_as_string function used to insert tags..

## [1.11.0] - 2025-03-14
### Added :
- Function bs_core_plugins_get_template_path - Get the path to a template in a plugin or main/child theme.

## [1.10.0] - 2025-03-12
### Added :
- Function bs_core_plugins_get_template_part - Get template part from plugin or main theme or children theme.

## [1.9.0] - 2025-03-03
### Added :
- Function bs_core_plugins_get_mu_plugins_url - Get the plugin URL in the mu-plugins directory.
- Function bs_core_plugins_get_mu_plugins_dir - Get the plugin patch in the mu-plugins directory.
- Function bs_core_plugins_get_plugin_url - Get the plugin URL in the plugins directory.
- Function bs_core_plugins_get_plugin_dir - Get the plugin patch in the plugins directory.
- Function bs_core_plugins_get_uploads_url - Get the uploads url in the uploads directory.
- Function bs_core_plugins_get_uploads_dir - Get the uploads patch in the uploads directory.

## [1.8.0] - 2025-01-27
### Added :
- Function bs_core_media_get_srcset_attr_for_image - get the srcset attribute for a theme image.
### Updated :
- Plugin description.

## [1.7.1] - 2025-01-17
### Fixed :
- Function bs_core_media_print_attachment_image - fixed insert of img tag.
### Update :
- GIT ignore.

## [1.7.0] - 2024-12-18
### Added :
- Function bs_core_media_get_svg_content_from_file_by_id - get the contents of an SVG file by ID.
- Function bs_core_media_print_svg_content_from_file_by_id - print the contents of an SVG file by ID.

## [1.6.2] - 2024-12-02
### Fixed :
- Mu plugin loader for no composer project.

## [1.6.1] - 2024-12-02
### Fixed :
- Mu plugin loader for no composer project.

## [1.6.0] - 2024-11-10
### Added :
- Function for print the contents of an SVG file: bs_core_media_print_svg_content_from_file.
### Moved :
- Function bs_core_html_get_svg_content_from_file -> bs_core_media_get_svg_content_from_file.
### Fixed :
- Parameters in function bs_core_media_get_svg_content_from_file.

## [1.5.0] - 2024-10-23
### Added :
- Composer scripts.
- Mu plugin loader.
- Ru translations.
### Updated :
- Fr, Uk translations.
- Plugin description.
 
## [1.4.1] - 2024-10-17
### Fixed :
- Move plugin to mu-plugins.

## [1.4.0] - 2024-09-18
### Added :
- New Function :
  - bs_core_posts_get_term_names - Returns a list of taxonomy names in the selected form.
  - bs_core_posts_array_to_str_with_separator - Converts an array to a string with separator.

## [1.3.2] - 2024-09-18
### Fixed :
- Code style.

## [1.3.1] - 2024-09-18
### Fixed :
- Text color for debugging information on a light-colored background.

## [1.3.0] - 2024-09-09
### Added :
- Ability to display debugging information on a light-colored background.

## [1.2.1] - 2024-08-30
### Removed :
- Unnecessary character.

## [1.2.0] - 2024-08-27
### Added :
- Added a function for inserting a blocks of images and videos.

## [1.1.0] - 2024-08-05
### Added :
- Function get template part text : bs_core_html_get_template_part_text().

## [1.0.1] - 2024-08-05
### Fixed
- Plugin description

## [1.0.0] - 2024-07-31
### Added
- Composer file
- ReadMe
- Change log

## [0.7.1] - 2024-07-30
### Fixed
- Function for adding a tag to a specified place in the text

## [0.7.0] - 2024-07-30
### Added
- Function for adding a tag to a specified place in the text

## [0.6.0] - 2024-07-23
### Added
- Function for print tag <a> if not empty link or user tag ( <div> by default )

## [0.5.0] - 2024-07-22
### Added
- Function for getting archive number articles

## [0.4.1] - 2024-07-18
### Added
- Parametrs for alternative menu display.
### Fixed
- Sorting for alternative menu display.

## [0.4.0] - 2024-07-17
### Added
- Possibility of alternative menu display.
    ```
    bs_core_menu_get_menu_items( string $menu_name = '' );
    ```

## [0.3.0] - 2024-07-17
### Added
- Ability to use icons in menus.

Code example for use icon into menu :

```
        /**
        * Add icon into nav menus
        *
        * @return void
        */
        function blockfusion_menu_add_icon_into_nav_menus(): void {

            add_theme_support(
                'bs_core_icon_in_nav_menu',
                array(
                    'primary_menu',
                )
            );
        }
        \add_action( 'after_setup_theme', 'blockfusion_menu_add_icon_into_nav_menus' )
```

## [0.2.1] - 2024-07-12
### Updated
- Update translations.

## [0.2.0] - 2024-06-17
### Added
- Debag function : bs_core_debug.

## [0.1.0] - 2024-06-15
### Added
- Start of development.
