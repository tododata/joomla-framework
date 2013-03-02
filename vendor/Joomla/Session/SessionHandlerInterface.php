<?php
/**
 * @package    Joomla\Framework\Session
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */


/**
 * SessionHandlerInterface interface. This file should only be loaded on PHP < 5.4
 * It allows us to implement it in classes without requiring PHP 5.4
 *
 * @package  Joomla\Framework\Session
 * @link     http://php.net/manual/en/class.sessionhandlerinterface.php
 * @since    1.0
 */
interface SessionHandlerInterface
{
	/*
	 * Closes the current session.
	 * This function is automatically executed when closing the session, or explicitly via session_write_close().
	 * 
	 * @return  bool
	 */
	public function close();

	/**
	 * Destroys a session.
	 * Called by session_regenerate_id() (with $destroy = TRUE), session_destroy() and when session_decode() fails.
	 * 
	 * @param   string  $session_id  The session ID being destroyed.
	 * 
	 * @return  bool
	 */
	public function destroy($session_id);

	/**
	 * Cleans up expired sessions.
	 * Called by session_start(), based on session.gc_divisor, session.gc_probability and session.gc_lifetime settings.
	 * 
	 * @param   string  $maxlifetime  Sessions that have not updated for the last maxlifetime seconds will be removed.
	 * 
	 * @return  bool
	 */
	public function gc($maxlifetime);

	/**
	 * Re-initialize existing session, or creates a new one.
	 * Called when a session starts or when session_start() is invoked.
	 * 
	 * @param   string  $save_path  The path where to store/retrieve the session.
	 * @param   string  $name       The session name.
	 * 
	 * @return  bool
	 */
	public function open($save_path, $name);

	/**
	 * Reads the session data from the session storage, and returns the results.
	 * Called right after the session starts or when session_start() is called. Please note that before this method is called SessionHandlerInterface::open() is invoked.
	 * 
	 * @param   string  $session_id  The session id.
	 * 
	 * @return  string
	 */
	public function read($session_id);

	/**
	 * Writes the session data to the session storage.
	 * Called by session_write_close(), when session_register_shutdown() fails, or during a normal shutdown. Note: SessionHandlerInterface::close() is called immediately after this function.
	 * 
	 * @param   string  $session_id    The session id.
	 * @param   string  $session_data  The encoded session data. This data is the result of the PHP internally encoding the $_SESSION superglobal to a serialized string and passing it as this parameter. Please note sessions use an alternative serialization method.
	 * 
	 * @return  bool
	 */
	public function write($session_id, $session_data);
}
