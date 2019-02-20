<?php

namespace Telegram\Types;

/**
 * This object contains information about an incoming pre-checkout query.
 *
 * @link https://core.telegram.org/bots/api#precheckoutquery
 *
 * @property string $id Unique query identifier
 * @property User $from User who sent the query
 * @property string $currency Three-letter ISO 4217 currency code
 * @property int $total_amount Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
 * @property string $invoice_payload Bot specified invoice payload
 * @property string $shipping_option_id Optional. Identifier of the shipping option chosen by the user
 * @property OrderInfo $order_info Optional. Order info provided by the user
 */
class PreCheckoutQuery extends BaseType
{
    protected $meta = [
        'from' => User::class,
        'order_info' => OrderInfo::class,
    ];
}
