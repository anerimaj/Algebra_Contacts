<?php

class Validation
{
	private $_passed = false;
	private $_errors = array();
	private $_db = null;
	
	public function __construct()
	{
		$this->_db = DB::getInstance();
	}
	
	public function check($items = array())
	{
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rule_value) {
				
				$field = sanitize($item);
				$value = Input::get($field);
				
				if($rule === 'required' && empty($value)) {
					$this->addError($field, "Field {$field} is required.");
				} else if(!empty($value)) {
					switch($rule) {
						case 'min':
							if(strlen($value) < $rule_value) {
								$this->addError($field, "Field {$field} must have a minimum of {$rule_value} characters.");
							}
						break;
						case 'max':
							if(strlen($value) > $rule_value) {
								$this->addError($field, "Field {$field} must have a maximum of {$rule_value} characters.");
							}
						break;
						case 'match':
							if($value != Input::get($rule_value)) {
								$this->addError($field, "Field {$field} must match {$rule_value}.");
							}
						break;
						case 'unique':
							$check = $this->_db->get('id', $rule_value, array($field, '=', $value));
							if($check->count()) {
								$this->addError($field, "{$field} already exists.");
							}
						break;
					}
				}
				
			}
		}
		
		if(empty($this->_errors)) {
			$this->_passed = true;
		}
		
		return $this;
	}
	
	private function addError($field, $error)
	{
		$this->_errors[$field] = $error;
	}
	
	public function hasError($field)
	{
		if(isset($this->_errors[$field])) {
			return $this->_errors[$field];
		}
		return false;
	}
	
	public function passed()
	{
		return $this->_passed;
	}
	
	public function errors()
	{
		return $this->_errors;
	}
	
}









