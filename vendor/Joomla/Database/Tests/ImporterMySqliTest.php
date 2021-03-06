<?php
/**
 * @package    Joomla\Framework\Tests
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Database\Tests;

/**
 * Tests the JDatabaseMySqlImporter class.
 *
 * @package  Joomla\Framework\Tests
 * @since    11.1
 */
class ImporterMySQLiTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var    object  The mocked database object for use by test methods.
	 * @since  11.1
	 */
	protected $dbo = null;

	/**
	 * Sets up the testing conditions
	 *
	 * @return  void
	 *
	 * @since   11.1
	 */
	protected function setup()
	{
		parent::setUp();

		// Set up the database object mock.
		$this->dbo = $this->getMock(
			'Joomla\\Database\\Driver\\Mysqli',
			array(),
			array(),
			'',
			false
		);
	}

	/**
	 * Tests the check method.
	 *
	 * @return void
	 *
	 * @since  11.1
	 */
	public function testCheckWithNoDbo()
	{
		$instance = new \Joomla\Database\Importer\Mysqli;

		try
		{
			$instance->check();
		}
		catch (\Exception $e)
		{
			// Exception expected.
			return;
		}

		$this->fail(
			'Check method should throw exception if DBO not set'
		);
	}

	/**
	 * Tests the check method.
	 *
	 * @return void
	 *
	 * @since  11.1
	 */
	public function testCheckWithNoTables()
	{
		$instance = new \Joomla\Database\Importer\Mysqli;
		$instance->setDbo($this->dbo);

		try
		{
			$instance->check();
		}
		catch (\Exception $e)
		{
			// Exception expected.
			return;
		}

		$this->fail(
			'Check method should throw exception if DBO not set'
		);
	}

	/**
	 * Tests the check method.
	 *
	 * @return void
	 *
	 * @since  11.1
	 */
	public function testCheckWithGoodInput()
	{
		$instance = new \Joomla\Database\Importer\Mysqli;
		$instance->setDbo($this->dbo);
		$instance->from('foobar');

		try
		{
			$result = $instance->check();

			$this->assertThat(
				$result,
				$this->identicalTo($instance),
				'check must return an object to support chaining.'
			);
		}
		catch (\Exception $e)
		{
			$this->fail(
				'Check method should not throw exception with good setup: ' . $e->getMessage()
			);
		}
	}

	/**
	 * Tests the setDbo method with the wrong type of class.
	 *
	 * @return void
	 *
	 * @since  11.1
	 */
	public function testSetDboWithBadInput()
	{
		$instance = new \Joomla\Database\Importer\Mysqli;

		try
		{
			$instance->setDbo(new \stdClass);
		}
		catch (\PHPUnit_Framework_Error $e)
		{
			// Expecting the error, so just ignore it.
			return;
		}

		$this->fail(
			'setDbo requires a JDatabaseMySql object and should throw an exception.'
		);
	}

	/**
	 * Tests the setDbo method with the wrong type of class.
	 *
	 * @return void
	 *
	 * @since  11.1
	 */
	public function testSetDboWithGoodInput()
	{
		$instance = new \Joomla\Database\Importer\Mysqli;

		try
		{
			$result = $instance->setDbo($this->dbo);

			$this->assertThat(
				$result,
				$this->identicalTo($instance),
				'setDbo must return an object to support chaining.'
			);
		}
		catch (\PHPUnit_Framework_Error $e)
		{
			// Unknown error has occurred.
			$this->fail(
				$e->getMessage()
			);
		}
	}
}
