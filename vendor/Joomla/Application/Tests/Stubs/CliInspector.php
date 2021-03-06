<?php
/**
 * @package     Joomla\Framework\Tests
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Application\Tests;

use Joomla\Application\Cli;

/**
 * Inspector for the Joomla\Application\Cli class.
 *
 * @package  Joomla\Framework\Tests
 * @since    1.0
 */
class CliInspector extends Cli
{
	/**
	 * The exit code if the application was closed otherwise null.
	 *
	 * @var     integer
	 * @since   1.0
	 */
	public $closed;

	/**
	 * Mimic exiting the application.
	 *
	 * @param   integer  $code  The exit code (optional; default is 0).
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function close($code = 0)
	{
		$this->closed = $code;
	}

	/**
	 * Allows public access to protected method.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	public function doExecute()
	{
		return;
	}

	/**
	 * Method to load a PHP configuration class file based on convention and return the instantiated data object.  You
	 * will extend this method in child classes to provide configuration data from whatever data source is relevant
	 * for your specific application.
	 *
	 * @param   string  $file   The path and filename of the configuration file. If not provided, configuration.php
	 *                          in JPATH_BASE will be used.
	 * @param   string  $class  The class name to instantiate.
	 *
	 * @return  mixed   Either an array or object to be loaded into the configuration object.
	 *
	 * @since   1.0
	 * @throws  \RuntimeException
	 */
	protected function fetchConfigurationData($file = '', $class = '\\Joomla\\Test\\Config')
	{
		// Instantiate variables.
		$config = array();

		if (empty($file) && defined('JPATH_BASE'))
		{
			$file = JPATH_BASE . '/configuration.php';

			// Applications can choose not to have any configuration data
			// by not implementing this method and not having a config file.
			if (!file_exists($file))
			{
				$file = '';
			}
		}

		if (!empty($file))
		{
			if (is_file($file))
			{
				require_once $file;
			}

			if (class_exists($class))
			{
				$config = new $class;
			}
			else
			{
				throw new \RuntimeException('Configuration class does not exist.');
			}
		}

		return $config;
	}
}
