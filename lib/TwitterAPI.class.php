<?php

// http://nouncer.com/oauth/authentication.html

class TwitterAPI
{
	private $credentials;

	public function __construct($APIParams)
	{
		$keys = array(
			'oauth_consumer_key', // API key
			'consumer_secret', // API secret
			'oauth_token', // access token
			'oauth_token_secret' // access token secret
		);

		foreach ($keys as $key) {
			if (!array_key_exists($key, $APIParams)
				|| !isset($APIParams[$key]) || empty($APIParams[$key])) {
				throw new Exception( 'key '.$key.' missing from APIParams');
			}
		}

		$this->credentials = $APIParams;
	}

	public function getRequest($url, $fields)
	{
		return $this->request($url, 'GET', $fields);
	}

	public function postRequest($url, $fields)
	{
		$this->request($url, 'POST', $fields);
	}

	private function request($url, $method, $fields)
	{
		$oauth = array(
			'oauth_consumer_key' => $this->credentials['oauth_consumer_key'],
			'oauth_nonce' => time(),
			'oauth_signature_method' => 'HMAC-SHA1',
			'oauth_token' => $this->credentials['oauth_token'],
			'oauth_timestamp' => time(),
			'oauth_version' => '1.0'
		);

		if ($method == 'GET') {
			// TODO: remove the ? characters in $fileds (?)
			$oauth += $fields;
		}

		$oauth['oauth_signature'] = $this->createSignature($url, $method,
			$oauth);

		$header = array($this->createAuthorizationHeader($oauth), 'Expect:');
		$curlOptions = array(
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_HEADER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT => 10,
			CURLOPT_URL => $url
		);

		if ($method == 'POST')
			$curlOptions[CURLOPT_POSTFIELDS] = $fields;
		else
			$curlOptions[CURLOPT_URL] .= '?'.$this->keyValueToString($fields);

		$curl = curl_init();
		curl_setopt_array($curl, $curlOptions);
		$json = curl_exec($curl);
		curl_close($curl);

		return $json;
	}

	private function createSignatureBaseString($url, $method, $oauthParams)
	{
		$start = $method.'&'.rawurlencode($url).'&';
		$params = array();
		ksort($oauthParams);

		foreach ($oauthParams as $key => $value)
			$params[] = $key.'='.$value;

		return ($start.rawurlencode(implode('&', $params)));
	}

	private function createSignature($url, $method, $oauthParams)
	{
		$baseString = $this->createSignatureBaseString($url, $method,
			$oauthParams);
		$compositeKey = rawurlencode($this->credentials['consumer_secret'])
			.'&'.rawurlencode($this->credentials['oauth_token_secret']);
		$oauthSignature = base64_encode(hash_hmac('sha1', $baseString,
			$compositeKey, true));

		return $oauthSignature;
	}

	private function createAuthorizationHeader($oauth)
	{
		$ret = 'Authorization: OAuth ';
		$values = array();

		foreach ($oauth as $key => $value)
			$values[] = $key.'="'.rawurlencode($value).'"';

		return ($ret.implode(', ', $values));
	}

	public static function keyValueToString($kv)
	{
		$ret = array();

		foreach ($kv as $key => $value)
			$ret[] = $key.'='.$value;

		return implode('&', $ret);
	}
}

?>
