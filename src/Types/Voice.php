<?php

namespace Telegram\Types;

/**
 * This object represents a voice note.
 *
 * @link https://core.telegram.org/bots/api#voice
 *
 * @property string $file_id Unique identifier for this file
 * @property int $duration Duration of the audio in seconds as defined by sender
 * @property string $mime_type Optional. MIME type of the file as defined by sender
 * @property int $file_size Optional. File size
 */
class Voice extends BaseType
{
    use Traits\Download;
}
