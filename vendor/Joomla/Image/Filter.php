<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Image
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Image;

use Psr\Log\LoggerInterface;

/**
 * Class to manipulate an image.
 *
 * @package     Joomla.Platform
 * @subpackage  Image
 * @since       1.0
 */
abstract class Filter
{
	/**
	 * @var    resource  The image resource handle.
	 * @since  1.0
	 */
	protected $handle;

	/**
	 * @var    LoggerInterface
	 * @since  1.0
	 */
	protected $logger = null;

	/**
	 * Class constructor.
	 *
	 * @param   resource  $handle  The image resource on which to apply the filter.
	 *
	 * @since   11.3
	 * @throws  InvalidArgumentException
	 * @throws  RuntimeException
	 */
	public function __construct($handle)
	{
		// Verify that image filter support for PHP is available.
		if (!function_exists('imagefilter'))
		{
			// @codeCoverageIgnoreStart
			if ($this->logger !== null)
			{
				$this->logger->error('The imagefilter function for PHP is not available.');
			}
			throw new \RuntimeException('The imagefilter function for PHP is not available.');

			// @codeCoverageIgnoreEnd
		}

		// Make sure the file handle is valid.
		if (!is_resource($handle) || (get_resource_type($handle) != 'gd'))
		{
			if ($this->logger !== null)
			{
				$this->logger->error('The image handle is invalid for the image filter.');
			}
			throw new \InvalidArgumentException('The image handle is invalid for the image filter.');
		}

		$this->handle = $handle;
	}

	/**
     * Sets a logger instance on the object
     *
     * @param    LoggerInterface  $logger
	 *
     * @return   void
     */
	public function setLogger(LoggerInterface $logger = null)
	{
		$this->logger = $logger;
	}

	/**
	 * Method to apply a filter to an image resource.
	 *
	 * @param   array  $options  An array of options for the filter.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	abstract public function execute(array $options = array());
}
