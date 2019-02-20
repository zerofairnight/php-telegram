<?php

namespace Telegram\Types;

/**
 * This object represents a video file.
 *
 * @link https://core.telegram.org/bots/api#video
 *
 * @property string $file_id Unique identifier for this file
 * @property int $width Video width as defined by sender
 * @property int $height Video height as defined by sender
 * @property int $duration Duration of the video in seconds as defined by sender
 * @property PhotoSize $thumb Optional. Video thumbnail
 * @property string $mime_type Optional. Mime type of a file as defined by sender
 * @property int $file_size Optional. File size
 */
class Video extends BaseType
{
    use Traits\Download;

    protected $meta = [
        'thumb' => PhotoSize::class,
    ];
}
