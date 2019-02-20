<?php

namespace Telegram\Types;

/**
 * This object represents information about an order.
 *
 * @link https://core.telegram.org/bots/api#orderinfo
 *
 * @property string $name Optional. User name
 * @property string $phone_number Optional. User's phone number
 * @property string $email Optional. User email
 * @property ShippingAddress $shipping_address Optional. User shipping address
 */
class OrderInfo extends BaseType
{
    protected $meta = [
        'shipping_address' => ShippingAddress::class,
    ];
}
