<?php

namespace app\models;


/**
 * Curl class
 */
class Curl
{

	/**
   * @var string
   * base URL to be request
   */
	protected $_baseUrl = '';

  /**
   * @var resource|null
   * Holds cURL-Handler
   */
  public $curl = null;

  /**
   * @param string  $url
   *
   * @return mixed response
   */
  public function get($url, $raw=false)
  {
  	$option = [
  		CURLOPT_USERAGENT      => 'Task-Curl-Agent',
  		CURLOPT_TIMEOUT        => 30,
  		CURLOPT_CONNECTTIMEOUT => 30,
  		CURLOPT_RETURNTRANSFER => true,
  		CURLOPT_HEADER         => true,
  		CURLOPT_CUSTOMREQUEST => 'GET'
  	];

  	$this->_baseUrl = $url;
  	return $this->_httpRequest($option, $raw);
  }

  public function getUrl()
  {
		return $this->_baseUrl;
  }

	/**
   * Performs HTTP request
   *
   * @param array  $option
   * @param bool  $raw
   *
   * @return mixed
   */
	protected function _httpRequest($option, $raw)
	{		
		$this->curl = curl_init($this->getUrl());
		curl_setopt_array($this->curl, $option);
		$response = curl_exec($this->curl);

		// check for error
		if ($response === false) {
			$errorCode = curl_errno($this->curl);
			$errorText = curl_strerror($this->errorCode);
			// TODO 
		}

		return $raw ? $response : substr($response, curl_getinfo($this->curl, CURLINFO_HEADER_SIZE));
	}
}