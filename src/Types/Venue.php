<?php

namespace Telegram\Types;

/**
 * This object represents a venue.
 *
 * @link https://core.telegram.org/bots/api#venue
 *
 * @property Location $location Venue location
 * @property string $title Name of the venue
 * @property string $address Address of the venue
 * @property string $foursquare_id Optional. Foursquare identifier of the venue
 * @property string $foursquare_type Optional. Foursquare type of the venue. (For example, "arts_entertainment/default”, "arts_entertainment/aquarium” or "food/icecream”.)
 */
class Venue extends BaseType
{
    protected $meta = [
        'location' => Location::class,
    ];
}
