<?php

namespace Telegram\Types;

/**
 * Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultgif
 *
 * @property string $type Type of the result, must be gif
 * @property string $id Unique identifier for this result, 1-64 bytes
 * @property string $gif_url A valid URL for the GIF file. File size must not exceed 1MB
 * @property int $gif_width Optional. Width of the GIF
 * @property int $gif_height Optional. Height of the GIF
 * @property int $gif_duration Optional. Duration of the GIF
 * @property string $thumb_url URL of the static thumbnail for the result (jpeg or gif)
 * @property string $title Optional. Title for the result
 * @property string $caption Optional. Caption of the GIF file to be sent, 0-1024 characters
 * @property string $parse_mode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message
 * @property InputMessageContent $input_message_content Optional. Content of the message to be sent instead of the GIF animation
 */
class InlineQueryResultGif extends BaseType
{
    protected $meta = [
        'reply_markup' => InlineKeyboardMarkup::class,
        'input_message_content' => InputMessageContent::class,
    ];
}
