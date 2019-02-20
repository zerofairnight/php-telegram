<?php

namespace Telegram\Types;

/**
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the photo.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultphoto
 *
 * @property string $type Type of the result, must be photo
 * @property string $id Unique identifier for this result, 1-64 bytes
 * @property string $photo_url A valid URL of the photo. Photo must be in jpeg format. Photo size must not exceed 5MB
 * @property string $thumb_url URL of the thumbnail for the photo
 * @property int $photo_width Optional. Width of the photo
 * @property int $photo_height Optional. Height of the photo
 * @property string $title Optional. Title for the result
 * @property string $description Optional. Short description of the result
 * @property string $caption Optional. Caption of the photo to be sent, 0-1024 characters
 * @property string $parse_mode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message
 * @property InputMessageContent $input_message_content Optional. Content of the message to be sent instead of the photo
 */
class InlineQueryResultPhoto extends BaseType
{
    protected $meta = [
        'reply_markup' => InlineKeyboardMarkup::class,
        'input_message_content' => InputMessageContent::class,
    ];
}
