# PHP Telegram

A telegram library for PHP.

## Quick Start

```php
use Telegram\Telegram;

$telegram = new Telegram(['token' => '<token>');

 // with the username
$telegram = new Telegram([
    'token' => '<token>',
    'username' => '<username>'
]);

// send a message
$telegram->sendMessage([
    'chat_id' => '<chat_id>',
    'text' => 'Hello i am your telegram bot'
]);
```

## Introduction

> Make sure to visit the official API [documentation](https://core.telegram.org/bots/api#available-methods)

To use this library create a new instance of the [`Telegram\Telegram`](src/Telegram.php#L46) class with an array of options containing:

- `token` - The telegram bot token given to you by [@BotFather](https://t.me/BotFather)
- `username` - The telegram bot username, is optional but you may find its convenient

## Usage

- sendMessage - https://core.telegram.org/bots/api#sendmessage

```php
use Telegram\ParseMode;

$message = $telegram->sendMessage([
    'chat_id' => 123456,

    'parse_mode' => 'markdown', // case insensitive
    // or
    'parse_mode' => ParseMode::MARKDOWN,

    'text' => 'a text message',
    'disable_notification' => true // silent message
]);
```

## Proxy

If you need to setup a proxy you can use the second parameter as a config for the `GuzzleHttp\Client`

```php
$options = [
    'token' => '<token>',
    'username' => '<username>'
];

$config = [
    'defaults' => [
        'proxy'   => '<url>'
    ]
]

$telegram = new Telegram($options, $config);
```