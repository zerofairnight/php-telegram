<?php

namespace Telegram\Types;

/**
 * Represents a link to a photo stored on the Telegram servers. By default, this photo will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the photo.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedphoto
 *
 * @property string $type Type of the result, must be photo
 * @property string $id Unique identifier for this result, 1-64 bytes
 * @property string $photo_file_id A valid file identifier of the photo
 * @property string $title Optional. Title for the result
 * @property string $description Optional. Short description of the result
 * @property string $caption Optional. Caption of the photo to be sent, 0-1024 characters
 * @property string $parse_mode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message
 * @property InputMessageContent $input_message_content Optional. Content of the message to be sent instead of the photo
 */
class InlineQueryResultCachedPhoto extends BaseType
{
    protected $meta = [
        'reply_markup' => InlineKeyboardMarkup::class,
        'input_message_content' => InputMessageContent::class,
    ];
}
