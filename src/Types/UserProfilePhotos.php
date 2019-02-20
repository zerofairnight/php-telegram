<?php

namespace Telegram\Types;

/**
 * This object represent a user's profile pictures.
 *
 * @link https://core.telegram.org/bots/api#userprofilephotos
 *
 * @property int $total_count Total number of profile pictures the target user has
 * @property PhotoSize[][] $photos Requested profile pictures (in up to 4 sizes each)
 */
class UserProfilePhotos extends BaseType
{
    protected $meta = [
        'photos' => PhotoSize::class,
    ];
}
