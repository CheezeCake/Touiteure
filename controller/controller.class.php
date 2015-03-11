<?php

class Controller
{
	public static function home($context, $request, $api)
	{
		$context->tweets = json_decode(
			$api->getRequest('https://api.twitter.com/1.1/statuses/home_timeline.json', array('count' => 10)),
			true);

		$data = json_decode(
			$api->getRequest('https://api.twitter.com/1.1/account/settings.json'),
			true);
		$context->tmp = $data;
		$screen_name = $data['screen_name'];

		$json = $api->getRequest('https://api.twitter.com/1.1/users/show.json', array('screen_name' => $screen_name));
		$context->data = json_decode($json, true);
	}

	public static function profile($context, $request, $api)
	{
		$context->data = json_decode(
			$api->getRequest('https://api.twitter.com/1.1/users/show.json', $request),
			true);

		$json = $api->getRequest('https://api.twitter.com/1.1/statuses/user_timeline.json',
			array('screen_name' => $request['screen_name']));
		$context->tweets = json_decode($json, true);
	}

	public static function profile_search($context, $request, $api)
	{}

	public static function settings($context, $request, $api)
	{
		$context->settings = json_decode($api->getRequest('https://api.twitter.com/1.1/account/settings.json'), true);
		$screen_name = $context->settings['screen_name'];

		$json = $api->getRequest('https://api.twitter.com/1.1/users/show.json', array('screen_name' => $screen_name));
		$context->data = json_decode($json, true);
	}

	public static function change_settings($context, $request, $api)
	{
		$context->data = json_decode($api->postRequest('https://api.twitter.com/1.1/account/update_profile.json', $request), true);
	}

	public static function tweet($context, $request, $api)
	{
		if (array_key_exists('status', $request))
			$request['status'] = urlencode($request['status']);

		$context->data = json_decode($api->postRequest('https://api.twitter.com/1.1/statuses/update.json', $request), true);
	}
}

?>
