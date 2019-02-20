<?php

namespace Telegram\Types;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 *
 * @link https://core.telegram.org/bots/api#inlinekeyboardmarkup
 *
 * @property InlineKeyboardButton[][] $inline_keyboard Array of button rows, each represented by an Array of InlineKeyboardButton objects
 */
class InlineKeyboardMarkup extends BaseType
{
    protected $meta = [
        'inline_keyboard' => InlineKeyboardButton::class,
    ];
}
