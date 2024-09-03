## Гугл капча 3.0 для ларавел
## Google captcha 3.0 for laravel 10,11

## Installation
Require this package with composer:
```
composer require j25/google-captcha
```

Update your packages with ```composer update``` or install with ```composer install```.

## Usage

To use the Google Captcha Service Provider, you have to register the provider in your Laravel framework. 
Find the `providers` key in `config/app.php` and register the Captcha Service Provider.

```php
    'providers' => [
        // ...
        'J25\GoogleCaptcha\Providers\GoogleCaptchaServiceProvider',
    ]
```


## Configuration
You can use two captcha keys when you get them in your google account.

Add them in the .ENV file 

RE_SITE_KEY ="XXXXXXXXXX"
RE_SEC_KEY="XXXXXXXXXX"

## Example
view files
```html
    //post.blade.php
<form action="{{ route ('post')}}">
    <x-google-captcha />
</form 
```
controller files
```php
        use J25\GoogleCaptcha\GoogleCaptcha;


        Validator::make($input, [
            'recaptcha_response' => 'required|captcha'
        ])->validate();

        or 
        	public function rules(): array
	        {
        	return [
		    	'name'					=> ['string'],
                'text'					=> ['string'],
	    		'recaptcha_response'	=> ['required', new GoogleCaptcha]
		    ];
	}
```
