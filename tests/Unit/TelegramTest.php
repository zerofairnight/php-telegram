<?php

namespace Telegram\Tests\Unit;

use Telegram\InputFile;
use Telegram\ChatAction;
use Telegram\Exception\RequestException as TelegramRequestException;
use Telegram\Tests\TestCase;
use PHPUnit\Framework\Constraint\IsType;

class TelegramTest extends TestCase
{
    public function test_errors1()
    {
        $this->expectException(TelegramRequestException::class);

        $chat_id = $_ENV['TELEGRAM_CHAT_ID'];

        $message = $this->telegram()->sendMessage([
            'chat_id' => $chat_id,
            'disable_notification' => true
        ]);
    }

    public function test_errors2()
    {
        $this->expectException(TelegramRequestException::class);

        $chat_id = $_ENV['TELEGRAM_CHAT_ID'];

        $request = new \Telegram\Request('invalid_method', []);

        (new \Telegram\Telegram(['token' => '111:invalid_token']))->send($request);
    }

    public function test_SendDocument()
    {
        $chat_id = $_ENV['TELEGRAM_CHAT_ID'];

        $message = $this->telegram()->sendDocument([
            'chat_id' => $chat_id,
            'document' => InputFile::create(__DIR__.'/../files/file.zip', 'test-name.zip')
        ]);

        $this->assertInstanceOf(\Telegram\Types\Message::class, $message);
        $this->assertInstanceOf(\Telegram\Types\Document::class, $message->document);
        $this->assertInternalType(IsType::TYPE_STRING, $message->document->file_id);
        $this->assertEquals('test-name.zip', $message->document->file_name);
        $this->assertEquals('application/zip', $message->document->mime_type);
    }

    public function test_getMe()
    {
        $user = $this->telegram()->getMe();

        $this->assertInstanceOf(\Telegram\Types\User::class, $user);
        $this->assertEquals($user->id, $this->telegram()->getBotId());
        $this->assertEquals($user->is_bot, true);
        $this->assertEquals($user->username, $this->telegram()->getUsername());
    }

    public function test_sendMessage()
    {
        $chat_id = $_ENV['TELEGRAM_CHAT_ID'];
        $text = '/start hello';

        $message = $this->telegram()->sendMessage([
            'chat_id' => $chat_id,
            'text' => $text,
            'disable_notification' => true
        ]);

        $this->assertInstanceOf(\Telegram\Types\Message::class, $message);

        // $message->message_id
        $this->assertInternalType(IsType::TYPE_INT, $message->message_id);

        // $message->from
        $this->assertInstanceOf(\Telegram\Types\User::class, $message->from);
        $this->assertInternalType(IsType::TYPE_INT, $message->from->id);
        $this->assertInternalType(IsType::TYPE_BOOL, $message->from->is_bot);
        $this->assertInternalType(IsType::TYPE_STRING, $message->from->first_name);

        // $message->chat
        $this->assertInstanceOf(\Telegram\Types\Chat::class, $message->chat);
        $this->assertInternalType(IsType::TYPE_INT, $message->chat->id);
        $this->assertInternalType(IsType::TYPE_STRING, $message->chat->type);
        $this->assertInternalType(IsType::TYPE_STRING, $message->chat->first_name);

        $this->assertEquals(null, $message->forward_from);
        $this->assertEquals(null, $message->forward_from_chat);
        $this->assertEquals(null, $message->forward_from_message_id);
        $this->assertEquals(null, $message->forward_signature);
        $this->assertEquals(null, $message->forward_date);

        $this->assertInternalType(IsType::TYPE_INT, $message->date);
        $this->assertEquals($message->text, $text);
        $this->assertEquals($message->chat->id, $_ENV['TELEGRAM_CHAT_ID']);

        $this->assertInternalType(IsType::TYPE_ARRAY, $message->entities);

        $this->assertCount(1, $message->commands());
    }

