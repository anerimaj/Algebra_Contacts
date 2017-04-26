<?php

class Token
{
	private static $_token;
	
	public function __construct()
	{
		self::$_token = Config::get('session')['sessions']['token_name'];
	}
	private function __clone(){}
	
	public function generate()
	{
		return Session::put(self::$_token, md5(uniqid()));
	}
	
	public function check($token)
	{
		$token_name = self::$_token;
		
		if(Session::exists($token_name) && $token === Session::get($token_name)) {
			Session::delete($token_name);
			return true;
		}
		
		return false;
	}
}