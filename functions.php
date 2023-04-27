<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */
// This theme requires WordPress 5.3 or later.
if (version_compare($GLOBALS['wp_version'], '5.3', '<')) {
  require get_template_directory() . '/inc/back-compat.php';
}

if (!function_exists('twenty_twenty_one_setup')) {

  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   *
   * @since Twenty Twenty-One 1.0
   *
   * @return void
   */
  function twenty_twenty_one_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Twenty Twenty-One, use a find and replace
     * to change 'twentytwentyone' to the name of your theme in all the template files.
     */
    load_theme_textdomain('twentytwentyone', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * This theme does not use a hard-coded <title> tag in the document head,
     * WordPress will provide it for us.
     */
    add_theme_support('title-tag');

    /**
     * Add post-formats support.
     */
    add_theme_support(
            'post-formats',
            array(
                'link',
                'aside',
                'gallery',
                'image',
                'quote',
                'status',
                'video',
                'audio',
                'chat',
            )
    );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1568, 9999);

    register_nav_menus(
            array(
                'primary' => esc_html__('Primary menu', 'twentytwentyone'),
                'footer' => esc_html__('Secondary menu', 'twentytwentyone'),
            )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
                'navigation-widgets',
            )
    );

    /*
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    $logo_width = 300;
    $logo_height = 100;

    add_theme_support(
            'custom-logo',
            array(
                'height' => $logo_height,
                'width' => $logo_width,
                'flex-width' => true,
                'flex-height' => true,
                'unlink-homepage-logo' => true,
            )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for Block Styles.
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for editor styles.
    add_theme_support('editor-styles');
    $background_color = get_theme_mod('background_color', 'D1E4DD');
    if (127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex($background_color)) {
      add_theme_support('dark-editor-style');
    }

    $editor_stylesheet_path = './assets/css/style-editor.css';

    // Note, the is_IE global variable is defined by WordPress and is used
    // to detect if the current browser is internet explorer.
    global $is_IE;
    if ($is_IE) {
      $editor_stylesheet_path = './assets/css/ie-editor.css';
    }

    // Enqueue editor styles.
    add_editor_style($editor_stylesheet_path);

    // Add custom editor font sizes.
    add_theme_support(
            'editor-font-sizes',
            array(
                array(
                    'name' => esc_html__('Extra small', 'twentytwentyone'),
                    'shortName' => esc_html_x('XS', 'Font size', 'twentytwentyone'),
                    'size' => 16,
                    'slug' => 'extra-small',
                ),
                array(
                    'name' => esc_html__('Small', 'twentytwentyone'),
                    'shortName' => esc_html_x('S', 'Font size', 'twentytwentyone'),
                    'size' => 18,
                    'slug' => 'small',
                ),
                array(
                    'name' => esc_html__('Normal', 'twentytwentyone'),
                    'shortName' => esc_html_x('M', 'Font size', 'twentytwentyone'),
                    'size' => 20,
                    'slug' => 'normal',
                ),
                array(
                    'name' => esc_html__('Large', 'twentytwentyone'),
                    'shortName' => esc_html_x('L', 'Font size', 'twentytwentyone'),
                    'size' => 24,
                    'slug' => 'large',
                ),
                array(
                    'name' => esc_html__('Extra large', 'twentytwentyone'),
                    'shortName' => esc_html_x('XL', 'Font size', 'twentytwentyone'),
                    'size' => 40,
                    'slug' => 'extra-large',
                ),
                array(
                    'name' => esc_html__('Huge', 'twentytwentyone'),
                    'shortName' => esc_html_x('XXL', 'Font size', 'twentytwentyone'),
                    'size' => 96,
                    'slug' => 'huge',
                ),
                array(
                    'name' => esc_html__('Gigantic', 'twentytwentyone'),
                    'shortName' => esc_html_x('XXXL', 'Font size', 'twentytwentyone'),
                    'size' => 144,
                    'slug' => 'gigantic',
                ),
            )
    );

    // Custom background color.
    add_theme_support(
            'custom-background',
            array(
                'default-color' => 'd1e4dd',
            )
    );

    // Editor color palette.
    $black = '#000000';
    $dark_gray = '#28303D';
    $gray = '#39414D';
    $green = '#D1E4DD';
    $blue = '#D1DFE4';
    $purple = '#D1D1E4';
    $red = '#E4D1D1';
    $orange = '#E4DAD1';
    $yellow = '#EEEADD';
    $white = '#FFFFFF';

    add_theme_support(
            'editor-color-palette',
            array(
                array(
                    'name' => esc_html__('Black', 'twentytwentyone'),
                    'slug' => 'black',
                    'color' => $black,
                ),
                array(
                    'name' => esc_html__('Dark gray', 'twentytwentyone'),
                    'slug' => 'dark-gray',
                    'color' => $dark_gray,
                ),
                array(
                    'name' => esc_html__('Gray', 'twentytwentyone'),
                    'slug' => 'gray',
                    'color' => $gray,
                ),
                array(
                    'name' => esc_html__('Green', 'twentytwentyone'),
                    'slug' => 'green',
                    'color' => $green,
                ),
                array(
                    'name' => esc_html__('Blue', 'twentytwentyone'),
                    'slug' => 'blue',
                    'color' => $blue,
                ),
                array(
                    'name' => esc_html__('Purple', 'twentytwentyone'),
                    'slug' => 'purple',
                    'color' => $purple,
                ),
                array(
                    'name' => esc_html__('Red', 'twentytwentyone'),
                    'slug' => 'red',
                    'color' => $red,
                ),
                array(
                    'name' => esc_html__('Orange', 'twentytwentyone'),
                    'slug' => 'orange',
                    'color' => $orange,
                ),
                array(
                    'name' => esc_html__('Yellow', 'twentytwentyone'),
                    'slug' => 'yellow',
                    'color' => $yellow,
                ),
                array(
                    'name' => esc_html__('White', 'twentytwentyone'),
                    'slug' => 'white',
                    'color' => $white,
                ),
            )
    );

    add_theme_support(
            'editor-gradient-presets',
            array(
                array(
                    'name' => esc_html__('Purple to yellow', 'twentytwentyone'),
                    'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
                    'slug' => 'purple-to-yellow',
                ),
                array(
                    'name' => esc_html__('Yellow to purple', 'twentytwentyone'),
                    'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
                    'slug' => 'yellow-to-purple',
                ),
                array(
                    'name' => esc_html__('Green to yellow', 'twentytwentyone'),
                    'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
                    'slug' => 'green-to-yellow',
                ),
                array(
                    'name' => esc_html__('Yellow to green', 'twentytwentyone'),
                    'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
                    'slug' => 'yellow-to-green',
                ),
                array(
                    'name' => esc_html__('Red to yellow', 'twentytwentyone'),
                    'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
                    'slug' => 'red-to-yellow',
                ),
                array(
                    'name' => esc_html__('Yellow to red', 'twentytwentyone'),
                    'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
                    'slug' => 'yellow-to-red',
                ),
                array(
                    'name' => esc_html__('Purple to red', 'twentytwentyone'),
                    'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
                    'slug' => 'purple-to-red',
                ),
                array(
                    'name' => esc_html__('Red to purple', 'twentytwentyone'),
                    'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
                    'slug' => 'red-to-purple',
                ),
            )
    );

    /*
     * Adds starter content to highlight the theme on fresh sites.
     * This is done conditionally to avoid loading the starter content on every
     * page load, as it is a one-off operation only needed once in the customizer.
     */
    if (is_customize_preview()) {
      require get_template_directory() . '/inc/starter-content.php';
      add_theme_support('starter-content', twenty_twenty_one_get_starter_content());
    }

    // Add support for responsive embedded content.
    add_theme_support('responsive-embeds');

    // Add support for custom line height controls.
    add_theme_support('custom-line-height');

    // Add support for experimental link color control.
    add_theme_support('experimental-link-color');

    // Add support for experimental cover block spacing.
    add_theme_support('custom-spacing');

    // Add support for custom units.
    // This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
    add_theme_support('custom-units');

    // Remove feed icon link from legacy RSS widget.
    add_filter('rss_widget_feed_link', '__return_empty_string');
  }

}
add_action('after_setup_theme', 'twenty_twenty_one_setup');

