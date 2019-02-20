<?php

namespace Telegram\Tests\Unit;

use Telegram\Tests\TestCase;

class TelegramTestAsync extends TestCase
{
    public function test_sendMessageAsync()
    {
        $chat_id = $_ENV['TELEGRAM_CHAT_ID'];

        $params = [
            'chat_id' => $chat_id,
            'text' => 'ciao',
            'disable_notification' => true
        ];

        $message = $this->telegram()->sendMessageAsync($params)->wait();

        $this->assertInstanceOf(\Telegram\Types\Message::class, $message);
        $this->assertEquals($message->text, 'ciao');
        $this->assertEquals($message->chat->id, $_ENV['TELEGRAM_CHAT_ID']);
    }
}