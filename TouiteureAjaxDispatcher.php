<?php

require_once('lib/TwitterAPI.class.php');
require_once('lib/context.class.php');
require_once('controller/controller.class.php');

require_once('keys.php');

$action = (array_key_exists('action', $_REQUEST)) ? $_REQUEST['action'] : 'home';

$api = new TwitterAPI($keys);

$context = Context::getInstance();

Controller::$action($context, $_REQUEST, $api);

$view = 'view/'.$action.'.php';
if ($context->data != null && array_key_exists('errors', $context->data))
	$view = 'view/error.php';

include($view);

?>

