<?php

namespace Telegram\Types;

/**
 * This object represents a video message (available in Telegram apps as of v.4.0).
 *
 * @link https://core.telegram.org/bots/api#videonote
 *
 * @property string $file_id Unique identifier for this file
 * @property int $length Video width and height (diameter of the video message) as defined by sender
 * @property int $duration Duration of the video in seconds as defined by sender
 * @property PhotoSize $thumb Optional. Video thumbnail
 * @property int $file_size Optional. File size
 */
class VideoNote extends BaseType
{
    use Traits\Download;

    protected $meta = [
        'thumb' => PhotoSize::class,
    ];
}
