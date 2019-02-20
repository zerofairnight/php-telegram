<?php

namespace Telegram\Types;

/**
 * This object represents a message.
 *
 * @link https://core.telegram.org/bots/api#message
 *
 * @property int $message_id Unique message identifier inside this chat
 * @property User $from Optional. Sender, empty for messages sent to channels
 * @property int $date Date the message was sent in Unix time
 * @property Chat $chat Conversation the message belongs to
 * @property User $forward_from Optional. For forwarded messages, sender of the original message
 * @property Chat $forward_from_chat Optional. For messages forwarded from channels, information about the original channel
 * @property int $forward_from_message_id Optional. For messages forwarded from channels, identifier of the original message in the channel
 * @property string $forward_signature Optional. For messages forwarded from channels, signature of the post author if present
 * @property int $forward_date Optional. For forwarded messages, date the original message was sent in Unix time
 * @property Message $reply_to_message Optional. For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
 * @property int $edit_date Optional. Date the message was last edited in Unix time
 * @property string $media_group_id Optional. The unique identifier of a media message group this message belongs to
 * @property string $author_signature Optional. Signature of the post author for messages in channels
 * @property string $text Optional. For text messages, the actual UTF-8 text of the message, 0-4096 characters.
 * @property MessageEntity[] $entities Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
 * @property MessageEntity[] $caption_entities Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
 * @property Audio $audio Optional. Message is an audio file, information about the file
 * @property Document $document Optional. Message is a general file, information about the file
 * @property Animation $animation Optional. Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set
 * @property Game $game Optional. Message is a game, information about the game. More about games »
 * @property PhotoSize[] $photo Optional. Message is a photo, available sizes of the photo
 * @property Sticker $sticker Optional. Message is a sticker, information about the sticker
 * @property Video $video Optional. Message is a video, information about the video
 * @property Voice $voice Optional. Message is a voice message, information about the file
 * @property VideoNote $video_note Optional. Message is a video note, information about the video message
 * @property string $caption Optional. Caption for the animation, audio, document, photo, video or voice, 0-1024 characters
 * @property Contact $contact Optional. Message is a shared contact, information about the contact
 * @property Location $location Optional. Message is a shared location, information about the location
 * @property Venue $venue Optional. Message is a venue, information about the venue
 * @property User[] $new_chat_members Optional. New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
 * @property User $left_chat_member Optional. A member was removed from the group, information about them (this member may be the bot itself)
 * @property string $new_chat_title Optional. A chat title was changed to this value
 * @property PhotoSize[] $new_chat_photo Optional. A chat photo was change to this value
 * @property True $delete_chat_photo Optional. Service message: the chat photo was deleted
 * @property True $group_chat_created Optional. Service message: the group has been created
 * @property True $supergroup_chat_created Optional. Service message: the supergroup has been created. This field can‘t be received in a message coming through updates, because bot can’t be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup.
 * @property True $channel_chat_created Optional. Service message: the channel has been created. This field can‘t be received in a message coming through updates, because bot can’t be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel.
 * @property int $migrate_to_chat_id Optional. The group has been migrated to a supergroup with the specified identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
 * @property int $migrate_from_chat_id Optional. The supergroup has been migrated from a group with the specified identifier. This number may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier.
 * @property Message $pinned_message Optional. Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it is itself a reply.
 * @property Invoice $invoice Optional. Message is an invoice for a payment, information about the invoice. More about payments »
 * @property SuccessfulPayment $successful_payment Optional. Message is a service message about a successful payment, information about the payment. More about payments »
 * @property string $connected_website Optional. The domain name of the website on which the user has logged in. More about Telegram Login »
 * @property PassportData $passport_data Optional. Telegram Passport data
 */
class Message extends BaseType
{
    protected $meta = [
        'from' => User::class,
        'chat' => Chat::class,
        'forward_from' => User::class,
        'forward_from_chat' => Chat::class,
        'reply_to_message' => Message::class,
        'entities' => MessageEntity::class,
        'caption_entities' => MessageEntity::class,
        'audio' => Audio::class,
        'document' => Document::class,
        'animation' => Animation::class,
        'game' => Game::class,
        'photo' => PhotoSize::class,
        'sticker' => Sticker::class,
        'video' => Video::class,
        'voice' => Voice::class,
        'video_note' => VideoNote::class,
        'contact' => Contact::class,
        'location' => Location::class,
        'venue' => Venue::class,
        'new_chat_members' => User::class,
        'left_chat_member' => User::class,
        'new_chat_photo' => PhotoSize::class,
        'delete_chat_photo' => True::class,
        'group_chat_created' => True::class,
        'supergroup_chat_created' => True::class,
        'channel_chat_created' => True::class,
        'pinned_message' => Message::class,
        'invoice' => Invoice::class,
        'successful_payment' => SuccessfulPayment::class,
        'passport_data' => PassportData::class,
    ];

    /**
     * Get the message entities of the given type.
     * Yon can also use one of the MessageEntity::TYPE_* constants as a parameter.
     *
     * @param string $type
     * @return \Telegram\Types\MessageEntity[]
     */
    public function entities($type)
    {
        // this method wants to return an empty array
        return array_filter($this->entities ?? [], function ($entity) use($type) {
            return $entity->type === $type;
        });
    }

    /**
     * Get the bot command entities.
     * Alias of $this->entities(MessageEntity::TYPE_BOT_COMMAND)
     *
     * @return \Telegram\Types\MessageEntity[]
     */
    public function commands()
    {
        return $this->entities(MessageEntity::TYPE_BOT_COMMAND);
    }

    // from: https://core.telegram.org/bots/api#updating-messages

    /**
     * Use this method to edit text and game messages sent by the bot or via the bot (for inline bots). On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @link https://core.telegram.org/bots/api#editmessagetext
     *
     * @param array $params
     * @var string $params ['inline_message_id'], Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var string $params ['text'], New text of the message
     * @var string $params ['parse_mode'], Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your bot's message.
     * @var bool $params ['disable_web_page_preview'], Disables link previews for links in this message
     * @var InlineKeyboardMarkup $params ['reply_markup'], A JSON-serialized object for an inline keyboard.
     * @return \Telegram\Types\Message
     */
    public function editMessageText(array $params)
    {
        $params['chat_id'] = $this->chat->id;
        $params['message_id'] = $this->message_id;

        return $this->telegram->editMessageText($params);
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:- A message can only be deleted if it was sent less than 48 hours ago.- Bots can delete outgoing messages in private chats, groups, and supergroups.- Bots granted can_post_messages permissions can delete outgoing messages in channels.- If the bot is an administrator of a group, it can delete any message there.- If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#deletemessage
     *
     * @return true
     */
    public function deleteMessage()
    {
        return $this->telegram->deleteMessage([
            'chat_id' => $this->chat->id,
            'message_id' => $this->message_id,
        ]);
    }
}
