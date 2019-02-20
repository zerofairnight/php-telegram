<?php

namespace Telegram\Types;

/**
 * This object represents one size of a photo or a file / sticker thumbnail.
 *
 * @link https://core.telegram.org/bots/api#photosize
 *
 * @property string $file_id Unique identifier for this file
 * @property int $width Photo width
 * @property int $height Photo height
 * @property int $file_size Optional. File size
 */
class PhotoSize extends BaseType
{
    use Traits\Download;
}
