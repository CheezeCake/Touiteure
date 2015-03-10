<?php
class Context
{
	private $data;

	const SUCCESS = 'Success';
	const ERROR = 'Error';
	const NONE = 'None';

	private static $instance = null;

	public static function getInstance()
	{
		if(self::$instance==null)
			self::$instance=new context();
		return self::$instance;
	}

	private function __construct()
	{}

	public function redirect($url)
	{
		header("location:".$url);
	}

	public function __get($prop)
	{
		return $this->data[$prop];
	}

	public function __set($prop,$value)
	{
		$this->data[$prop]=$value;
	}

	public function __isset($prop)
	{
		return isset($this->data[$prop]);
	}
}
