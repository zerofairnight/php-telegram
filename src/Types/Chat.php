<?php

namespace Telegram\Types;

/**
 * This object represents a chat.
 *
 * @link https://core.telegram.org/bots/api#chat
 *
 * @property int $id Unique identifier for this chat. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
 * @property string $type Type of chat, can be either "private”, "group”, "supergroup” or "channel”
 * @property string $title Optional. Title, for supergroups, channels and group chats
 * @property string $username Optional. Username, for private chats, supergroups and channels if available
 * @property string $first_name Optional. First name of the other party in a private chat
 * @property string $last_name Optional. Last name of the other party in a private chat
 * @property bool $all_members_are_administrators Optional. True if a group has ‘All Members Are Admins’ enabled.
 * @property ChatPhoto $photo Optional. Chat photo. Returned only in getChat.
 * @property string $description Optional. Description, for supergroups and channel chats. Returned only in getChat.
 * @property string $invite_link Optional. Chat invite link, for supergroups and channel chats. Each administrator in a chat generates their own invite links, so the bot must first generate the link using exportChatInviteLink. Returned only in getChat.
 * @property Message $pinned_message Optional. Pinned message, for supergroups and channel chats. Returned only in getChat.
 * @property string $sticker_set_name Optional. For supergroups, name of group sticker set. Returned only in getChat.
 * @property bool $can_set_sticker_set Optional. True, if the bot can change the group sticker set. Returned only in getChat.
 */
class Chat extends BaseType
{
    protected $meta = [
        'photo' => ChatPhoto::class,
        'pinned_message' => Message::class,
    ];
}
