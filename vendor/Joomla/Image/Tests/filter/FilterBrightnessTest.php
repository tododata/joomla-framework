<?php
/**
 * @package     Joomla\Framework\Test
 * @subpackage  Image
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

use Joomla\Image\Filter\Brightness as FilterBrightness;

/**
 * Test class for JImage.
 *
 * @package     Joomla\Framework\Test
 * @subpackage  Image
 * @since       11.4
 */
class JImageFilterBrightnessTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Setup for testing.
	 *
	 * @return  void
	 *
	 * @since   11.4
	 */
	protected function setUp()
	{
		parent::setUp();

		// Verify that GD support for PHP is available.
		if (!extension_loaded('gd'))
		{
			$this->markTestSkipped('No GD support so skipping JImage tests.');
		}
	}

	/**
	 * Overrides the parent tearDown method.
	 *
	 * @return  void
	 *
	 * @see     PHPUnit_Framework_TestCase::tearDown()
	 * @since   11.4
	 */
	protected function tearDown()
	{
		parent::tearDown();
	}

	/**
	 * Tests the JImageFilterBrightness::execute method.
	 *
	 * This tests to make sure we can brighten the image.
	 *
	 * @return  void
	 *
	 * @since   11.4
	 */
	public function testExecute()
	{
		// Create a image handle of the correct size.
		$imageHandle = imagecreatetruecolor(100, 100);

		// Define red.
		$red = imagecolorallocate($imageHandle, 127, 0, 0);

		// Draw a red rectangle to fill the image.
		imagefilledrectangle($imageHandle, 0, 0, 100, 100, $red);

		$filter = new FilterBrightness($imageHandle);

		$filter->execute(array(IMG_FILTER_BRIGHTNESS => 10));

		$this->assertEquals(
			137,
			imagecolorat($imageHandle, 50, 50) >> 16 & 0xFF
		);
	}

	/**
	 * Tests the JImageFilterBrightness::execute method - invalid argument.
	 *
	 * This tests to make sure an exception is properly thrown.
	 *
	 * @return  void
	 *
	 * @since   11.4
	 *
	 * @expectedException  InvalidArgumentException
	 */
	public function testExecuteInvalidArgument()
	{
		// Create a image handle of the correct size.
		$imageHandle = imagecreatetruecolor(100, 100);

		// Define red.
		$red = imagecolorallocate($imageHandle, 127, 0, 0);

		// Draw a red rectangle to fill the image.
		imagefilledrectangle($imageHandle, 0, 0, 100, 100, $red);

		$filter = new FilterBrightness($imageHandle);

		$filter->execute(array());
	}
}
