<?php

namespace Telegram\Tests;

use Telegram\Telegram;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * The telegram instance.
     *
     * @var \Telegram\Telegram
     */
    protected $telegram;

    /**
     * Get the telegram instance.
     *
     * @return \Telegram\Telegram
     */
    protected function telegram()
    {
        if (is_null($this->telegram)) {
            $this->telegram = new Telegram([
                'token' => $_ENV['TELEGRAM_TOKEN'],
                'username' => $_ENV['TELEGRAM_USERNAME']
            ]);
        }

        return $this->telegram;
    }
}
