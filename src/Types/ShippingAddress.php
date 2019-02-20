<?php

namespace Telegram\Types;

/**
 * This object represents a shipping address.
 *
 * @link https://core.telegram.org/bots/api#shippingaddress
 *
 * @property string $country_code ISO 3166-1 alpha-2 country code
 * @property string $state State, if applicable
 * @property string $city City
 * @property string $street_line1 First line for the address
 * @property string $street_line2 Second line for the address
 * @property string $post_code Address post code
 */
class ShippingAddress extends BaseType
{
    //
}
