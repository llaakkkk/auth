<?php

namespace App\Validation;


use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;

/**
* 
*/
class Validator
{
	
	protected $errors;


	public function validate(Request $request, array $rules) {

		// var_dump('works');die;
		foreach ($rules as $field => $rule) {
			try {
			$rule->setName(ucfirst($field))->assert($request->getParam($field));

			} catch (NestedValidationException $e) {
				$this->errors[$field] = $e->getMessages();
			}
		}

		$_SESSION['errors'] = $this->errors;

		return $this;
	}

	public function failed() {
		return !empty($this->errors);
	}

}