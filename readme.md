# Laravel Jazz Cash Package

## Step 1

```bash
composer require waqarraza/jazzcash-laravel
```

## Step 2

Add these following lines in config/app.php

```php
'providers' => [
    ...
    Waqarraza\Jazzcashlaravel\ServiceProvider::class,
    ...
]

'aliases' => [
    ...
    'JazzCash' => Waqarraza\Jazzcashlaravel\Facades\JazzCash::class
    ...
]
```

## Step 3

publish config and add details

```bash
php artisan vendor:publish --provider="Waqarraza\Jazzcashlaravel\ServiceProvider"
```

# Usage

Add merchant details in config/jazzcash.php file

```php
'merchant_id' => '<your merchant id>',
'password' => '<your password>',
'integerity_salt' => '<your integerity salt>',
```

Set return page in config

```php
'return_url' => 'http://127.0.0.1/returnpage',
```

To checkout add function in controller

```php
public function checkout() {
    $amount = 10 ; // in pkr
    $description = "Some cehckout details";
    return JazzCash::checkout($amount, $description)
}

public function checkout_return(Request $request) {
    if($request->get('pp_ResponseCode') === '000') {
        ... do something on success
    } else {
        ... do something in failure
    }
}

```

checkout function will return a view which submits a request to jazz cash checkout page.

checkout_return function will be called on `return_url`

# Sandbox

For testing you can use this number `03123456789`
