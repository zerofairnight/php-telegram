<?php

namespace Telegram\Types;

/**
 * Represents a photo to be sent.
 *
 * @link https://core.telegram.org/bots/api#inputmediaphoto
 *
 * @property string $type Type of the result, must be photo
 * @property string $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name. More info on Sending Files »
 * @property string $caption Optional. Caption of the photo to be sent, 0-1024 characters
 * @property string $parse_mode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
 */
class InputMediaPhoto extends InputMedia
{
    //
}
