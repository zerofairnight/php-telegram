<?php

namespace Telegram\Types;

/**
 * This object represents a sticker set.
 *
 * @link https://core.telegram.org/bots/api#stickerset
 *
 * @property string $name Sticker set name
 * @property string $title Sticker set title
 * @property bool $contains_masks True, if the sticker set contains masks
 * @property Sticker[] $stickers List of all set stickers
 */
class StickerSet extends BaseType
{
    protected $meta = [
        'stickers' => Sticker::class,
    ];
}
