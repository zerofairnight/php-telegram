<?php

namespace Telegram\Types;

/**
 * This object represents one shipping option.
 *
 * @link https://core.telegram.org/bots/api#shippingoption
 *
 * @property string $id Shipping option identifier
 * @property string $title Option title
 * @property LabeledPrice[] $prices List of price portions
 */
class ShippingOption extends BaseType
{
    protected $meta = [
        'prices' => LabeledPrice::class,
    ];
}
