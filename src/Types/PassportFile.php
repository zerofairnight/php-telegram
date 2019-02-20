<?php

namespace Telegram\Types;

/**
 * This object represents a file uploaded to Telegram Passport. Currently all Telegram Passport files are in JPEG format when decrypted and don't exceed 10MB.
 *
 * @link https://core.telegram.org/bots/api#passportfile
 *
 * @property string $file_id Unique identifier for this file
 * @property int $file_size File size
 * @property int $file_date Unix time when the file was uploaded
 */
class PassportFile extends BaseType
{
    use Traits\Download;
}
