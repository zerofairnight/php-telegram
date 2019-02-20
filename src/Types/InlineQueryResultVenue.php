<?php

namespace Telegram\Types;

/**
 * Represents a venue. By default, the venue will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the venue.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultvenue
 *
 * @property string $type Type of the result, must be venue
 * @property string $id Unique identifier for this result, 1-64 Bytes
 * @property float $latitude Latitude of the venue location in degrees
 * @property float $longitude Longitude of the venue location in degrees
 * @property string $title Title of the venue
 * @property string $address Address of the venue
 * @property string $foursquare_id Optional. Foursquare identifier of the venue if known
 * @property string $foursquare_type Optional. Foursquare type of the venue, if known. (For example, "arts_entertainment/default”, "arts_entertainment/aquarium” or "food/icecream”.)
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message
 * @property InputMessageContent $input_message_content Optional. Content of the message to be sent instead of the venue
 * @property string $thumb_url Optional. Url of the thumbnail for the result
 * @property int $thumb_width Optional. Thumbnail width
 * @property int $thumb_height Optional. Thumbnail height
 */
class InlineQueryResultVenue extends BaseType
{
    protected $meta = [
        'reply_markup' => InlineKeyboardMarkup::class,
        'input_message_content' => InputMessageContent::class,
    ];
}
