<?php
// HttpFactory/Core/Curl.php

namespace HttpFactory\Core;

/**
 * Wraps up the basic curl functions
 * 
 * @author Alexandros Ntavelos
 * @package HttpFactory.Core
 */
class Curl
{
	/**
     * The cURL handler
     * @var cURL handle $curlHandler
     * 
	 */
	private handler;

	/**
	 * Initializes the handler
	 */
	public function __construct()
	{
		$this->handler = $this->initialize();
	}

	public function __destruct()
	{
		$this->close();
	}

	/**
	 * Initializes the handler
	 *
	 * @return   returns a cURL handler
	 */
	private function init()
	{
		try {
			return curl_init();
		}
		catch \Exception(e) {
			return false;
		}
	}

	/**
	 * Closes the cURL resource
	 * 
	 * @return boolean returns true or false depending on the outcome of the function
	 */
	private function close()
	{
		try {
			return curl_close();
		}
		catch \Exception(e) {
			return false;
		}

		return true;
	}

	/**
	 * Performs a cURL session
	 * @return 
	 */
	public function exec()
	{
		return curl_exec($this->handler);
	}

	/**
	 * Sets an option on the given cURL session handle.
	 * 
	 * @param string $option
	 * @param mixed $value
	 *
	 * @return  boolean true or false depending on the outcome of the function
	 */
	public function addOption($option, $value)
	{
		return curl_setopt($this->handler, $option, $value);
	}

}