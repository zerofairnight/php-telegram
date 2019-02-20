<?php

namespace Telegram\Types;

/**
 * Represents an issue with a document scan. The error is considered resolved when the file with the document scan changes.
 *
 * @link https://core.telegram.org/bots/api#passportelementerrorfile
 *
 * @property string $source Error source, must be file
 * @property string $type The section of the user's Telegram Passport which has the issue, one of "utility_bill”, "bank_statement”, "rental_agreement”, "passport_registration”, "temporary_registration”
 * @property string $file_hash Base64-encoded file hash
 * @property string $message Error message
 */
class PassportElementErrorFile extends BaseType
{
    //
}