    public function test_sendMessage_forwardMessage_editMessageText()
    {
        $chat_id = $_ENV['TELEGRAM_CHAT_ID'];

        $message = $this->telegram()->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'ciao',
            'disable_notification' => true
        ]);

        $this->assertInstanceOf(\Telegram\Types\Message::class, $message);
        $this->assertEquals($message->text, 'ciao');
        $this->assertEquals($message->chat->id, $_ENV['TELEGRAM_CHAT_ID']);


        $message = $this->telegram()->editMessageText([
            'chat_id' => $chat_id,
            'message_id' => $message->message_id,
            'text' => 'changed'
        ]);

        $this->assertInstanceOf(\Telegram\Types\Message::class, $message);
        $this->assertEquals($message->text, 'changed');

        $message = $this->telegram()->forwardMessage([
            'chat_id' => $chat_id,
            'from_chat_id' => $chat_id,
            'message_id' => $message->message_id,
            'disable_notification' => true
        ]);

        $this->assertInstanceOf(\Telegram\Types\Message::class, $message);
        $this->assertEquals($message->text, 'changed');
        $this->assertEquals($message->chat->id, $_ENV['TELEGRAM_CHAT_ID']);

        $message = $this->telegram()->deleteMessage([
            'chat_id' => $chat_id,
            'message_id' => $message->message_id
        ]);

        $this->assertEquals(true, $message);
    }

    public function test_sendLocation()
    {
        $chat_id = $_ENV['TELEGRAM_CHAT_ID'];

        $message = $this->telegram()->sendLocation([
            'chat_id' => $chat_id,
            'latitude' => '49.3956983',
            'longitude' => '11.0903916'
        ]);

        $this->assertInstanceOf(\Telegram\Types\Message::class, $message);
    }

    public function test_sendVenue()
    {
        $chat_id = $_ENV['TELEGRAM_CHAT_ID'];

        $message = $this->telegram()->sendVenue([
            'chat_id' => $chat_id,
            'latitude' => '49.3956983',
            'longitude' => '11.0903916',
            'title' => 'Venue',
            'address' => 'Some address'
        ]);

        $this->assertInstanceOf(\Telegram\Types\Message::class, $message);
    }

    public function test_sendContact()
    {
        $chat_id = $_ENV['TELEGRAM_CHAT_ID'];

        $message = $this->telegram()->sendContact([
            'chat_id' => $chat_id,
            'phone_number' => '1-212-736-5000',
            'first_name' => 'me'
        ]);

        $this->assertInstanceOf(\Telegram\Types\Message::class, $message);
    }

    public function test_sendChatAction()
    {
        $chat_id = $_ENV['TELEGRAM_CHAT_ID'];

        $message = $this->telegram()->sendChatAction([
            'chat_id' => $chat_id,
            'action' => ChatAction::TYPING
        ]);

        $this->assertEquals(true, $message);
    }

    public function test_getUserProfilePhotos()
    {
        $message = $this->telegram()->getUserProfilePhotos([
            'user_id' => $this->telegram()->getBotId()
        ]);

        $this->assertInstanceOf(\Telegram\Types\UserProfilePhotos::class, $message);
        $this->assertIsArray($message->photos);
        $this->assertIsArray($message->photos[0]);
        $this->assertInstanceOf(\Telegram\Types\PhotoSize::class, $message->photos[0][0]);
    }

    public function test_getWebhookInfo()
    {
        $message = $this->telegram()->getWebhookInfo();

        $this->assertInstanceOf(\Telegram\Types\WebhookInfo::class, $message);
    }

    // public function test_setChatTitle()
    // {
    //     $chat_id = $_ENV['TELEGRAM_CHAT_ID'];

    //     $message = $this->telegram()->setChatTitle([
    //         'chat_id' => $chat_id,
    //         'title' => 'title'
    //     ]);

    //     $this->assertEquals(true, $message);
    // }

    // public function test_sendMessageQuery()
    // {
    //     $chat_id = $_ENV['TELEGRAM_CHAT_ID'];

    //     $message = $this->telegram()
    //         ->sendMessageQuery()
    //         ->chat($chat_id)
    //         ->text('ciao')
    //         ->send();

    //     $this->assertInstanceOf(\Telegram\Types\Message::class, $message);
    // }
}
