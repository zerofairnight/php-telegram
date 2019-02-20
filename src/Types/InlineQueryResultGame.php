<?php

namespace Telegram\Types;

/**
 * Represents a Game.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultgame
 *
 * @property string $type Type of the result, must be game
 * @property string $id Unique identifier for this result, 1-64 bytes
 * @property string $game_short_name Short name of the game
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message
 */
class InlineQueryResultGame extends BaseType
{
    protected $meta = [
        'reply_markup' => InlineKeyboardMarkup::class,
    ];
}
