<?php

/**
 * Dribbble API PHP Lite Wrapper : A PHP wrapper for the Dribbble API v1 using only the Client Access Token
 * 
 * @package   OM-Dribbble-API-PHP-Lite
 * @author    Oscar Marcelo
 * @since     12.03.2015
 * @version   1.0
 * @license   MIT License
 * @link      http://github.com/oscarmarcelo/Dribbble
 */

class Dribbble {

	const API_URL = 'https://api.dribbble.com/v1/';

	private $access_token;

	private $curl_options = array(
		CURLOPT_CONNECTTIMEOUT => 10,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT        => 60,
		CURLOPT_USERAGENT      => 'om-dribbble-api-php-lite'
	);

	/**
	 * The Class constructer
	 * @param type array $settings The settings to be used.
	 * @return type
	 */
	function __construct($token) {

		if (!in_array('curl', get_loaded_extensions()))
			throw new Exception('You need to install cURL, see: http://curl.haxx.se/docs/install.html');

		if (!isset($token))
			throw new Exception('Make sure you are passing in the correct parameters');

		$this->access_token = $token;

	}

	/**
	 * Makes a GET call.
	 * @param string $endpoint The endpoint.
	 * @param array $params The parameters for the endpoint.
	 * @return object
	 */
	function get($endpoint, $params = array()) {

		$ch = curl_init();
		$options = $this->curl_options;
		$options[CURLOPT_URL] = self::API_URL . $endpoint . '?access_token=' . $this->access_token;
		if (!empty($params))
			$options[CURLOPT_URL].= '&' . http_build_query($params, null, '&');

		curl_setopt_array($ch, $options);

		$result = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		if ($result === false)
			throw new Exception(curl_error($ch), curl_errno($ch));

		$verify = json_decode($result);

		if (isset($verify->message))
			throw new Exception($verify->message, $status);

		return $result;

	}

	/**
	 * Gets information of a user.
	 * @param mixed $user The username or id of a user
	 * @param array $params 
	 * @return object
	 */
	function user($user, $params = array()) {

		return $this->get(sprintf('/users/%s', $user), $params);

	}

	/**
	 * Gets information of the authenticated user
	 * @param array $params 
	 * @return object
	 */
	function current_user($params = array()) {

		return $this->get('/user', $params);

	}

	/**
	 * Gets the shots of a user
	 * @param mixed $user The username or id of a user
	 * @param array $params 
	 * @return object
	 */
	function user_shots($user, $params = array()) {

		return $this->get(sprintf('/users/%s/shots', $user), $params);

	}

	/**
	 * Gets the shots of the authenticated user
	 * @param array $params 
	 * @return object
	 */
	function current_user_shots(, $params = array()) {

		return $this->get('/user/shots', $params);

	}

}