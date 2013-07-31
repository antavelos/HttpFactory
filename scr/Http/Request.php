<?php
// HttpFactory/Core/Request.php

namespace HttpFactory\Core;

use HttpFactory\Core\Curl;

/**
 * Implements the HTTP request 
 */
class Request
{
	/**
	 * A cURL handler
	 * @var \HttpFactory\Core\Curl
	 */
	private $curlHandler;

	/**
	 * The HTTP request method
	 * @var string
	 */
	private $method;

	/**
	 * The request URL
	 * @var string
	 */
	private $url;

    /**
     * The HTTP request headers
     * @var array $headers
     */
    private $headers;

    /**
     * The HTTP request body
    * @var string $body
    */
    private $body;


}