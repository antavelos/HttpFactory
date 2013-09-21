<?php
// HttpFactory/HttpCore/Curl.php

namespace HttpFactory\HttpCore;

/**
 * Wraps up the basic curl functions
 * 
 * @author Alexandros Ntavelos
 * @package HttpFactory.HttpCore
 */
class Curl
{
    /**
     * The cURL handler
     * @var cURL handle $curlHandler
     * 
     */
    private $handler;

    /**
     * Initializes the handler
     *
     * @throws Exception If cURL handler initialization fails
     */
    public function __construct()
    {
        $this->handler = curl_init();
        if ($this->handler === false) {
            throw new \Exception("Error on cURL handler initialization:" . 
                curl_error($this->handler));
        }
    }

    /**
     * Closes the cURL session
     */
    public function __destruct()
    {
        curl_close($this->handler);
    }

    /**
     * Performs a cURL session
     * @throws Exception If cURL session execution fails
     */
    protected function exec()
    {
        $result = curl_exec($this->handler);
        if ($result === false) {
            throw new \Exception("Error on cURL session execution:" . 
                curl_error($this->handler));
        }
    }

    /**
     * Returns request info
     * @throws Exception If cURL info retrieval fails
     */
    protected function info($infoCode)
    {
        $result = curl_getinfo($this->handler, $infoCode);
        if ($result === false) {
            throw new \Exception("Error on cURL info retrieval:" . 
                curl_error($this->handler));
        }
    }

    /**
     * Sets an option on the given cURL session handle.
     * 
     * @param string $option
     * @param mixed $value
     *
     * @return  boolean true or false depending on the outcome of the function
     */
    protected function addOption($option, $value)
    {
        if(curl_setopt($this->handler, $option, $value) === false) {
            throw new \Exception("Error on setting option " . $option . 
                " with value " . $value . "for cURL transfer:" . 
                curl_error($this->handler));
        } 
    }
}
