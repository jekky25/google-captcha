<?php

namespace J25\GoogleCaptcha;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use J25\GoogleCaptcha\Request\Curl;

class GoogleCaptcha implements ValidationRule
{
	/**
	* Indicates whether the rule should be implicit.
	*
	* @var bool
	*/
	public $implicit 		= true;
	private $reSecKey 		= '';
	private $recaptcha_url 	= 'https://www.google.com/recaptcha/api/siteverify';
	private $score 			= '0.2';
	private $params			= [];
	private $response		= '';
	
	/**
	* Create a new component instance.
	*/
	public function __construct()
	{
		$this->reSecKey 	= config('captcha.re_sec_key');
	}

	/**
	* Run the validation rule.
	*
	* @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	*/
	public function validate(string $attribute, mixed $response, Closure $fail): void
	{
		$this->response = $response;
		$output = (new Curl)->submit($this);
		$recaptcha = json_decode($output);
		if ($this->notPass($recaptcha)) $fail('Капча не пройдена');
	}

	/**
	* Put params into array
	*
	*/
	public function prepareParams() :array
	{
		$this->params = [
			'secret' 	=> $this->reSecKey,
			'response' 	=> $this->response,
			'remoteip' 	=> $_SERVER['REMOTE_ADDR']
		];

		return $this->params;
	}

	/**
	* Get a captcha URL
	*
	*/
	public function getUrl() :string
	{
		return $this->recaptcha_url;
	}
	
	/**
	* Check recaptha validation
	* @param object $recaptcha
	*/
	public function notPass($recaptcha) :bool
	{
		return ($recaptcha->success === false || $recaptcha->score < $this->score);
	}
}