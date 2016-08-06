<?php
/**
 * Amazon strategy for Opauth
 * based on https://login.amazon.com/documentation
 *
 * More information on Opauth: http://opauth.org
 *
 * @copyright    Copyright © 2014 Illimar Tambek (https://github.com/ragulka)
 * @link         http://opauth.org
 * @package      Opauth.GoogleStrategy
 * @license      MIT License
 */

/**
 * Amazon strategy for Opauth
 * based on https://login.amazon.com/documentation
 *
 * @package			Opauth.Amazon
 */
class SVAmazonStrategy extends OpauthStrategy{

	/**
	 * Compulsory config keys, listed as unassociative arrays
	 */
	public $expects = array( 'client_id', 'client_secret', 'state' );

	/**
	 * Optional config keys, without predefining any default values.
	 */
	public $optionals = array( 'redirect_uri', 'scope' );

	/**
	 * Optional config keys with respective default values, listed as associative arrays
	 * eg. array('scope' => 'email');
	 */
	public $defaults = array(
		'redirect_uri' => '{complete_url_to_strategy}oauth2callback',
		'scope' => 'profile'
	);

	/**
	 * Auth request
	 */
	public function request(){
		$url = 'https://www.amazon.com/ap/oa';
		$params = array(
			'client_id'     => $this->strategy['client_id'],
			'redirect_uri'  => $this->strategy['redirect_uri'],
			'response_type' => 'code',
			'scope'         => $this->strategy['scope'],
			'state'         => $this->strategy['state'],
		);

		foreach ($this->optionals as $key){
			if (!empty($this->strategy[$key])) $params[$key] = $this->strategy[$key];
		}

		$this->clientGet($url, $params);
	}

	/**
	 * Internal callback, after OAuth
	 */
	public function oauth2callback() {

		// validate state parameter
		if ( ! $this->is_state_valid() ) {

			return $this->invalid_state_callback();
		}

		if (array_key_exists('code', $_GET) && !empty($_GET['code'])){
			$code = $_GET['code'];
			$url = 'https://api.amazon.com/auth/o2/token';
			$params = array(
				'code' => $code,
				'client_id' => $this->strategy['client_id'],
				'client_secret' => $this->strategy['client_secret'],
				'redirect_uri' => $this->strategy['redirect_uri'],
				'grant_type' => 'authorization_code'
			);
			$response = $this->serverPost($url, $params, null, $headers);

			$results = json_decode($response);

			if (!empty($results) && !empty($results->access_token)){
				$userinfo = $this->userinfo($results->access_token);

				$this->auth = array(
					'uid' => $userinfo['user_id'],
					'info' => array(),
					'credentials' => array(
						'token' => $results->access_token,
						'expires' => date('c', time() + $results->expires_in)
					),
					'raw' => $userinfo
				);

				if (!empty($results->refresh_token))
				{
					$this->auth['credentials']['refresh_token'] = $results->refresh_token;
				}

				$this->mapProfile($userinfo, 'name', 'info.name');
				$this->mapProfile($userinfo, 'email', 'info.email');

				$this->callback();
			}
			else{
				$error = array(
					'code' => 'access_token_error',
					'message' => 'Failed when attempting to obtain access token',
					'raw' => array(
						'response' => $response,
						'headers' => $headers
					)
				);

				$this->errorCallback($error);
			}
		}
		else{
			$error = array(
				'code' => 'oauth2callback_error',
				'raw' => $_GET
			);

			$this->errorCallback($error);
		}
	}

	/**
	 * Queries People API for user info
	 *
	 * @param string $access_token
	 * @return array Parsed JSON results
	 */
	private function userinfo($access_token){
		$userinfo = $this->serverGet('https://api.amazon.com/user/profile', array('access_token' => $access_token), null, $headers);
		if (!empty($userinfo)){
			return $this->recursiveGetObjectVars(json_decode($userinfo));
		}
		else{
			$error = array(
				'code' => 'userinfo_error',
				'message' => 'Failed when attempting to query for user information',
				'raw' => array(
					'response' => $userinfo,
					'headers' => $headers
				)
			);

			$this->errorCallback($error);
		}
	}
}
