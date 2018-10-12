# WhatsApp [![forthebadge](http://forthebadge.com/images/badges/built-with-love.svg)](http://forthebadge.com)

<p align="center">
    <img src="https://poser.pugx.org/le-risen/WhatsApp/v/stable.svg" alt="Version">
    <img src="https://poser.pugx.org/le-risen/WhatsApp/license.svg" alt="License">
    <img src="https://img.shields.io/github/last-commit/leRisen/WhatsApp/master.svg" alt="Last commit">
    <img src="https://poser.pugx.org/le-risen/WhatsApp/downloads.svg" alt="Downloads">
</p>

a package for work with [api chat-api.com](https://chat-api.com)

## Table of Contents
- [Requirements](#requirements)
- [Install](#install)
- [Sample](#sample)
- [Functions](#functions)

## Requirements
- PHP 7.1+ (with enabled cURL)
- [Composer](https://getcomposer.org)

## Install

Run this command in console:
```
composer require leRisen/WhatsApp
```

## Sample

```php
/*
    'https://foo.chat-api.com/' - api url,
    `qwerty` - token
*/
$api = new \leRisen\WhatsApp\WhatsAppApiClient('https://foo.chat-api.com/', 'qwerty');

$request = $api->messagesList();

$request->setErrorHandler(function ($error) {
    var_dump($error);
});

$request->setSuccessHandler(function ($result) {
    var_dump($result);
});

$request->execute();
```

## Functions

### Set api url

```php
setApiUrl($url)
```
 - `$url` (string)
 - return `self`

Example:
```php
$api->setApiUrl('https://foo.chat-api.com/');
```

### Set token

```php
setToken($key)
```
 - `$key` (string)
 - return `self`
 
Example:
```php
$api->setToken('qwerty');
```

### Get api url

```php
getApiUrl()
```
 - return `string`

Example:
```php
$api->getApiUrl(); // https://foo.chat-api.com/
```

### Get token

```php
getToken()
```
 - return `string`

Example:
```php
$api->getToken(); // qwerty
```

### Set webhook

```php
$api->setWebHook($url);
```
 - return `WhatsAppApiRequest`

### Get webhook

```php
$api->getWebHook();
```
 - return `WhatsAppApiRequest`

### Send a message

```php
$data = [
    'chatId': '79615238147@c.us',
    'body': 'https://upload.wikimedia.org/wikipedia/ru/3/33/NatureCover2001.jpg',
    'filename': 'cover.jpg',
];

$api->sendMessage($data);
```
 - `$data` (array) - params (required)
 - return `WhatsAppApiRequest`

### Returns messages list

```php
$data = [
    'lastMessageNumber' => 99,
];

$api->messagesList($data);
```
 - `$data` (array) - params (required)
 - return `WhatsAppApiRequest`
