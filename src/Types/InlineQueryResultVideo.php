<?php

namespace Telegram\Types;

/**
 * Represents a link to a page containing an embedded video player or a video file. By default, this video file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the video.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultvideo
 *
 * @property string $type Type of the result, must be video
 * @property string $id Unique identifier for this result, 1-64 bytes
 * @property string $video_url A valid URL for the embedded video player or video file
 * @property string $mime_type Mime type of the content of video url, "text/html” or "video/mp4”
 * @property string $thumb_url URL of the thumbnail (jpeg only) for the video
 * @property string $title Title for the result
 * @property string $caption Optional. Caption of the video to be sent, 0-1024 characters
 * @property string $parse_mode Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
 * @property int $video_width Optional. Video width
 * @property int $video_height Optional. Video height
 * @property int $video_duration Optional. Video duration in seconds
 * @property string $description Optional. Short description of the result
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message
 * @property InputMessageContent $input_message_content Optional. Content of the message to be sent instead of the video. This field is required if InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube video).
 */
class InlineQueryResultVideo extends BaseType
{
    protected $meta = [
        'reply_markup' => InlineKeyboardMarkup::class,
        'input_message_content' => InputMessageContent::class,
    ];
}
