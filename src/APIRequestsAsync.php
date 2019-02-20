<?php

namespace Telegram;

use Telegram\Types\User;
use Telegram\Types\Message;
use Telegram\Types\Update;
use Telegram\Types\WebhookInfo;
use Telegram\Types\UserProfilePhotos;
use Telegram\Types\File;
use Telegram\Types\Chat;
use Telegram\Types\ChatMember;
use Telegram\Types\StickerSet;
use Telegram\Types\GameHighScore;

trait APIRequestsAsync
{
    /**
     * Use this method to receive incoming updates using long polling (wiki). An Array of Update objects is returned.
     *
     * @link https://core.telegram.org/bots/api#getupdates
     *
     * @param array $params
     * @var int $params ['offset'], Identifier of the first update to be returned. Must be greater by one than the highest among the identifiers of previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id. The negative offset can be specified to retrieve updates starting from -offset update from the end of the updates queue. All previous updates will forgotten.
     * @var int $params ['limit'], Limits the number of updates to be retrieved. Values between 1—100 are accepted. Defaults to 100.
     * @var int $params ['timeout'], Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling. Should be positive, short polling should be used for testing purposes only.
     * @var string $params ['allowed_updates'], List the types of updates you want your bot to receive. For example, specify ["message”, "edited_channel_post”, "callback_query”] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all updates regardless of type (default). If not specified, the previous setting will be used.Please note that this parameter doesn't affect updates created before the call to the getUpdates, so unwanted updates may be received for a short period of time.
     * @return \Telegram\Types\Update[]
     */
    public function getUpdatesAsync(array $params = [])
    {
        return $this->queryAsync(Update::class, $params);
    }

    /**
     * Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#setwebhook
     *
     * @param array $params
     * @var string $params ['url'], HTTPS url to send updates to. Use an empty string to remove webhook integration
     * @var InputFile $params ['certificate'], Upload your public key certificate so that the root certificate in use can be checked. See our self-signed guide for details.
     * @var int $params ['max_connections'], Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the load on your bot‘s server, and higher values to increase your bot’s throughput.
     * @var string $params ['allowed_updates'], List the types of updates you want your bot to receive. For example, specify ["message”, "edited_channel_post”, "callback_query”] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all updates regardless of type (default). If not specified, the previous setting will be used.Please note that this parameter doesn't affect updates created before the call to the setWebhook, so unwanted updates may be received for a short period of time.
     * @return true
     */
    public function setWebhookAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates. Returns True on success. Requires no parameters.
     *
     * @link https://core.telegram.org/bots/api#deletewebhook
     * @return true
     */
    public function deleteWebhookAsync()
    {
        return $this->queryAsync(true);
    }

    /**
     * Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object. If the bot is using getUpdates, will return an object with the url field empty.
     *
     * @link https://core.telegram.org/bots/api#getwebhookinfo
     * @return \Telegram\Types\WebhookInfo
     */
    public function getWebhookInfoAsync()
    {
        return $this->queryAsync(WebhookInfo::class);
    }

    /**
     * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in form of a User object.
     *
     * @link https://core.telegram.org/bots/api#getme
     * @return \Telegram\Types\User
     */
    public function getMeAsync()
    {
        return $this->queryAsync(User::class);
    }

