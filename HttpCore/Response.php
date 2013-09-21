<?php
// HttpFactory/HttpCore/Response.php

namespace HttpFactory\HttpCore;

/**
 * Implements the HTTP response 
 * 
 * @author Alexandros Ntavelos
 * @package HttpFactory.HttpCore
 */
class Response
{
	/**
	 * The HTTP response bosy
	 * @var string
	 */
	private $body;

	/**
	 * The HTTP response code
	 * @var integer
	 */
	private $code;

	/**
	 * The constructor
	 */
	public function __construct()
	{

	}

    /**
     * Gets the The HTTP response bosy.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Sets the The HTTP response bosy.
     *
     * @param string $body the body
     *
     * @return self
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Gets the The HTTP response code.
     *
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Sets the The HTTP response code.
     *
     * @param integer $code the code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
}
