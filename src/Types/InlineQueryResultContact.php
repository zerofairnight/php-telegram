<?php

namespace Telegram\Types;

/**
 * Represents a contact with a phone number. By default, this contact will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the contact.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultcontact
 *
 * @property string $type Type of the result, must be contact
 * @property string $id Unique identifier for this result, 1-64 Bytes
 * @property string $phone_number Contact's phone number
 * @property string $first_name Contact's first name
 * @property string $last_name Optional. Contact's last name
 * @property string $vcard Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
 * @property InlineKeyboardMarkup $reply_markup Optional. Inline keyboard attached to the message
 * @property InputMessageContent $input_message_content Optional. Content of the message to be sent instead of the contact
 * @property string $thumb_url Optional. Url of the thumbnail for the result
 * @property int $thumb_width Optional. Thumbnail width
 * @property int $thumb_height Optional. Thumbnail height
 */
class InlineQueryResultContact extends BaseType
{
    protected $meta = [
        'reply_markup' => InlineKeyboardMarkup::class,
        'input_message_content' => InputMessageContent::class,
    ];
}
