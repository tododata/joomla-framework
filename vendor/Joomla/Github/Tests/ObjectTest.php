<?php
/**
 * @package     Joomla\Framework\Test
 * @subpackage  Client
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

use Joomla\Registry\Registry;

require_once __DIR__ . '/stubs/JGithubObjectMock.php';

/**
 * Test class for JGithub.
 *
 * @package     Joomla\Framework\Test
 * @subpackage  Github
 *
 * @since       11.1
 */
class JGithubObjectTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var    Registry  Options for the GitHub object.
	 * @since  11.3
	 */
	protected $options;

	/**
	 * @var    Joomla\Github\Http  Mock client object.
	 * @since  11.3
	 */
	protected $client;

	/**
	 * @var    JGithubIssues  Object under test.
	 * @since  11.3
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @access protected
	 *
	 * @return void
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->options = new Registry;
		$this->client = $this->getMock('Joomla\\Github\\Http', array('get', 'post', 'delete', 'patch', 'put'));

		$this->object = new JGithubObjectMock($this->options, $this->client);
	}

	/**
	 * Data provider method for the fetchUrl method tests.
	 *
	 * @return array
	 */
	public function fetchUrlData()
	{
		return array(
			'Standard github - no pagination data' => array('https://api.github.com', '/gists', 0, 0, 'https://api.github.com/gists'),
			'Enterprise github - no pagination data' => array('https://mygithub.com', '/gists', 0, 0, 'https://mygithub.com/gists'),
			'Standard github - page 3' => array('https://api.github.com', '/gists', 3, 0, 'https://api.github.com/gists?page=3'),
			'Enterprise github - page 3, 50 per page' => array('https://mygithub.com', '/gists', 3, 50, 'https://mygithub.com/gists?page=3&per_page=50'),
		);
	}

	/**
	 * Tests the fetchUrl method
	 *
	 * @param   string   $apiUrl    @todo
	 * @param   string   $path      @todo
	 * @param   integer  $page      @todo
	 * @param   integer  $limit     @todo
	 * @param   string   $expected  @todo
	 *
	 * @dataProvider fetchUrlData
	 *
	 * @return void
	 */
	public function testFetchUrl($apiUrl, $path, $page, $limit, $expected)
	{
		$this->options->set('api.url', $apiUrl);

		$this->assertThat(
			$this->object->fetchUrl($path, $page, $limit),
			$this->equalTo($expected)
		);
	}

	/**
	 * Tests the fetchUrl method with basic authentication data
	 *
	 * @return void
	 */
	public function testFetchUrlBasicAuth()
	{
		$this->options->set('api.url', 'https://api.github.com');

		$this->options->set('api.username', 'MyTestUser');
		$this->options->set('api.password', 'MyTestPass');

		$this->assertThat(
			$this->object->fetchUrl('/gists', 0, 0),
			$this->equalTo('https://MyTestUser:MyTestPass@api.github.com/gists')
		);
	}
}
