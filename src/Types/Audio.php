<?php

namespace Telegram\Types;

/**
 * This object represents an audio file to be treated as music by the Telegram clients.
 *
 * @link https://core.telegram.org/bots/api#audio
 *
 * @property string $file_id Unique identifier for this file
 * @property int $duration Duration of the audio in seconds as defined by sender
 * @property string $performer Optional. Performer of the audio as defined by sender or by audio tags
 * @property string $title Optional. Title of the audio as defined by sender or by audio tags
 * @property string $mime_type Optional. MIME type of the file as defined by sender
 * @property int $file_size Optional. File size
 * @property PhotoSize $thumb Optional. Thumbnail of the album cover to which the music file belongs
 */
class Audio extends BaseType
{
    use Traits\Download;

    protected $meta = [
        'thumb' => PhotoSize::class,
    ];
}
