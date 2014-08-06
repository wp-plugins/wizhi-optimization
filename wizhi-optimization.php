<?php
/*
Plugin Name:        Wizhi Optimization
Plugin URI:         http://www.wpzhiku.com/
Description:        针对WordPress中文用户的一些精简和优化
Version:            1.0.3
Author:             Amos Lee
Author URI:         http://www.wpzhiku.com/
License:            MIT License
License URI:        http://opensource.org/licenses/MIT
*/

define('WIZHI_PATH', plugin_dir_path(__FILE__));

function wizhi_load_modules() {
    require_once(WIZHI_PATH . 'modules/cleanup.php');
    require_once(WIZHI_PATH . 'modules/optimization.php');
}
add_action('after_setup_theme', 'wizhi_load_modules');