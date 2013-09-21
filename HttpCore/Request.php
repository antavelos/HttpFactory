<?php
// HttpFactory/HttpCore/Request.php

namespace HttpFactory\HttpCore;

/**
 * Implements the HTTP request 
 * 
 * @author Alexandros Ntavelos
 * @package HttpFactory.HttpCore
 */
class Request extends Curl
{
    /**
     * The HTTP request method
     * @var string $method
     */
    private $method;

    /**
     * The request URL
     * @var string $url
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

    /**
     * The constructor of the Request
     *
     * @param string $method The HTTP request method
     */
    public function __construct($method)
    {        
        parent::__construct();
        $this->optionsPerMethod($method);        
        $this->method = $method;
        $this->headers = array();
        $this->addOption(CURLOPT_RETURNTRANSFER, true); // returns the result on
                                                        // success
    }

    /**
     * Implements the HTTP request 
     *
     * @return array The response body and code
     */
    public function send()
    {
        $this->checkVariables();
        $result = $this->exec();
        $code = $this->info(CURLINFO_HTTP_CODE);

        return array(
            "body" => $result,
            "code" => $code,
        );
    }

    /**
     * Gets the HTTP request method.
     *
     * @return string $method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Sets the request URL and adds a CURLOPT_URL option.
     *
     * @param string $url The HTTP request URL
     *
     * @return self
     */
    public function setUrl($url)
    {
        $this->addOption(CURLOPT_URL, $url);
        $this->url = $url;

        return $this;
    }

    /**
     * Gets the request URL.
     *
     * @return string $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the HTTP request body and adds a CURLOPT_POSTFIELDS option for
     * POST or PUT methods 
     * 
     * @param string $body $body the body
     *
     * @return self
     */
    public function setBody($body)
    {
        if ($this->method == "POST" || $this->method == "PUT") {
            $this->addOption(CURLOPT_POSTFIELDS, $body);
        }
        $this->body = $body;

        return $this;
    }

    /**
     * Gets the HTTP request body.
     *
     * @return string $body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Sets an HTTP request header.
     *
     * @param array $header The header to be added
     *
     * @return self
     */
    public function setHeaders($header)
    {
        $this->addOption(CURLOPT_HTTPHEADER, $header);
        $this->headers[] = $header;

        return $this;
    }

    /**
     * Gets the The HTTP request headers.
     *
     * @return array $headers
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Assigns the appropriate header according to the HTTP request method
     *
     * @param  string $method The HTTP request method
     */
    private function optionsPerMethod($method)
    {
        switch ($method) {
            case "GET":
                break;
            case "POST":
                $this->addOption(CURLOPT_POST, true);
                break;
            case "PUT":
                $this->addOption(CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case "DELETE":
                $this->addOption(CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
            default:
                throw new \Exception("Invalid request method");
        }
    }

    /**
     * Checks whether body and url are set
     */
    private function checkVariables()
    {
        if (!isset($this->url)) {
            throw new \Exception("No request URL is specified");
        }

        if ($this->method == "POST" || $this->method == "PUT") {
            if (!isset($this->body)) {
                throw new \Exception("No request body is specified");
            }
        }
    }
}
