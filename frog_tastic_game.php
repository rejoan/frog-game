<?php

/*
  Plugin Name: Frogtastic Game
  description: A simple custom plugin to play frog tastic game
  Version: 1.0.0
  Author: Rejoanul Alam
 */

if (!class_exists('FrogTasticGame')) {

  class FrogTasticGame {

    /**
     * Constructor
     */
    public function __construct() {
      $this->setup_actions();
    }

    /**
     * Setting up Hooks
     */
    public function setup_actions() {
      // Add Custom JS to admin panel
      add_action('wp_enqueue_scripts', array($this, 'plugin_css_jsscripts'));
      add_shortcode('frog_tastic_game', array($this, 'render_frog_tastic_game'));
      //add_action('init', array($this, 'frog_tastic'));

      add_action('views_edit-frog_tastic_game', array($this, 'remove__views'));
    }

    /**
     * Enqueue Scripts
     */
    public function plugin_css_jsscripts() {

      if (is_page(array('play-frog-tastic-game'))) {
        wp_enqueue_style('style-reset', plugins_url('/css/reset.css', __FILE__));
        wp_enqueue_style('style-main', plugins_url('/css/main.css', __FILE__));
        wp_enqueue_style('style-orien', plugins_url('/css/orientation_utils.css', __FILE__));
        wp_enqueue_style('style-ios', plugins_url('/css/ios_fullscreen.css', __FILE__));

        wp_enqueue_script('script-jquery', plugins_url('/js/jquery-3.2.1.min.js', __FILE__));

        wp_enqueue_script('script-create', plugins_url('/js/createjs.min.js', __FILE__));

        wp_enqueue_script('script-full', plugins_url('/js/screenfull.js', __FILE__));
        wp_enqueue_script('script-platform', plugins_url('/js/platform.js', __FILE__));
        wp_enqueue_script('script-ios_fullscreen', plugins_url('/js/ios_fullscreen.js', __FILE__));
        wp_enqueue_script('script-howler', plugins_url('/js/howler.min.js', __FILE__));
        wp_enqueue_script('script-ctl_utils', plugins_url('/js/ctl_utils.js', __FILE__));
        wp_enqueue_script('script-sprite_lib', plugins_url('/js/sprite_lib.js', __FILE__));
        wp_enqueue_script('script-levels', plugins_url('/js/levels.js', __FILE__));
        wp_enqueue_script('script-settings', plugins_url('/js/settings.js', __FILE__));
        wp_enqueue_script('script-CLang', plugins_url('/js/CLang.js', __FILE__));
        wp_enqueue_script('script-CPreloader', plugins_url('/js/CPreloader.js', __FILE__));
        wp_localize_script('script-CPreloader', 'CPreloaderScript', array(
            'pluginsUrl' => plugins_url('frog-tastic-game'),
        ));

        wp_enqueue_script('script-CMain', plugins_url('/js/CMain.js', __FILE__));
        wp_localize_script('script-CMain', 'CMainScript', array(
            'pluginsUrl' => plugins_url('frog-tastic-game'),
        ));

        wp_enqueue_script('script-CTextButton', plugins_url('/js/CTextButton.js', __FILE__));
        wp_enqueue_script('script-CGfxButton', plugins_url('/js/CGfxButton.js', __FILE__));
        wp_enqueue_script('script-CToggle', plugins_url('/js/CToggle.js', __FILE__));
        wp_enqueue_script('script-CMenu', plugins_url('/js/CMenu.js', __FILE__));
        wp_enqueue_script('script-CGame', plugins_url('/js/CGame.js', __FILE__));
        wp_enqueue_script('script-CInterface', plugins_url('/js/CInterface.js', __FILE__));
        wp_enqueue_script('script-CEndPanel', plugins_url('/js/CEndPanel.js', __FILE__));
        wp_enqueue_script('script-CTweenController', plugins_url('/js/CTweenController.js', __FILE__));
        wp_enqueue_script('script-CLevelSettings', plugins_url('/js/CLevelSettings.js', __FILE__));
        wp_enqueue_script('script-CHero', plugins_url('/js/CHero.js', __FILE__));
        wp_enqueue_script('script-CBezier', plugins_url('/js/CBezier.js', __FILE__));
        wp_enqueue_script('script-CBall', plugins_url('/js/CBall.js', __FILE__));
        wp_enqueue_script('script-CNextLevel', plugins_url('/js/CNextLevel.js', __FILE__));
        wp_enqueue_script('script-CExtraScore', plugins_url('/js/CExtraScore.js', __FILE__));
        wp_enqueue_script('script-CLevelMenu', plugins_url('/js/CLevelMenu.js', __FILE__));
        wp_enqueue_script('script-CLevelBut', plugins_url('/js/CLevelBut.js', __FILE__));
        wp_enqueue_script('script-CMsgBox', plugins_url('/js/CMsgBox.js', __FILE__));
        wp_enqueue_script('script-CCreditsPanel', plugins_url('/js/CCreditsPanel.js', __FILE__));
        wp_enqueue_script('script-CAlertSavingBox', plugins_url('/js/CAlertSavingBox.js', __FILE__));
        wp_enqueue_script('script-CBee', plugins_url('/js/CBee.js', __FILE__));
        wp_enqueue_script('script-CDaisy', plugins_url('/js/CDaisy.js', __FILE__));
        wp_enqueue_script('script-CCTLText', plugins_url('/js/CCTLText.js', __FILE__));
      }
    }

    /**
     * Add shortcode
     */
    public function render_frog_tastic_game() {
      ob_start();
      require_once plugin_dir_path(__FILE__) . 'game.php';
      return ob_get_clean();
    }

    /**
     * Custom Post Type
     */
    public function frog_tastic() {
      $labels = array(
          'archives' => __('Item Archives'),
          'attributes' => __('Item Attributes'),
          'parent_item_colon' => __('Parent Item:'),
          'all_items' => __('All Items'),
          'search_items' => __('Search'),
          'edit_item' => 'Edit Item',
          'update_item' => 'Update Item'
      );
      $args = array(
          'label' => __('FrogTastic game'),
          'description' => __('Vaccine Card Description'),
          'labels' => $labels,
          'supports' => array('title', 'custom-fields'),
          'public' => true,
          'show_in_menu' => true,
          'menu_position' => 5,
          'menu_icon' => 'dashicons-format-aside',
          'show_in_admin_bar' => true,
          'show_in_nav_menus' => true,
          'can_export' => true,
          'has_archive' => true,
          'query_var' => true,
          'publicly_queryable' => true,
          'capabilities' => array(
              'create_posts' => false,
          ),
          'map_meta_cap' => true,
      );
      register_post_type('frog_tastic_game', $args);
    }

    /**
     * Remove Published Tab From Vaccine Card Information
     */
    public function remove__views($views) {
      unset($views['all']);
      unset($views['publish']);
      return $views;
    }

  }

  // instantiate the plugin class
  $frogtasticgame = new FrogTasticGame();
}

add_action('wp_ajax_adjust_credit', 'adjust_credit');
add_action('wp_ajax_nopriv_adjust_credit', 'adjust_credit');

function adjust_credit() {
  if (!isset($_POST['action']) && ($_POST['action'] != 'adjust_credit')) {
    exit('The form is not valid');
  }
  $current_user = wp_get_current_user();
  $user_id = $current_user->ID;
  $status = $_POST['status'];
  if ($status == 'sstart') {
    $total = get_user_meta($user_id, 'fcredit_total', true);
    update_user_meta($user_id, 'fcredit_total', $total - 5);
    exit;
  }

  if ($status == 'sscore') {
    $fscore = array(
        'score' => $_POST['score'],
        'username' => $current_user->user_login,
        'inserted_at' => time()
    );
    $score = json_encode($fscore);
    add_user_meta($user_id, 'fscore', $score);
  }
}
