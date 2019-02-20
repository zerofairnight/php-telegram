<?php

namespace Telegram\Types;

/**
 * This object represents a sticker.
 *
 * @link https://core.telegram.org/bots/api#sticker
 *
 * @property string $file_id Unique identifier for this file
 * @property int $width Sticker width
 * @property int $height Sticker height
 * @property PhotoSize $thumb Optional. Sticker thumbnail in the .webp or .jpg format
 * @property string $emoji Optional. Emoji associated with the sticker
 * @property string $set_name Optional. Name of the sticker set to which the sticker belongs
 * @property MaskPosition $mask_position Optional. For mask stickers, the position where the mask should be placed
 * @property int $file_size Optional. File size
 */
class Sticker extends BaseType
{
    use Traits\Download;

    protected $meta = [
        'thumb' => PhotoSize::class,
        'mask_position' => MaskPosition::class,
    ];
}
