<?php

namespace Telegram\Types;

/**
 * Represents a location on a map. By default, the location will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the location.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultlocation
 *
 * @property string $type Type of the result, must be location
 * @property string $id Unique identifier for this result, 1-64 Bytes
 * @property float $latitude Location latitude in degrees
 * @property float $longitude Location longitude in degrees
 * @property string $title Location title
 * @property int $live_period Optional. Period in seconds for which the location can be updated, should be between 60 and 86400.
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message
 * @property InputMessageContent $input_message_content Optional. Content of the message to be sent instead of the location
 * @property string $thumb_url Optional. Url of the thumbnail for the result
 * @property int $thumb_width Optional. Thumbnail width
 * @property int $thumb_height Optional. Thumbnail height
 */
class InlineQueryResultLocation extends BaseType
{
    protected $meta = [
        'reply_markup' => InlineKeyboardMarkup::class,
        'input_message_content' => InputMessageContent::class,
    ];
}
