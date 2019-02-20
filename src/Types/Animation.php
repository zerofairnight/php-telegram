<?php

namespace Telegram\Types;

/**
 * This object represents an animation file (GIF or H.264/MPEG-4 AVC video without sound).
 *
 * @link https://core.telegram.org/bots/api#animation
 *
 * @property string $file_id Unique file identifier
 * @property int $width Video width as defined by sender
 * @property int $height Video height as defined by sender
 * @property int $duration Duration of the video in seconds as defined by sender
 * @property PhotoSize $thumb Optional. Animation thumbnail as defined by sender
 * @property string $file_name Optional. Original animation filename as defined by sender
 * @property string $mime_type Optional. MIME type of the file as defined by sender
 * @property int $file_size Optional. File size
 */
class Animation extends BaseType
{
    use Traits\Download;

    protected $meta = [
        'thumb' => PhotoSize::class,
    ];
}
