<?php

require_once('lib/TwitterAPI.class.php');
require_once('lib/context.class.php');
require_once('controller/controller.class.php');

require_once('keys.php');

if (array_key_exists('action', $_REQUEST)) {
	$action = $_REQUEST['action'];
	$api = new TwitterAPI($keys);

	$context = Context::getInstance();

	Controller::$action($context, $_REQUEST, $api);

	$view = 'view/'.$action.'.php';
	if ($context->data != null && array_key_exists('errors', $context->data))
		$view = 'view/error.php';

	include('layout/layout.php');
}
else {
	echo  'No action';
}

?>
