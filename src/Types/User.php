<?php

namespace Telegram\Types;

/**
 * This object represents a Telegram user or bot.
 *
 * @link https://core.telegram.org/bots/api#user
 *
 * @property int $id Unique identifier for this user or bot
 * @property bool $is_bot True, if this user is a bot
 * @property string $first_name User‘s or bot’s first name
 * @property string $last_name Optional. User‘s or bot’s last name
 * @property string $username Optional. User‘s or bot’s username
 * @property string $language_code Optional. IETF language tag of the user's language
 */
class User extends BaseType
{
    //
}
