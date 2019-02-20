<?php

namespace Telegram\Types;

/**
 * Represents the content of a contact message to be sent as the result of an inline query.
 *
 * @link https://core.telegram.org/bots/api#inputcontactmessagecontent
 *
 * @property string $phone_number Contact's phone number
 * @property string $first_name Contact's first name
 * @property string $last_name Optional. Contact's last name
 * @property string $vcard Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
 */
class InputContactMessageContent extends BaseType
{
    //
}