    /**
     * Use this method to send text messages. On success, the sent Message is returned.
     *
     * @link https://core.telegram.org/bots/api#sendmessage
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string $params ['text'], Text of the message to be sent
     * @var string $params ['parse_mode'], Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your bot's message.
     * @var bool $params ['disable_web_page_preview'], Disables link previews for links in this message
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendMessageAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to forward messages of any kind. On success, the sent Message is returned.
     *
     * @link https://core.telegram.org/bots/api#forwardmessage
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var int|string $params ['from_chat_id'], Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['message_id'], Message identifier in the chat specified in from_chat_id
     * @return \Telegram\Types\Message
     */
    public function forwardMessageAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to send photos. On success, the sent Message is returned.
     *
     * @link https://core.telegram.org/bots/api#sendphoto
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var InputFile|string $params ['photo'], Photo to send. Pass a file_id as String to send a photo that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a photo from the Internet, or upload a new photo using multipart/form-data. More info on Sending Files »
     * @var string $params ['caption'], Photo caption (may also be used when resending photos by file_id), 0-1024 characters
     * @var string $params ['parse_mode'], Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendPhotoAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .mp3 format. On success, the sent Message is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendaudio
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var InputFile|string $params ['audio'], Audio file to send. Pass a file_id as String to send an audio file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an audio file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
     * @var string $params ['caption'], Audio caption, 0-1024 characters
     * @var string $params ['parse_mode'], Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @var int $params ['duration'], Duration of the audio in seconds
     * @var string $params ['performer'], Performer
     * @var string $params ['title'], Track name
     * @var InputFile|string $params ['thumb'], Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More info on Sending Files »
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendAudioAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to send general files. On success, the sent Message is returned. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#senddocument
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var InputFile|string $params ['document'], File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
     * @var InputFile|string $params ['thumb'], Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More info on Sending Files »
     * @var string $params ['caption'], Document caption (may also be used when resending documents by file_id), 0-1024 characters
     * @var string $params ['parse_mode'], Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendDocumentAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document). On success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendvideo
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var InputFile|string $params ['video'], Video to send. Pass a file_id as String to send a video that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a video from the Internet, or upload a new video using multipart/form-data. More info on Sending Files »
     * @var int $params ['duration'], Duration of sent video in seconds
     * @var int $params ['width'], Video width
     * @var int $params ['height'], Video height
     * @var InputFile|string $params ['thumb'], Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More info on Sending Files »
     * @var string $params ['caption'], Video caption (may also be used when resending videos by file_id), 0-1024 characters
     * @var string $params ['parse_mode'], Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @var bool $params ['supports_streaming'], Pass True, if the uploaded video is suitable for streaming
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendVideoAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent Message is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendanimation
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var InputFile|string $params ['animation'], Animation to send. Pass a file_id as String to send an animation that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get an animation from the Internet, or upload a new animation using multipart/form-data. More info on Sending Files »
     * @var int $params ['duration'], Duration of sent animation in seconds
     * @var int $params ['width'], Animation width
     * @var int $params ['height'], Animation height
     * @var InputFile|string $params ['thumb'], Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More info on Sending Files »
     * @var string $params ['caption'], Animation caption (may also be used when resending animation by file_id), 0-1024 characters
     * @var string $params ['parse_mode'], Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendAnimationAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .ogg file encoded with OPUS (other formats may be sent as Audio or Document). On success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     *
     * @link https://core.telegram.org/bots/api#sendvoice
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var InputFile|string $params ['voice'], Audio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
     * @var string $params ['caption'], Voice message caption, 0-1024 characters
     * @var string $params ['parse_mode'], Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @var int $params ['duration'], Duration of the voice message in seconds
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendVoiceAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long. Use this method to send video messages. On success, the sent Message is returned.
     *
     * @link https://core.telegram.org/bots/api#sendvideonote
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var InputFile|string $params ['video_note'], Video note to send. Pass a file_id as String to send a video note that exists on the Telegram servers (recommended) or upload a new video using multipart/form-data. More info on Sending Files ». Sending video notes by a URL is currently unsupported
     * @var int $params ['duration'], Duration of sent video in seconds
     * @var int $params ['length'], Video width and height, i.e. diameter of the video message
     * @var InputFile|string $params ['thumb'], Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not exceed 90. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be only uploaded as a new file, so you can pass "attach://<file_attach_name>” if the thumbnail was uploaded using multipart/form-data under <file_attach_name>. More info on Sending Files »
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendVideoNoteAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to send a group of photos or videos as an album. On success, an array of the sent Messages is returned.
     *
     * @link https://core.telegram.org/bots/api#sendmediagroup
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var InputMediaPhoto and InputMediaVideo $params ['media'], A JSON-serialized array describing photos and videos to be sent, must include 2–10 items
     * @var bool $params ['disable_notification'], Sends the messages silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the messages are a reply, ID of the original message
     * @return \Telegram\Types\Message[]
     */
    public function sendMediaGroupAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to send point on the map. On success, the sent Message is returned.
     *
     * @link https://core.telegram.org/bots/api#sendlocation
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var float $params ['latitude'], Latitude of the location
     * @var float $params ['longitude'], Longitude of the location
     * @var int $params ['live_period'], Period in seconds for which the location will be updated (see Live Locations, should be between 60 and 86400.
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendLocationAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to edit live location messages sent by the bot or via the bot (for inline bots). A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @link https://core.telegram.org/bots/api#editmessagelivelocation
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var int $params ['message_id'], Required if inline_message_id is not specified. Identifier of the sent message
     * @var string $params ['inline_message_id'], Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var float $params ['latitude'], Latitude of new location
     * @var float $params ['longitude'], Longitude of new location
     * @var InlineKeyboardMarkup $params ['reply_markup'], A JSON-serialized object for a new inline keyboard.
     * @return \Telegram\Types\Message
     */
    public function editMessageLiveLocationAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to stop updating a live location message sent by the bot or via the bot (for inline bots) before live_period expires. On success, if the message was sent by the bot, the sent Message is returned, otherwise True is returned.
     *
     * @link https://core.telegram.org/bots/api#stopmessagelivelocation
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var int $params ['message_id'], Required if inline_message_id is not specified. Identifier of the sent message
     * @var string $params ['inline_message_id'], Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var InlineKeyboardMarkup $params ['reply_markup'], A JSON-serialized object for a new inline keyboard.
     * @return \Telegram\Types\Message
     */
    public function stopMessageLiveLocationAsync(array $params = [])
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to send information about a venue. On success, the sent Message is returned.
     *
     * @link https://core.telegram.org/bots/api#sendvenue
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var float $params ['latitude'], Latitude of the venue
     * @var float $params ['longitude'], Longitude of the venue
     * @var string $params ['title'], Name of the venue
     * @var string $params ['address'], Address of the venue
     * @var string $params ['foursquare_id'], Foursquare identifier of the venue
     * @var string $params ['foursquare_type'], Foursquare type of the venue, if known. (For example, "arts_entertainment/default”, "arts_entertainment/aquarium” or "food/icecream”.)
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendVenueAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to send phone contacts. On success, the sent Message is returned.
     *
     * @link https://core.telegram.org/bots/api#sendcontact
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string $params ['phone_number'], Contact's phone number
     * @var string $params ['first_name'], Contact's first name
     * @var string $params ['last_name'], Contact's last name
     * @var string $params ['vcard'], Additional data about the contact in the form of a vCard, 0-2048 bytes
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendContactAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#sendchataction
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string $params ['action'], Type of action to broadcast. Choose one, depending on what the user is about to receive: typing for text messages, upload_photo for photos, record_video or upload_video for videos, record_audio or upload_audio for audio files, upload_document for general files, find_location for location data, record_video_note or upload_video_note for video notes.
     * @return true
     */
    public function sendChatActionAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
     *
     * @link https://core.telegram.org/bots/api#getuserprofilephotos
     *
     * @param array $params
     * @var int $params ['user_id'], Unique identifier of the target user
     * @var int $params ['offset'], Sequential number of the first photo to be returned. By default, all photos are returned.
     * @var int $params ['limit'], Limits the number of photos to be retrieved. Values between 1—100 are accepted. Defaults to 100.
     * @return \Telegram\Types\UserProfilePhotos
     */
    public function getUserProfilePhotosAsync(array $params)
    {
        return $this->queryAsync(UserProfilePhotos::class, $params);
    }

    /**
     * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
     *
     * @link https://core.telegram.org/bots/api#getfile
     *
     * @param array $params
     * @var string $params ['file_id'], File identifier to get info about
     * @return \Telegram\Types\File
     */
    public function getFileAsync(array $params)
    {
        return $this->queryAsync(File::class, $params);
    }

    /**
     * Use this method to kick a user from a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the group on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#kickchatmember
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target group or username of the target supergroup or channel (in the format @channelusername)
     * @var int $params ['user_id'], Unique identifier of the target user
     * @var int $params ['until_date'], Date when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds from the current time they are considered to be banned forever
     * @return true
     */
    public function kickChatMemberAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to unban a previously kicked user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#unbanchatmember
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target group or username of the target supergroup or channel (in the format @username)
     * @var int $params ['user_id'], Unique identifier of the target user
     * @return true
     */
    public function unbanChatMemberAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate admin rights. Pass True for all boolean parameters to lift restrictions from a user. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#restrictchatmember
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @var int $params ['user_id'], Unique identifier of the target user
     * @var int $params ['until_date'], Date when restrictions will be lifted for the user, unix time. If user is restricted for more than 366 days or less than 30 seconds from the current time, they are considered to be restricted forever
     * @var bool $params ['can_send_messages'], Pass True, if the user can send text messages, contacts, locations and venues
     * @var bool $params ['can_send_media_messages'], Pass True, if the user can send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages
     * @var bool $params ['can_send_other_messages'], Pass True, if the user can send animations, games, stickers and use inline bots, implies can_send_media_messages
     * @var bool $params ['can_add_web_page_previews'], Pass True, if the user may add web page previews to their messages, implies can_send_media_messages
     * @return true
     */
    public function restrictChatMemberAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Pass False for all boolean parameters to demote a user. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#promotechatmember
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var int $params ['user_id'], Unique identifier of the target user
     * @var bool $params ['can_change_info'], Pass True, if the administrator can change chat title, photo and other settings
     * @var bool $params ['can_post_messages'], Pass True, if the administrator can create channel posts, channels only
     * @var bool $params ['can_edit_messages'], Pass True, if the administrator can edit messages of other users and can pin messages, channels only
     * @var bool $params ['can_delete_messages'], Pass True, if the administrator can delete messages of other users
     * @var bool $params ['can_invite_users'], Pass True, if the administrator can invite new users to the chat
     * @var bool $params ['can_restrict_members'], Pass True, if the administrator can restrict, ban or unban chat members
     * @var bool $params ['can_pin_messages'], Pass True, if the administrator can pin messages, supergroups only
     * @var bool $params ['can_promote_members'], Pass True, if the administrator can add new administrators with a subset of his own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by him)
     * @return true
     */
    public function promoteChatMemberAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to generate a new invite link for a chat; any previously generated link is revoked. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns the new invite link as String on success.
     *
     * @link https://core.telegram.org/bots/api#exportchatinvitelink
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return string
     */
    public function exportChatInviteLinkAsync(array $params)
    {
        return $this->queryAsync(null, $params);
    }

    /**
     * Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#setchatphoto
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var InputFile $params ['photo'], New chat photo, uploaded using multipart/form-data
     * @return true
     */
    public function setChatPhotoAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#deletechatphoto
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return true
     */
    public function deleteChatPhotoAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#setchattitle
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string $params ['title'], New chat title, 1-255 characters
     * @return true
     */
    public function setChatTitleAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to change the description of a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#setchatdescription
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var string $params ['description'], New chat description, 0-255 characters
     * @return true
     */
    public function setChatDescriptionAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to pin a message in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in the supergroup or ‘can_edit_messages’ admin right in the channel. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#pinchatmessage
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var int $params ['message_id'], Identifier of a message to pin
     * @var bool $params ['disable_notification'], Pass True, if it is not necessary to send a notification to all chat members about the new pinned message. Notifications are always disabled in channels.
     * @return true
     */
    public function pinChatMessageAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to unpin a message in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in the supergroup or ‘can_edit_messages’ admin right in the channel. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#unpinchatmessage
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @return true
     */
    public function unpinChatMessageAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#leavechat
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @return true
     */
    public function leaveChatAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.). Returns a Chat object on success.
     *
     * @link https://core.telegram.org/bots/api#getchat
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @return \Telegram\Types\Chat
     */
    public function getChatAsync(array $params)
    {
        return $this->queryAsync(Chat::class, $params);
    }

    /**
     * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots. If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
     *
     * @link https://core.telegram.org/bots/api#getchatadministrators
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @return \Telegram\Types\ChatMember[]
     */
    public function getChatAdministratorsAsync(array $params)
    {
        return $this->queryAsync(ChatMember::class, $params);
    }

    /**
     * Use this method to get the number of members in a chat. Returns Int on success.
     *
     * @link https://core.telegram.org/bots/api#getchatmemberscount
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @return int
     */
    public function getChatMembersCountAsync(array $params)
    {
        return $this->queryAsync(int, $params);
    }

    /**
     * Use this method to get information about a member of a chat. Returns a ChatMember object on success.
     *
     * @link https://core.telegram.org/bots/api#getchatmember
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @var int $params ['user_id'], Unique identifier of the target user
     * @return \Telegram\Types\ChatMember
     */
    public function getChatMemberAsync(array $params)
    {
        return $this->queryAsync(ChatMember::class, $params);
    }

    /**
     * Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#setchatstickerset
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @var string $params ['sticker_set_name'], Name of the sticker set to be set as the group sticker set
     * @return true
     */
    public function setChatStickerSetAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#deletechatstickerset
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @return true
     */
    public function deleteChatStickerSetAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert. On success, True is returned.
     *
     * @link https://core.telegram.org/bots/api#answercallbackquery
     *
     * @param array $params
     * @var string $params ['callback_query_id'], Unique identifier for the query to be answered
     * @var string $params ['text'], Text of the notification. If not specified, nothing will be shown to the user, 0-200 characters
     * @var bool $params ['show_alert'], If true, an alert will be shown by the client instead of a notification at the top of the chat screen. Defaults to false.
     * @var string $params ['url'], URL that will be opened by the user's client. If you have created a Game and accepted the conditions via @Botfather, specify the URL that opens your game – note that this will only work if the query comes from a callback_game button.Otherwise, you may use links like t.me/your_bot?start=XXXX that open your bot with a parameter.
     * @var int $params ['cache_time'], The maximum amount of time in seconds that the result of the callback query may be cached client-side. Telegram apps will support caching starting in version 3.14. Defaults to 0.
     * @return true
     */
    public function answerCallbackQueryAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to edit text and game messages sent by the bot or via the bot (for inline bots). On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @link https://core.telegram.org/bots/api#editmessagetext
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var int $params ['message_id'], Required if inline_message_id is not specified. Identifier of the sent message
     * @var string $params ['inline_message_id'], Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var string $params ['text'], New text of the message
     * @var string $params ['parse_mode'], Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your bot's message.
     * @var bool $params ['disable_web_page_preview'], Disables link previews for links in this message
     * @var InlineKeyboardMarkup $params ['reply_markup'], A JSON-serialized object for an inline keyboard.
     * @return \Telegram\Types\Message
     */
    public function editMessageTextAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to edit captions of messages sent by the bot or via the bot (for inline bots). On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @link https://core.telegram.org/bots/api#editmessagecaption
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var int $params ['message_id'], Required if inline_message_id is not specified. Identifier of the sent message
     * @var string $params ['inline_message_id'], Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var string $params ['caption'], New caption of the message
     * @var string $params ['parse_mode'], Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the media caption.
     * @var InlineKeyboardMarkup $params ['reply_markup'], A JSON-serialized object for an inline keyboard.
     * @return \Telegram\Types\Message
     */
    public function editMessageCaptionAsync(array $params = [])
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to edit animation, audio, document, photo, or video messages. If a message is a part of a message album, then it can be edited only to a photo or a video. Otherwise, message type can be changed arbitrarily. When inline message is edited, new file can't be uploaded. Use previously uploaded file via its file_id or specify a URL. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @link https://core.telegram.org/bots/api#editmessagemedia
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var int $params ['message_id'], Required if inline_message_id is not specified. Identifier of the sent message
     * @var string $params ['inline_message_id'], Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var InputMedia $params ['media'], A JSON-serialized object for a new media content of the message
     * @var InlineKeyboardMarkup $params ['reply_markup'], A JSON-serialized object for a new inline keyboard.
     * @return \Telegram\Types\Message
     */
    public function editMessageMediaAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to edit only the reply markup of messages sent by the bot or via the bot (for inline bots).  On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     *
     * @link https://core.telegram.org/bots/api#editmessagereplymarkup
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var int $params ['message_id'], Required if inline_message_id is not specified. Identifier of the sent message
     * @var string $params ['inline_message_id'], Required if chat_id and message_id are not specified. Identifier of the inline message
     * @var InlineKeyboardMarkup $params ['reply_markup'], A JSON-serialized object for an inline keyboard.
     * @return \Telegram\Types\Message
     */
    public function editMessageReplyMarkupAsync(array $params = [])
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:- A message can only be deleted if it was sent less than 48 hours ago.- Bots can delete outgoing messages in private chats, groups, and supergroups.- Bots granted can_post_messages permissions can delete outgoing messages in channels.- If the bot is an administrator of a group, it can delete any message there.- If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#deletemessage
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var int $params ['message_id'], Identifier of the message to delete
     * @return true
     */
    public function deleteMessageAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to send .webp stickers. On success, the sent Message is returned.
     *
     * @link https://core.telegram.org/bots/api#sendsticker
     *
     * @param array $params
     * @var int|string $params ['chat_id'], Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @var InputFile|string $params ['sticker'], Sticker to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an HTTP URL as a String for Telegram to get a .webp file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply $params ['reply_markup'], Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * @return \Telegram\Types\Message
     */
    public function sendStickerAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to get a sticker set. On success, a StickerSet object is returned.
     *
     * @link https://core.telegram.org/bots/api#getstickerset
     *
     * @param array $params
     * @var string $params ['name'], Name of the sticker set
     * @return \Telegram\Types\StickerSet
     */
    public function getStickerSetAsync(array $params)
    {
        return $this->queryAsync(StickerSet::class, $params);
    }

    /**
     * Use this method to upload a .png file with a sticker for later use in createNewStickerSet and addStickerToSet methods (can be used multiple times). Returns the uploaded File on success.
     *
     * @link https://core.telegram.org/bots/api#uploadstickerfile
     *
     * @param array $params
     * @var int $params ['user_id'], User identifier of sticker file owner
     * @var InputFile $params ['png_sticker'], Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px. More info on Sending Files »
     * @return \Telegram\Types\File
     */
    public function uploadStickerFileAsync(array $params)
    {
        return $this->queryAsync(File::class, $params);
    }

    /**
     * Use this method to create new sticker set owned by a user. The bot will be able to edit the created sticker set. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#createnewstickerset
     *
     * @param array $params
     * @var int $params ['user_id'], User identifier of created sticker set owner
     * @var string $params ['name'], Short name of sticker set, to be used in t.me/addstickers/ URLs (e.g., animals). Can contain only english letters, digits and underscores. Must begin with a letter, can't contain consecutive underscores and must end in "_by_<bot username>”. <bot_username> is case insensitive. 1-64 characters.
     * @var string $params ['title'], Sticker set title, 1-64 characters
     * @var InputFile|string $params ['png_sticker'], Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px. Pass a file_id as a String to send a file that already exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
     * @var string $params ['emojis'], One or more emoji corresponding to the sticker
     * @var bool $params ['contains_masks'], Pass True, if a set of mask stickers should be created
     * @var MaskPosition $params ['mask_position'], A JSON-serialized object for position where the mask should be placed on faces
     * @return true
     */
    public function createNewStickerSetAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to add a new sticker to a set created by the bot. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#addstickertoset
     *
     * @param array $params
     * @var int $params ['user_id'], User identifier of sticker set owner
     * @var string $params ['name'], Sticker set name
     * @var InputFile|string $params ['png_sticker'], Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px. Pass a file_id as a String to send a file that already exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
     * @var string $params ['emojis'], One or more emoji corresponding to the sticker
     * @var MaskPosition $params ['mask_position'], A JSON-serialized object for position where the mask should be placed on faces
     * @return true
     */
    public function addStickerToSetAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to move a sticker in a set created by the bot to a specific position . Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#setstickerpositioninset
     *
     * @param array $params
     * @var string $params ['sticker'], File identifier of the sticker
     * @var int $params ['position'], New sticker position in the set, zero-based
     * @return true
     */
    public function setStickerPositionInSetAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to delete a sticker from a set created by the bot. Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#deletestickerfromset
     *
     * @param array $params
     * @var string $params ['sticker'], File identifier of the sticker
     * @return true
     */
    public function deleteStickerFromSetAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to send answers to an inline query. On success, True is returned.No more than 50 results per query are allowed.
     *
     * @link https://core.telegram.org/bots/api#answerinlinequery
     *
     * @param array $params
     * @var string $params ['inline_query_id'], Unique identifier for the answered query
     * @var InlineQueryResult $params ['results'], A JSON-serialized array of results for the inline query
     * @var int $params ['cache_time'], The maximum amount of time in seconds that the result of the inline query may be cached on the server. Defaults to 300.
     * @var bool $params ['is_personal'], Pass True, if results may be cached on the server side only for the user that sent the query. By default, results may be returned to any user who sends the same query
     * @var string $params ['next_offset'], Pass the offset that a client should send in the next query with the same text to receive more results. Pass an empty string if there are no more results or if you don‘t support pagination. Offset length can’t exceed 64 bytes.
     * @var string $params ['switch_pm_text'], If passed, clients will display a button with specified text that switches the user to a private chat with the bot and sends the bot a start message with the parameter switch_pm_parameter
     * @var string $params ['switch_pm_parameter'], Deep-linking parameter for the /start message sent to the bot when user presses the switch button. 1-64 characters, only A-Z, a-z, 0-9, _ and - are allowed.Example: An inline bot that sends YouTube videos can ask the user to connect the bot to their YouTube account to adapt search results accordingly. To do this, it displays a ‘Connect your YouTube account’ button above the results, or even before showing any. The user presses the button, switches to a private chat with the bot and, in doing so, passes a start parameter that instructs the bot to return an oauth link. Once done, the bot can offer a switch_inline button so that the user can easily return to the chat where they wanted to use the bot's inline capabilities.
     * @return true
     */
    public function answerInlineQueryAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot. Use this method to reply to shipping queries. On success, True is returned.
     *
     * @link https://core.telegram.org/bots/api#answershippingquery
     *
     * @param array $params
     * @var string $params ['shipping_query_id'], Unique identifier for the query to be answered
     * @var bool $params ['ok'], Specify True if delivery to the specified address is possible and False if there are any problems (for example, if delivery to the specified address is not possible)
     * @var ShippingOption $params ['shipping_options'], Required if ok is True. A JSON-serialized array of available shipping options.
     * @var string $params ['error_message'], Required if ok is False. Error message in human readable form that explains why it is impossible to complete the order (e.g. "Sorry, delivery to your desired address is unavailable'). Telegram will display this message to the user.
     * @return true
     */
    public function answerShippingQueryAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query. Use this method to respond to such pre-checkout queries. On success, True is returned. Note: The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
     *
     * @link https://core.telegram.org/bots/api#answerprecheckoutquery
     *
     * @param array $params
     * @var string $params ['pre_checkout_query_id'], Unique identifier for the query to be answered
     * @var bool $params ['ok'], Specify True if everything is alright (goods are available, etc.) and the bot is ready to proceed with the order. Use False if there are any problems.
     * @var string $params ['error_message'], Required if ok is False. Error message in human readable form that explains the reason for failure to proceed with the checkout (e.g. "Sorry, somebody just bought the last of our amazing black T-shirts while you were busy filling out your payment details. Please choose a different color or garment!"). Telegram will display this message to the user.
     * @return true
     */
    public function answerPreCheckoutQueryAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors. The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change). Returns True on success.
     *
     * @link https://core.telegram.org/bots/api#setpassportdataerrors
     *
     * @param array $params
     * @var int $params ['user_id'], User identifier
     * @var PassportElementError $params ['errors'], A JSON-serialized array describing the errors
     * @return true
     */
    public function setPassportDataErrorsAsync(array $params)
    {
        return $this->queryAsync(true, $params);
    }

    /**
     * Use this method to send a game. On success, the sent Message is returned.
     *
     * @link https://core.telegram.org/bots/api#sendgame
     *
     * @param array $params
     * @var int $params ['chat_id'], Unique identifier for the target chat
     * @var string $params ['game_short_name'], Short name of the game, serves as the unique identifier for the game. Set up your games via Botfather.
     * @var bool $params ['disable_notification'], Sends the message silently. Users will receive a notification with no sound.
     * @var int $params ['reply_to_message_id'], If the message is a reply, ID of the original message
     * @var InlineKeyboardMarkup $params ['reply_markup'], A JSON-serialized object for an inline keyboard. If empty, one ‘Play game_title’ button will be shown. If not empty, the first button must launch the game.
     * @return \Telegram\Types\Message
     */
    public function sendGameAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to set the score of the specified user in a game. On success, if the message was sent by the bot, returns the edited Message, otherwise returns True. Returns an error, if the new score is not greater than the user's current score in the chat and force is False.
     *
     * @link https://core.telegram.org/bots/api#setgamescore
     *
     * @param array $params
     * @var int $params ['user_id'], User identifier
     * @var int $params ['score'], New score, must be non-negative
     * @var bool $params ['force'], Pass True, if the high score is allowed to decrease. This can be useful when fixing mistakes or banning cheaters
     * @var bool $params ['disable_edit_message'], Pass True, if the game message should not be automatically edited to include the current scoreboard
     * @var int $params ['chat_id'], Required if inline_message_id is not specified. Unique identifier for the target chat
     * @var int $params ['message_id'], Required if inline_message_id is not specified. Identifier of the sent message
     * @var string $params ['inline_message_id'], Required if chat_id and message_id are not specified. Identifier of the inline message
     * @return \Telegram\Types\Message
     */
    public function setGameScoreAsync(array $params)
    {
        return $this->queryAsync(Message::class, $params);
    }

    /**
     * Use this method to get data for high score tables. Will return the score of the specified user and several of his neighbors in a game. On success, returns an Array of GameHighScore objects.
     *
     * @link https://core.telegram.org/bots/api#getgamehighscores
     *
     * @param array $params
     * @var int $params ['user_id'], Target user id
     * @var int $params ['chat_id'], Required if inline_message_id is not specified. Unique identifier for the target chat
     * @var int $params ['message_id'], Required if inline_message_id is not specified. Identifier of the sent message
     * @var string $params ['inline_message_id'], Required if chat_id and message_id are not specified. Identifier of the inline message
     * @return \Telegram\Types\GameHighScore[]
     */
    public function getGameHighScoresAsync(array $params)
    {
        return $this->queryAsync(GameHighScore::class, $params);
    }

    //
    private function queryAsync($type, array $params = [])
    {
        // get the method from the fucntion name
        [$query, $caller] = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);

        // create a new request ready to be sent
        $request = new Request(substr($caller['function'], 0, -5), $params);

        // send the request, this method will return an instance of the responseType
        return $this->sendAsync($request, [
            'type' => $type
        ]);
    }
}
