<?php

class Helper
{
	private function __construct(){}
	private function __clone(){}
	
	public static function getHeader($title, $file = 'header')
	{
		$path = 'includes/layout/'.$file.'.php';
		
		if(is_file($path)) {
			return require_once $path;
		}
		
		return false;
	}
	
	public static function getFooter($file = 'footer')
	{
		$path = 'includes/layout/'.$file.'.php';
		
		if(is_file($path)) {
			return require_once $path;
		}
		
		return false;
	}
}