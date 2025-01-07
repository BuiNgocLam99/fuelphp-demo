<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.8.2
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

return array(
	/**
	 * -------------------------------------------------------------------------
	 *  Default route
	 * -------------------------------------------------------------------------
	 *
	 */

	'_root_' => 'client/home/index',

	/**
	 * -------------------------------------------------------------------------
	 *  Page not found
	 * -------------------------------------------------------------------------
	 *
	 */

	'_404_' => 'welcome/404',

	/**
	 * -------------------------------------------------------------------------
	 *  Example for Presenter
	 * -------------------------------------------------------------------------
	 *
	 *  A route for showing page using Presenter
	 *
	 */

	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),


	'prefecture/:prefecture_id/hotel/:hotel_id' => 'client/home/hotel',
	'prefecture/:prefecture_id' => 'client/home/prefecture',

	'booking' => 'client/booking/index',

	'admin/prefecture/create' => 'admin/prefecture/create',
	'admin/hotel/create' => 'admin/hotel/create',
	'admin/user/create' => 'admin/user/create',
	'admin/booking/create' => 'admin/booking/create',

	// 'admin/prefecture/edit/:id' => 'admin/prefecture/edit',
	// 'admin/hotel/edit:id' => 'admin/hotel/edit',
	// 'admin/user/edit:id' => 'admin/user/edit',
	// 'admin/booking/edit:id' => 'admin/booking/edit',

	'admin' => 'admin/prefecture/index',
	'admin/prefecture(/:segment)?' => 'admin/prefecture/index',
	'admin/hotel(/:segment)?' => 'admin/hotel/index',
	'admin/user(/:segment)?' => 'admin/user/index',
	'admin/booking(/:segment)?' => 'admin/booking/index',
);
