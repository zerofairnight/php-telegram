<?php

namespace Telegram\Types;

/**
 * Represents a link to an article or web page.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultarticle
 *
 * @property string $type Type of the result, must be article
 * @property string $id Unique identifier for this result, 1-64 Bytes
 * @property string $title Title of the result
 * @property InputMessageContent $input_message_content Content of the message to be sent
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message
 * @property string $url Optional. URL of the result
 * @property bool $hide_url Optional. Pass True, if you don't want the URL to be shown in the message
 * @property string $description Optional. Short description of the result
 * @property string $thumb_url Optional. Url of the thumbnail for the result
 * @property int $thumb_width Optional. Thumbnail width
 * @property int $thumb_height Optional. Thumbnail height
 */
class InlineQueryResultArticle extends BaseType
{
    protected $meta = [
        'input_message_content' => InputMessageContent::class,
        'reply_markup' => InlineKeyboardMarkup::class,
    ];
}
