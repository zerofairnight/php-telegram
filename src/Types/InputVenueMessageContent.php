<?php

namespace Telegram\Types;

/**
 * Represents the content of a venue message to be sent as the result of an inline query.
 *
 * @link https://core.telegram.org/bots/api#inputvenuemessagecontent
 *
 * @property float $latitude Latitude of the venue in degrees
 * @property float $longitude Longitude of the venue in degrees
 * @property string $title Name of the venue
 * @property string $address Address of the venue
 * @property string $foursquare_id Optional. Foursquare identifier of the venue, if known
 * @property string $foursquare_type Optional. Foursquare type of the venue, if known. (For example, "arts_entertainment/default”, "arts_entertainment/aquarium” or "food/icecream”.)
 */
class InputVenueMessageContent extends BaseType
{

}
