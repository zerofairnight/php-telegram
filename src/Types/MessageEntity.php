<?php

namespace Telegram\Types;

/**
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * @link https://core.telegram.org/bots/api#messageentity
 *
 * @property string $type Type of the entity. Can be mention (@username), hashtag, cashtag, bot_command, url, email, phone_number, bold (bold text), italic (italic text), code (monowidth string), pre (monowidth block), text_link (for clickable text URLs), text_mention (for users without usernames)
 * @property int $offset Offset in UTF-16 code units to the start of the entity
 * @property int $length Length of the entity in UTF-16 code units
 * @property string $url Optional. For "text_link” only, url that will be opened after user taps on the text
 * @property User $user Optional. For "text_mention” only, the mentioned user
 */
class MessageEntity extends BaseType
{
    const TYPE_MENTION = 'mention'; // (@username)
    const TYPE_HASHTAG = 'hashtag';
    const TYPE_CASHTAG = 'cashtag';
    const TYPE_BOT_COMMAND = 'bot_command';
    const TYPE_URL = 'url';
    const TYPE_EMAIL = 'email';
    const TYPE_PHONE_NUMBER = 'phone_number';
    const TYPE_BOLD = 'bold'; // (bold text)
    const TYPE_ITALIC = 'italic'; // (italic text)
    const TYPE_CODE = 'code'; // (monowidth string)
    const TYPE_PRE = 'pre'; // (monowidth block)
    const TYPE_TEXT_LINK = 'text_link'; // (for clickable text URLs)
    const TYPE_TEXT_MENTION = 'text_mention'; // (for users without usernames)

    protected $meta = [
        'user' => User::class,
    ];
}
