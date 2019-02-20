<?php

namespace Telegram\Types;

/**
 * Represents an issue with one of the files that constitute the translation of a document. The error is considered resolved when the file changes.
 *
 * @link https://core.telegram.org/bots/api#passportelementerrortranslationfile
 *
 * @property string $source Error source, must be translation_file
 * @property string $type Type of element of the user's Telegram Passport which has the issue, one of "passport”, "driver_license”, "identity_card”, "internal_passport”, "utility_bill”, "bank_statement”, "rental_agreement”, "passport_registration”, "temporary_registration”
 * @property string $file_hash Base64-encoded file hash
 * @property string $message Error message
 */
class PassportElementErrorTranslationFile extends BaseType
{
    //
}