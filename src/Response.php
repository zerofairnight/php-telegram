<?php

namespace Telegram;

class Response
{
    /**
     * The type map, contains the response type for the telegram methods.
     *
     * @var array
     */
    protected $types = [
        'getUpdates' => Types\Update::class,
        'setWebhook' => true,
        'deleteWebhook' => true,
        'getWebhookInfo' => Types\WebhookInfo::class,
        'getMe' => Types\User::class,
        'sendMessage' => Types\Message::class,
        'forwardMessage' => Types\Message::class,
        'sendPhoto' => Types\Message::class,
        'sendAudio' => Types\Message::class,
        'sendDocument' => Types\Message::class,
        'sendVideo' => Types\Message::class,
        'sendAnimation' => Types\Message::class,
        'sendVoice' => Types\Message::class,
        'sendVideoNote' => Types\Message::class,
        'sendMediaGroup' => Types\Message::class,
        'sendLocation' => Types\Message::class,
        'editMessageLiveLocation' => Types\Message::class,
        'stopMessageLiveLocation' => Types\Message::class,
        'sendVenue' => Types\Message::class,
        'sendContact' => Types\Message::class,
        'sendChatAction' => true,
        'getUserProfilePhotos' => Types\UserProfilePhotos::class,
        'getFile' => Types\File::class,
        'kickChatMember' => true,
        'unbanChatMember' => true,
        'restrictChatMember' => true,
        'promoteChatMember' => true,
        'exportChatInviteLink' => null, // string
        'setChatPhoto' => true,
        'deleteChatPhoto' => true,
        'setChatTitle' => true,
        'setChatDescription' => true,
        'pinChatMessage' => true,
        'unpinChatMessage' => true,
        'leaveChat' => true,
        'getChat' => Types\Chat::class,
        'getChatAdministrators' => Types\ChatMember::class,
        'getChatMembersCount' => null, // int
        'getChatMember' => Types\ChatMember::class,
        'setChatStickerSet' => true,
        'deleteChatStickerSet' => true,
        'answerCallbackQuery' => true,
        'editMessageText' => Types\Message::class,
        'editMessageCaption' => Types\Message::class,
        'editMessageMedia' => Types\Message::class,
        'editMessageReplyMarkup' => Types\Message::class,
        'deleteMessage' => true,
        'sendSticker' => Types\Message::class,
        'getStickerSet' => Types\StickerSet::class,
        'uploadStickerFile' => Types\File::class,
        'createNewStickerSet' => true,
        'addStickerToSet' => true,
        'setStickerPositionInSet' => true,
        'deleteStickerFromSet' => true,
        'answerInlineQuery' => true,
        'answerShippingQuery' => true,
        'answerPreCheckoutQuery' => true,
        'setPassportDataErrors' => true,
        'sendGame' => Types\Message::class,
        'setGameScore' => Types\Message::class,
        'getGameHighScores' => Types\GameHighScore::class,
    ];

    /**
     * The request.
     *
     * @var \Telegram\Request
     */
    protected $request;

    /**
     * The response body.
     *
     * @var array
     */
    protected $body;

    /**
     * Create a new Response instance.
     *
     * @param \Telegram\Request $request
     * @param array $response
     */
    public function __construct(Request $request, $body)
    {
        $this->request = $request;
        $this->body = $body;
    }

    /**
     * Get the response body.
     *
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Get if the response is successful.
     *
     * @return true
     */
    public function isSuccessful()
    {
        return isset($this->body['ok']) && $this->body['ok'] === true;
    }

    // TODO: comment me
    public function verifyResponse()
    {
        // ['ok'] is not set
        if (! isset($this->body['ok'])) {
            throw new \Exception('http error');
        }

        if ($this->body['ok'] === false) {
            throw new \Exception($this->body['description']);
        }
    }

    /**
     * Get the response result.
     *
     * @return mixed
     */
    public function result()
    {
        if (! $this->isSuccessful()) {
            throw new \Exception();
        }

        return $this->body['result'];
    }

    /**
     * Instance a response type.
     *
     * @param Telegram $telegram
     * @return void
     */
    public function createResponseType(Telegram $telegram)
    {
        // get the method of the request
        $method = $this->request->getMethod();

        // TODO: make sure we have all the types and if not, dont parse the response
        $type = $this->types[$method];

        // get the response resut
        $data = $this->result();

        return $this->castResponse($data, $type, $telegram);
    }

    /**
     * Cast the response to a given type.
     *
     * @param array $data
     * @return mixed
     */
    protected function castResponse($data, $type, $telegram)
    {
        // special value
        if (is_bool($data) || is_numeric($data) || is_string($data)) {
            return $data;
        }

        // we have an array of objects
        // this will check if we have an array of array
        if (is_array($data) && key($data) === 0) {
            return array_map(function ($data) use(&$type, &$telegram) {
                return $this->castResponse($data, $type, $telegram);
            }, $data);
        }

        return new $type($data, $telegram);
    }
}
