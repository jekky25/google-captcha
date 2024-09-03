<?php

namespace J25\GoogleCaptcha\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use J25\GoogleCaptcha\View\Components\GoogleCaptcha;

class GoogleCaptchaServiceProvider extends ServiceProvider
{
	/**
	* Register services.
	*/
	public function register(): void
	{
		$this->mergeConfigFrom(__DIR__ . '/../../config/captcha.php', 'captcha');
	}

	/**
	* Bootstrap services.
	*/
	public function boot(): void
	{
		$this->publishes([__DIR__ . '/../config/captcha.php' => config_path('captcha.php')], 'config');
		$this->loadViewsFrom(__DIR__.'/../resources/views', 'captcha');
		Blade::component('google-captcha', GoogleCaptcha::class);
	}
}