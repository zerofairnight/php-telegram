<?php

namespace Telegram\Types;

/**
 * Represents a link to an animated GIF file stored on the Telegram servers. By default, this animated GIF file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with specified content instead of the animation.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedgif
 *
 * @property string $type Type of the result, must be gif
 * @property string $id Unique identifier for this result, 1-64 bytes
 * @property string $gif_file_id A valid file identifier for the GIF file
 * @property string $title Optional. Title for the result
 * @property string $caption Optional. Caption of the GIF file to be sent, 0-1024 characters
 * @property string $parse_mode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message
 * @property InputMessageContent $input_message_content Optional. Content of the message to be sent instead of the GIF animation
 */
class InlineQueryResultCachedGif extends BaseType
{
    protected $meta = [
        'reply_markup' => InlineKeyboardMarkup::class,
        'input_message_content' => InputMessageContent::class,
    ];
}
