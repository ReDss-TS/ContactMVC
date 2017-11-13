<?php

abstract class CoreModel
{
	function __construct()
    {
        foreach ($this->components as $key => $property) {
        	$class = 'ModelComponent' . $property;
            $this->{$property} = new $class;
        }
    }

	public function validateData($data)
	{
		$errorList = $this->Validate->validateData($data, $this->validationRules);
		return $errorList;
	}
}
