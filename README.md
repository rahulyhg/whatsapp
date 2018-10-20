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
composer require leRisen/whatsapp
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

### Get account status and QR code for authorization

```php
$api->getStatus();
```
 - return `WhatsAppApiRequest`

### Direct link to the QR code as an image

```php
$api->getQrCode();
```
 - return `WhatsAppApiRequest`

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
    'phone': '79615238147',
    'body': 'Hello, brother! 🍏',
];

$api->sendMessage($data);
```
 - `$data` (array) - params (required)
 - return `WhatsAppApiRequest`

### Send a file

```php
$data = [
    'chatId': '79615238147@c.us',
    'body': 'https://upload.wikimedia.org/wikipedia/ru/3/33/NatureCover2001.jpg',
    'filename': 'cover.jpg',
];

$api->sendFile($data);
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

### Show a list of messages that are queued for shipment but not yet sent

```php
$api->showMessagesQueue();
```
 - return `WhatsAppApiRequest`

### Clear the message queue.
```php
$api->clearMessagesQueue();
```
 - return `WhatsAppApiRequest`

### Enable or disable the receipt of information about the delivery and reading of sent messages ack in the webhook
```php
$enable = true;

$api->notifications($enable);
```
 - return `WhatsAppApiRequest`

### Sign out and request a new QR code
```php
$api->logout();
```
 - return `WhatsAppApiRequest`

### Reload your WhatsApp instance
```php
$api->logout();
```
 - return `WhatsAppApiRequest`
