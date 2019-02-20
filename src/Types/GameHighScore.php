<?php

namespace Telegram\Types;

/**
 * This object represents one row of the high scores table for a game.
 *
 * @link https://core.telegram.org/bots/api#gamehighscore
 *
 * @property int $position Position in high score table for the game
 * @property User $user User
 * @property int $score Score
 */
class GameHighScore extends BaseType
{
    protected $meta = [
        'user' => User::class,
    ];
}