/**
 * Register widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init() {

  register_sidebar(
          array(
              'name' => esc_html__('Footer', 'twentytwentyone'),
              'id' => 'sidebar-1',
              'description' => esc_html__('Add widgets here to appear in your footer.', 'twentytwentyone'),
              'before_widget' => '<section id="%1$s" class="widget %2$s">',
              'after_widget' => '</section>',
              'before_title' => '<h2 class="widget-title">',
              'after_title' => '</h2>',
          )
  );
}

add_action('widgets_init', 'twenty_twenty_one_widgets_init');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width() {
  // This variable is intended to be overruled from themes.
  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['content_width'] = apply_filters('twenty_twenty_one_content_width', 750);
}

add_action('after_setup_theme', 'twenty_twenty_one_content_width', 0);

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_scripts() {
  // Note, the is_IE global variable is defined by WordPress and is used
  // to detect if the current browser is internet explorer.
  global $is_IE, $wp_scripts;
  if ($is_IE) {
    // If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
    wp_enqueue_style('twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get('Version'));
  } else {
    // If not IE, use the standard stylesheet.
    wp_enqueue_style('twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
  }

  // RTL styles.
  wp_style_add_data('twenty-twenty-one-style', 'rtl', 'replace');

  // Print styles.
  wp_enqueue_style('twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get('Version'), 'print');

  // Threaded comment reply styles.
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  // Register the IE11 polyfill file.
  wp_register_script(
          'twenty-twenty-one-ie11-polyfills-asset',
          get_template_directory_uri() . '/assets/js/polyfills.js',
          array(),
          wp_get_theme()->get('Version'),
          true
  );

  // Register the IE11 polyfill loader.
  wp_register_script(
          'twenty-twenty-one-ie11-polyfills',
          null,
          array(),
          wp_get_theme()->get('Version'),
          true
  );
  wp_add_inline_script(
          'twenty-twenty-one-ie11-polyfills',
          wp_get_script_polyfill(
                  $wp_scripts,
                  array(
                      'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
                  )
          )
  );

  // Main navigation scripts.
  if (has_nav_menu('primary')) {
    wp_enqueue_script(
            'twenty-twenty-one-primary-navigation-script',
            get_template_directory_uri() . '/assets/js/primary-navigation.js',
            array('twenty-twenty-one-ie11-polyfills'),
            wp_get_theme()->get('Version'),
            true
    );
  }

  // Responsive embeds script.
  wp_enqueue_script(
          'twenty-twenty-one-responsive-embeds-script',
          get_template_directory_uri() . '/assets/js/responsive-embeds.js',
          array('twenty-twenty-one-ie11-polyfills'),
          wp_get_theme()->get('Version'),
          true
  );
}

add_action('wp_enqueue_scripts', 'twenty_twenty_one_scripts');

/**
 * Enqueue block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script() {

  wp_enqueue_script('twentytwentyone-editor', get_theme_file_uri('/assets/js/editor.js'), array('wp-blocks', 'wp-dom'), wp_get_theme()->get('Version'), true);
}

add_action('enqueue_block_editor_assets', 'twentytwentyone_block_editor_script');

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix() {

  // If SCRIPT_DEBUG is defined and true, print the unminified file.
  if (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) {
    echo '<script>';
    include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
    echo '</script>';
  } else {
    // The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
    ?>
    <script>
      /(trident|msie)/i.test(navigator.userAgent) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", (function () {
        var t, e = location.hash.substring(1);
        /^[A-z0-9_-]+$/.test(e) && (t = document.getElementById(e)) && (/^(?:a|select|input|button|textarea)$/i.test(t.tagName) || (t.tabIndex = -1), t.focus())
      }), !1);
    </script>
    <?php

  }
}

add_action('wp_print_footer_scripts', 'twenty_twenty_one_skip_link_focus_fix');

/**
 * Enqueue non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages() {
  $custom_css = twenty_twenty_one_get_non_latin_css('front-end');

  if ($custom_css) {
    wp_add_inline_style('twenty-twenty-one-style', $custom_css);
  }
}

add_action('wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages');

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueue scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init() {
  wp_enqueue_script(
          'twentytwentyone-customize-helpers',
          get_theme_file_uri('/assets/js/customize-helpers.js'),
          array(),
          wp_get_theme()->get('Version'),
          true
  );

  wp_enqueue_script(
          'twentytwentyone-customize-preview',
          get_theme_file_uri('/assets/js/customize-preview.js'),
          array('customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers'),
          wp_get_theme()->get('Version'),
          true
  );
}

add_action('customize_preview_init', 'twentytwentyone_customize_preview_init');

/**
 * Enqueue scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts() {

  wp_enqueue_script(
          'twentytwentyone-customize-helpers',
          get_theme_file_uri('/assets/js/customize-helpers.js'),
          array(),
          wp_get_theme()->get('Version'),
          true
  );
}

add_action('customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts');

/**
 * Calculate classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes() {
  /**
   * Filters the classes for the main <html> element.
   *
   * @since Twenty Twenty-One 1.0
   *
   * @param string The list of classes. Default empty string.
   */
  $classes = apply_filters('twentytwentyone_html_classes', '');
  if (!$classes) {
    return;
  }
  echo 'class="' . esc_attr($classes) . '"';
}

