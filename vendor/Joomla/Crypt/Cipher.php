<?php
/**
 * @package     Joomla\Framework
 * @subpackage  Crypt
 *
 * @copyright   Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Crypt;


/**
 * JCrypt cipher interface.
 *
 * @package     Joomla\Framework
 * @subpackage  Crypt
 * @since       12.1
 */
interface Cipher
{
	/**
	 * Method to decrypt a data string.
	 *
	 * @param   string     $data  The encrypted string to decrypt.
	 * @param   JCryptKey  $key   The key[/pair] object to use for decryption.
	 *
	 * @return  string  The decrypted data string.
	 *
	 * @since   12.1
	 */
	public function decrypt($data, Key $key);

	/**
	 * Method to encrypt a data string.
	 *
	 * @param   string     $data  The data string to encrypt.
	 * @param   JCryptKey  $key   The key[/pair] object to use for encryption.
	 *
	 * @return  string  The encrypted data string.
	 *
	 * @since   12.1
	 */
	public function encrypt($data, Key $key);

	/**
	 * Method to generate a new encryption key[/pair] object.
	 * 
	 * @param   array  $options  Key generation options.
	 * 
	 * @return  JCryptKey
	 * 
	 * @since   12.1
	 */
	public function generateKey(array $options = array());
}
