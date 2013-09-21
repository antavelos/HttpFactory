<?php
//HttpFactory/HttpTransaction/HttpTransaction.php

namespace HttpFactory\HttpTransaction;

use HttpFactory\HttpCore\Request;
use HttpFactory\HttpCore\Response;

/**
 * Implements the basic HTTP transactions: GET, POST, PUT, DELETE 
 * 
 * @author Alexandros Ntavelos
 * @package HttpFactory.HttpTransaction
 */
class HttpTransaction
{
	public function __construct()
	{
	}

	/**
	 * Implementation of a GET request
	 * @param  string $url The request URL
	 * @return [type]      [description]
	 */
	public function get($url)
	{
		return $this->transact('GET', $url);
	}

	/**
	 * Implementation of a POST request
	 * @param  string $url The request URL
	 * @param  string $body The request body
	 * @return [type]      [description]
	 */
	public function post($url, $body)
	{
		return $this->transact('POST', $url, $body);		
	}

	/**
	 * Implementation of a PUT request
	 * @param  string $url The request URL
	 * @param  string $body The request body
	 * @return [type]      [description]
	 */
	public function put($url, $body)
	{
		return $this->transact('PUT', $url, $body);		
	}

	/**
	 * Implementation of a DELETE request
	 * @param  string $url The request URL
	 * @return [type]      [description]
	 */
	public function delete($url)
	{
		return $this->transact('DELETE', $url);		
	}

	/**
	 * Abstract Implementation of an HTTP request
	 * @param  string $method The request method
	 * @param  string $url The request URL
	 * @param  string $body The request body
	 * @return HttpFactory\HttpCore\Response
	 */
	private function transact($method, $url, $body = null)
	{	
		$request = new Request($method);
		$response = new Response();
		
		// prepare the request
		$request->setUrl($url);
		$request->setBody = $body !== null ? $body : null;

		// execute the request
		$result = $request->send();

		// prepare the response
		$response->setBody($result['body']);
		$response->setCode($result['code']);

		return $response;
	}
}