<?php

namespace Telegram\Types;

/**
 * Represents a link to an mp3 audio file. By default, this audio file will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the audio.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultaudio
 *
 * @property string $type Type of the result, must be audio
 * @property string $id Unique identifier for this result, 1-64 bytes
 * @property string $audio_url A valid URL for the audio file
 * @property string $title Title
 * @property string $caption Optional. Caption, 0-1024 characters
 * @property string $parse_mode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
 * @property string $performer Optional. Performer
 * @property int $audio_duration Optional. Audio duration in seconds
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message
 * @property InputMessageContent $input_message_content Optional. Content of the message to be sent instead of the audio
 */
class InlineQueryResultAudio extends BaseType
{
    protected $meta = [
        'reply_markup' => InlineKeyboardMarkup::class,
        'input_message_content' => InputMessageContent::class,
    ];
}
