<?php

namespace Telegram\Types;

/**
 * Contains information about Telegram Passport data shared with the bot by the user.
 *
 * @link https://core.telegram.org/bots/api#passportdata
 *
 * @property EncryptedPassportElement[] $data Array with information about documents and other Telegram Passport elements that was shared with the bot
 * @property EncryptedCredentials $credentials Encrypted credentials required to decrypt the data
 */
class PassportData extends BaseType
{
    protected $meta = [
        'data' => EncryptedPassportElement::class,
        'credentials' => EncryptedCredentials::class,
    ];
}
