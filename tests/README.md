# Tests

The tests are done using a real bot, as such if you run `phpunit` you will likely hit the rate limit. Please be aware of this limitation when running tests.

- [Configuration](#configuration)
- [Writing a TestCase](#writing-a-testcase)
- [Uploading a file for testing](#uploading-a-file-for-testing)

## Configuration

Before you can start testing this library, you need to do a bit of setup.

Create a phpunit.xml from [phpunit.xml.dist](../phpunit.xml.dist) or run

```
cp phpunit.xml.dist phpunit.xml
```

Head over [phpunit.xml.dist](../phpunit.xml.dist) and pupulate the php env section with the followings

- TELEGRAM_TOKEN The telegram bot token given to you by [@BotFather](https://t.me/BotFather)
- TELEGRAM_USERNAME The bot username
- TELEGRAM_CHAT_ID The chat id in which to test the library, get this id can be tricky and it is explained in more detail in another section.

## Writing a TestCase

> The tests are inside the [tests/Unit](unit) folder.

All tests extend [`Telegram\Tests\TestCase`](TestCase.php), this class provide a `telegram()` function that return a ready to use instance of the [`Telegram`](../src/Telegram.php) class.

A simple test case could be something like
```php
<?php

namespace Telegram\Tests\Unit;

use Telegram\Tests\TestCase;

class MyTelegramTest extends TestCase
{
    public function test_getMe()
    {
        // here we use the ->telegram() function to get a Telegram::class instance
        $user = $this->telegram()->getMe();

        $this->assertNotNull($user);
    }
}
```

## Uploading a file for testing

> Make sure a test file under source control is free from copyrights and its safe to use.

Sometimes is necessary to test a file upload, to make sure the file is the same for all the testers, they should be placed in the [tests/files](files) folder under source control.

In a test case you can upload a file with

```php
use Telegram\InputFile;
...
// assuming the test is in the Unit folder
InputFile::create(__DIR__.'/../files/file.zip', 'custom-name.zip')
```

No helpers are planned for retriving a file from the [tests/files](files) folder since the library has not been fully tested yet.
