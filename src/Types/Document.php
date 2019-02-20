<?php

namespace Telegram\Types;

/**
 * This object represents a general file (as opposed to photos, voice messages and audio files).
 *
 * @link https://core.telegram.org/bots/api#document
 *
 * @property string $file_id Unique file identifier
 * @property PhotoSize $thumb Optional. Document thumbnail as defined by sender
 * @property string $file_name Optional. Original filename as defined by sender
 * @property string $mime_type Optional. MIME type of the file as defined by sender
 * @property int $file_size Optional. File size
 */
class Document extends BaseType
{
    use Traits\Download;

    protected $meta = [
        'thumb' => PhotoSize::class,
    ];
}