/**
 * Add "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class() {
  ?>
  <script>
    if (-1 !== navigator.userAgent.indexOf('MSIE') || -1 !== navigator.appVersion.indexOf('Trident/')) {
      document.body.classList.add('is-IE');
    }
  </script>
  <?php

}

add_action('wp_footer', 'twentytwentyone_add_ie_class');

if (!function_exists('wp_get_list_item_separator')) :

  /**
   * Retrieves the list item separator based on the locale.
   *
   * Added for backward compatibility to support pre-6.0.0 WordPress versions.
   *
   * @since 6.0.0
   */
  function wp_get_list_item_separator() {
    /* translators: Used between list items, there is a space after the comma. */
    return __(', ', 'twentytwentyone');
  }

endif;

add_filter('wp_enqueue_scripts', 'change_default_jquery', PHP_INT_MAX);

function change_default_jquery() {
  if (is_page(array('play-frog-tastic-game'))) {
    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');
  }
}

function smartwp_remove_wp_block_library_css() {
  if (is_page(array('play-frog-tastic-game'))) {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('twenty-twenty-one-style');
  }
}

add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

if (strpos($_SERVER['REQUEST_URI'], 'play-frog-tastic-game') !== false) {
  //add_action('wp_loaded', 'custom_redirect');
}

