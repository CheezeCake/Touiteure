<?php

class Controller
{
	public static function home($context, $request, $api)
	{
		$context->tweets = json_decode(
			$api->getRequest('https://api.twitter.com/1.1/statuses/home_timeline.json', array('count' => 10)),
			true);

		Controller::process_tweet($context);

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

		Controller::process_tweet($context);
	}

	public static function load_home_tweets($context, $request, $api)
	{
		$context->tweets = json_decode(
			$api->getRequest('https://api.twitter.com/1.1/statuses/home_timeline.json',
			array('count' => 10, 'max_id' => $request['id'])),
			true);

		Controller::process_tweet($context);
	}

	public static function load_profile_tweets($context, $request, $api)
	{
		$json = $api->getRequest('https://api.twitter.com/1.1/statuses/user_timeline.json',
			array('screen_name' => $request['screen_name'], 'max_id' => $request['id']));
		$context->tweets = json_decode($json, true);

		Controller::process_tweet($context);
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
			$request['status'] = $request['status'];

		$context->data = json_decode($api->postRequest('https://api.twitter.com/1.1/statuses/update.json', $request), true);
	}

	private static function process_tweet(&$context)
	{
		$tweets = $context->tweets;

		for ($tweetIndex = 0; $tweetIndex < sizeof($context->tweets); $tweetIndex++) {
			$tweet = $tweets[$tweetIndex];

			$text = $tweet['text'];

			// urls
			$text = preg_replace_callback('/((https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w\.-]*)*\/?)/',
				function ($match) {
					return '<a href="'.$match[0].'">'.$match[0].'</a>';
				},
					$text);

			// hashtags
			$text = preg_replace_callback('/#\w*/',
				function ($match) {
					return '<strong>'.$match[0].'</strong>';
				},
					$text);

			// user mentions
			$text = preg_replace_callback('/@\w*/',
				function ($match) {
					return '<a href="Touiteure.php?action=profile&screen_name='.substr($match[0], 1).'">'.$match[0].'</a>';
				},
					$text);

			$tweet['text'] = $text;
			$tweets[$tweetIndex] = $tweet;
		}

		$context->tweets = $tweets;
	}
}

?>
