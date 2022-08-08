<?php

/*
Plugin Name: Flyn Featured Gallery
Plugin URI: https://www.flynsarmy.com
Description: Adds featured gallery support to posts
Version: 1.0
Author: Flyn San
Author URI: https://www.flynsarmy.com
License: GPLv2

Copyright 2022  Flyn San  (email : flynsarmy@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

require_once __DIR__ . "/vendor/autoload.php";

/**
 * Start the plugin.
 */
// Flyn\FeaturedGallery\Rest::instance();
Flyn\FeaturedGallery\Setup::instance();
Flyn\FeaturedGallery\Admin::instance();