function custom_redirect() {
  if (is_user_logged_in()) {
    //wp_redirect('https://triplesevens.com/play-frog-tastic-game/', 301);
    //exit;
  } else {
    //wp_redirect('https://triplesevens.com/create-account-login-2/', 301);
    //exit;
  }
}

function register_frog_gamer_menu() {
  add_menu_page('Frog Tastic Game User', 'FrogGamer', 'manage_options', 'frg_gamer', 'frog_tastic_users', 'dashicons-editor-table', 4);
}

add_action('admin_menu', 'register_frog_gamer_menu');

function frog_tastic_users() {
  $no = 10;
  $paged = ($_GET['paged']) ? (int) trim($_GET['paged']) : 1;
  $offset = ( $paged - 1 ) * $no;
  global $wpdb;
  $searchP = esc_attr($_GET['s']);
  $orderP = esc_attr($_GET['order']);
  $group = esc_attr($_GET['g']);
  $sd = esc_attr($_GET['sd']);
  $ed = esc_attr($_GET['ed']);
  $search = '';
  if (!empty($searchP)) {
    $search = 'AND ('.$wpdb->prefix.'users.user_login LIKE "%'.$searchP.'%" OR '.$wpdb->prefix.'users.user_email LIKE "%'.$searchP.'%")';
  }
  
  $ranger = '';
  if (!empty($sd) && !empty($ed)) {
    $datetime = new DateTime();
    $start = $datetime->createFromFormat('Y/m/d', $sd);
    $start_date = $start->format('Y-m-d H:i:s');
    $end = $datetime->createFromFormat('Y/m/d', $ed);
    $end_date = $end->format('Y-m-d H:i:s');
    $ranger = ' AND (DATE_FORMAT(FROM_UNIXTIME(JSON_EXTRACT(mt1.meta_value, "$.inserted_at")), "%Y-%m-%d %H:%i:%s") BETWEEN "'.$start_date.'" AND "'.$end_date.'")';
  }
  
  $order = 'ASC';
  $orderBy = ' CAST(scr AS UNSIGNED)';
  if (!empty($orderP)) {
    $order = ($orderP == 'asc') ? 'ASC' : 'DESC';
  }
  
  $count = '';
  $groupby = '';
  $th = '';
  $td = '';
  $sum = ',TRIM(BOTH \'"\' FROM JSON_EXTRACT(mt1.meta_value, "$.score")) scr';
  if (!empty($group)) {
    $count = ',COUNT('.$wpdb->prefix.'users.ID) played';
    $sum = ',SUM(JSON_EXTRACT(mt1.meta_value, "$.score")) AS scr';
    $groupby = ' GROUP BY '.$wpdb->prefix.'users.user_email ';
    $orderBy = ' scr';
    $th = '<th class="manage-column column-name">no. of Play</th>';
  }
  
  
  $query = 'SELECT mt1.meta_value jdata'.$sum.', '.$wpdb->prefix.'users.display_name'.$count.','.$wpdb->prefix.'users.user_email,mt2.meta_value fcredit_total FROM '.$wpdb->prefix.'users INNER JOIN '.$wpdb->prefix.'usermeta ON ( '.$wpdb->prefix.'users.ID = '.$wpdb->prefix.'usermeta.user_id ) INNER JOIN '.$wpdb->prefix.'usermeta AS mt1 ON ('.$wpdb->prefix.'users.ID = mt1.user_id ) INNER JOIN '.$wpdb->prefix.'usermeta AS mt2 ON ('.$wpdb->prefix.'users.ID = mt2.user_id ) WHERE 1=1 AND ( '.$wpdb->prefix.'usermeta.meta_key = "fcredit_total" AND mt1.meta_key = "fscore" ) AND ( mt2.meta_key = "fcredit_total" ) '.$search.$ranger.$groupby.' ORDER BY '.$orderBy.' '.$order.' LIMIT '.$offset.', '.$no;
  $user_query = $wpdb->get_results($query);
  //echo $query;
  $parts = parse_url(home_url());
  $qargs = array(
    'orderby' => 'scr',
    'order' => $orderP == 'asc' ? 'desc' : 'asc'
  );
  $sort_url = $parts['scheme'] . '://' . $parts['host'] . ':' . $parts['port'] . add_query_arg($qargs);
  
  $gargs = array(
      'g' => 'yes',
  );
  $group_url = $parts['scheme'] . '://' . $parts['host'] . ':' . $parts['port'] . add_query_arg($gargs);

  if (!isset($_GET['order'])) {
    $sort_class = ' sortable desc';
  } else {
    $sort_class = ($orderP == 'asc') ? ' sorted asc' : ' sorted desc';
  }
  $total_user = count($user_query);  
  $total_pages = ceil($total_user/$no);
  $current_screen = get_current_screen();
  $current_page = admin_url('admin.php?page='.$current_screen->parent_base);

  $html = '<div class="wrap"><h1 class="wp-heading-inline">Frog Game Users</h1><h2 class="screen-reader-text">Users list</h2><form method="get" action=""><p class=""><label class="screen-reader-text" for="user-search-input">Search Users:</label><input type="search" style="margin-right:5px;" name="s" value="' . $searchP . '" placeholder="Search"><input id="date_timepicker_start" type="search" style="margin-right:5px;" name="sd" value="' . $sd . '" placeholder="Start Date" autocomplete="off"><input id="date_timepicker_end" type="search" style="margin-right:5px;" name="ed" value="' . $ed . '" placeholder="End Date" autocomplete="off"><input type="hidden" name="page" value="frg_gamer"><input type="submit" id="search-submit" class="button" value="Search Users"><a class="button" style="margin-left:6px;" href="'.$group_url.'">Group</a></p></form><table class="wp-list-table widefat fixed striped table-view-list users"><thead><tr><th class="manage-column column-name"><span>Username</span></th><th class="manage-column column-name">Total Credit</th><th class="manage-column column-name">Email</th><th class="manage-column column-name column-primary' . $sort_class . '"><a href="' . $sort_url . '"><span>Score</span><span class="sorting-indicator"></span></a></th>'.$th.'<th class="manage-column column-role">Inserted at</th></tr></thead><tbody id="the-list">';

  foreach ($user_query as $user) {
    $score = json_decode($user->jdata, true);
    $scr = $score['score'];
    if (!empty($group)) {
      $td = '<td class="email column-email">' . $user->played . '</td>';
      $scr = $user->scr;
    }
    $html .= '<tr id="user-1">
          <td class="username column-username has-row-actions column-primary" data-colname="Username">' . $user->display_name . '</td>
          <td class="name column-name" data-colname="Name">' . $user->fcredit_total . '</td>
          <td class="email column-email" data-colname="Email">' . $user->user_email . '</td>
          <td class="name column-name">'.$scr.'</td>
          '.$td.'
          <td class="name column-name">'.date('Y-m-d H:i:s', $score['inserted_at']).'</td>
        </tr>';
  }
  $html .= '</tbody></table><div class="tablenav bottom">

	<div style="width:100%;" id="pagination_div" class="alignleft actions bulkactions">
		'.paginate_links(array(  
                  'base' => $current_page.'%_%',  
                  'format' => '&paged=%#%',  
                  'current' => $paged,  
                  'total' => $total_pages,  
                  'prev_text' => '< Prev',  
                  'next_text' => 'Next >',
                  'type'     => 'list'
                )).'
	</div>
			
</div></div><style>#pagination_div ul li{float:left;}#pagination_div ul li a{padding:8px 12px;background:#ddd;text-decoration:none;}</style>';
  echo $html;
}
add_action( 'admin_init', function () {
    remove_menu_page( 'frg_gamer' );
});

function wpdocs_selectively_enqueue_admin_script( $hook ) {
    if($hook == 'toplevel_page_frg_gamer'){
       wp_enqueue_script( 'datetime_script', plugins_url('frog-tastic-game/js/jquery.datetimepicker.full.min.js'), array(), '1.0' );
       wp_enqueue_script( 'custome_script', plugins_url('frog-tastic-game/js/custom.js'), array(), '1.0' );
       wp_register_style('datetime_style', plugins_url('frog-tastic-game/css/jquery.datetimepicker.min.css'), array(), '1.0' );
       wp_enqueue_style('datetime_style');
    }
}
add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script' );