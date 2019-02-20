<?php

namespace Telegram\Types;

/**
 * This object represents a file ready to be downloaded. The file can be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile.
 *
 * @link https://core.telegram.org/bots/api#file
 *
 * @property string $file_id Unique identifier for this file
 * @property int $file_size Optional. File size, if known
 * @property string $file_path Optional. File path. Use https://api.telegram.org/file/bot<token>/<file_path> to get the file.
 */
class File extends BaseType
{
    use Traits\Download;
}
