<?php

class Controller
{
	public static function profile($context, $request, $api)
	{
		$json = $api->getRequest('https://api.twitter.com/1.1/users/show.json', $request);
		$context->data = json_decode($json, true);

		$json = $api->getRequest('https://api.twitter.com/1.1/statuses/user_timeline.json',
			array('screen_name' => $request['screen_name']));

		$context->tweets = json_decode($json, true);
	}
}

?>
