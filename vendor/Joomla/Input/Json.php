<?php
/**
 * @package     Joomla\Framework
 * @subpackage  Input
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Input;


use Joomla\Filter\Input as FilterInput;

/**
 * Joomla! Input JSON Class
 *
 * This class decodes a JSON string from the raw request data and makes it available via
 * the standard JInput interface.
 *
 * @package     Joomla\Framework
 * @subpackage  Input
 * @since       12.2
 */
class Json extends Input
{
	/**
	 * @var    string  The raw JSON string from the request.
	 * @since  12.2
	 */
	private $raw;

	/**
	 * Constructor.
	 *
	 * @param   array  $source   Source data (Optional, default is the raw HTTP input decoded from JSON)
	 * @param   array  $options  Array of configuration parameters (Optional)
	 *
	 * @since   12.2
	 */
	public function __construct(array $source = null, array $options = array())
	{
		if (isset($options['filter']))
		{
			$this->filter = $options['filter'];
		}
		else
		{
			$this->filter = FilterInput::getInstance();
		}

		if (is_null($source))
		{
			$this->raw  = file_get_contents('php://input');
			$this->data = json_decode($this->raw, true);
		}
		else
		{
			$this->data = & $source;
		}

		// Set the options for the class.
		$this->options = $options;
	}

	/**
	 * Gets the raw JSON string from the request.
	 *
	 * @return  string  The raw JSON string from the request.
	 *
	 * @since   12.2
	 */
	public function getRaw()
	{
		return $this->raw;
	}
}
