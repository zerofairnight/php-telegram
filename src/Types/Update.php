<?php

namespace Telegram\Types;

/**
 * This object represents an incoming update.At most one of the optional parameters can be present in any given update.
 *
 * @link https://core.telegram.org/bots/api#update
 *
 * @property int $update_id The update‘s unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
 * @property Message $message Optional. New incoming message of any kind — text, photo, sticker, etc.
 * @property Message $edited_message Optional. New version of a message that is known to the bot and was edited
 * @property Message $channel_post Optional. New incoming channel post of any kind — text, photo, sticker, etc.
 * @property Message $edited_channel_post Optional. New version of a channel post that is known to the bot and was edited
 * @property InlineQuery $inline_query Optional. New incoming inline query
 * @property ChosenInlineResult $chosen_inline_result Optional. The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
 * @property CallbackQuery $callback_query Optional. New incoming callback query
 * @property ShippingQuery $shipping_query Optional. New incoming shipping query. Only for invoices with flexible price
 * @property PreCheckoutQuery $pre_checkout_query Optional. New incoming pre-checkout query. Contains full information about checkout
 */
class Update extends BaseType
{
    protected $meta = [
        'message' => Message::class,
        'edited_message' => Message::class,
        'channel_post' => Message::class,
        'edited_channel_post' => Message::class,
        'inline_query' => InlineQuery::class,
        'chosen_inline_result' => ChosenInlineResult::class,
        'callback_query' => CallbackQuery::class,
        'shipping_query' => ShippingQuery::class,
        'pre_checkout_query' => PreCheckoutQuery::class,
    ];
}
