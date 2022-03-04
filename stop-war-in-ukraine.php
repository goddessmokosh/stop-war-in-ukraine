<?php
/**
 * Plugin Name: Stop War In Ukraine
 * Plugin URI: https://github.com/godess-mokosh/stop-war-in-ukraine
 * Description: 🇺🇦 A WordPress plugin that displays proxied war news from the free world to Russian IP addresse visitors with option to block further access.
 * Version: 0.0.1
 * Author: Goddess Mokosh
 * Author URI: https://en.wikipedia.org/wiki/Mokosh
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */ 

// echo var_dump( get_option('swiu_options_page', []) );
// exit();

// Display Stop War in Ukraine admin options
include( __DIR__ . '/swiu-options.php' );

// Display overlay to Russian visitors
include( __DIR__ . '/swiu-overlay.php' );

// Serve up news from the free world
include( __DIR__ . '/swiu-proxy.php' );
