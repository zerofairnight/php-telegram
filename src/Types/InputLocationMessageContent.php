<?php

namespace Telegram\Types;

/**
 * Represents the content of a location message to be sent as the result of an inline query.
 *
 * @link https://core.telegram.org/bots/api#inputlocationmessagecontent
 *
 * @property float $latitude Latitude of the location in degrees
 * @property float $longitude Longitude of the location in degrees
 * @property int $live_period Optional. Period in seconds for which the location can be updated, should be between 60 and 86400.
 */
class InputLocationMessageContent extends BaseType
{

}
