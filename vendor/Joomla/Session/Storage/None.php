<?php
/**
 * @package     Joomla\Framework
 * @subpackage  Session
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Session\Storage;


use Joomla\Session\Storage;

/**
 * File session handler for PHP
 *
 * @package     Joomla\Framework
 * @subpackage  Session
 * @see         http://www.php.net/manual/en/function.session-set-save-handler.php
 * @since       11.1
 */
class None extends Storage
{
	/**
	 * Register the functions of this class with PHP's session handler
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	public function register()
	{
		ini_set('session.save_handler', 'files');
	}
}
