<?php
/**
 * WP Snappy.
 *
 * This file adds the single hosting page template to the WP Snappy Theme.
 *
 * @package WP Snappy
 * @author  Tharindu Pramuditha
 * @license GPL-2.0+
 * @link    http://www.wpsnappy.com/
 */

// Remove default page header.
// remove_action( 'genesis_before_content_sidebar_wrap', 'wpsnappy_page_header' );

// remove_action( 'genesis_loop', 'genesis_do_loop' );
// add_action( 'genesis_loop', 'hosting_archive_loop' );

// function hosting_archive_loop() {
// }

genesis();
