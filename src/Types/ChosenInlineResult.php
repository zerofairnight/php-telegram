<?php

namespace Telegram\Types;

/**
 * Represents a result of an inline query that was chosen by the user and sent to their chat partner.
 *
 * @link https://core.telegram.org/bots/api#choseninlineresult
 *
 * @property string $result_id The unique identifier for the result that was chosen
 * @property User $from The user that chose the result
 * @property Location $location Optional. Sender location, only for bots that require user location
 * @property string $inline_message_id Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message.
 * @property string $query The query that was used to obtain the result
 */
class ChosenInlineResult extends BaseType
{
    protected $meta = [
        'from' => User::class,
        'location' => Location::class,
    ];
}
