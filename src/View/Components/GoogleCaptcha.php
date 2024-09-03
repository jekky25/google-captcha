<?php

namespace J25\GoogleCaptcha\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GoogleCaptcha extends Component
{
	public $reSiteKey 	= "RE_SITE_KEY";
	public $reSecKey 	= "RE_SEC_KEY";

	/**
	* Create a new component instance.
	*/
	public function __construct()
	{
		$this->reSiteKey 	= config('captcha.re_site_key');
		$this->reSecKey 	= config('captcha.re_sec_key');
	}

	/**
	* Get the view / contents that represent the component.
	*/
	public function render(): View|Closure|string
	{
		return view('captcha::captcha');
	}
}