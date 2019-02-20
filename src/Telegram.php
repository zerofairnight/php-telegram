<?php

namespace Telegram;

use Telegram\Exception\RequestException;

class Telegram
{
    use APIRequests, APIRequestsAsync;

    /**
     * The telegram base url for API requests.
     *
     * @var string
     */
    const URL = 'https://api.telegram.org/bot';

    /**
     * The http client.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The telegram API token.
     *
     * @var string
     */
    protected $token;

    /**
     * The telegram bot username.
     *
     * @var string
     */
    protected $username;

    /**
     * Creates a new Telegram API Request.
     *
     * @param array $options The token used for the request.
     * @var string $options ['token'], The token used for the request.
     * @var string $options ['username'], (Optional) The token used for the request.
     */
    public function __construct(array $options, array $config = [])
    {
        // this is not necessary
        if (empty($options['token'])) {
            throw new \InvalidArgumentException('Token is required to use telegram');
        }

        // username is optional
        $options = \array_merge([
            'username' => null
        ], $options);

        $this->client = new \GuzzleHttp\Client($config);

        $this->token = $options['token'];
        $this->username = $options['username'];
    }

    /**
     * Get the bot id, the unique identifier of this bot.
     *
     * @return string
     */
    public function getBotId()
    {
        // the first part of the telegram token is the bot id separated by a colon.
        return explode(':', $this->token)[0];
    }

    /**
     * Get the token of the bot.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Get the bot username, null if not set.
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the full url of the endpoint for the method.
     *
     * @return string
     */
    public function getEndpoint($method)
    {
        return self::URL . "{$this->token}/{$method}";
    }

    /**
     * Get the full url of the endpoint for the file.
     *
     * @return string
     */
    public function getFileEndpoint($file)
    {
        return "https://api.telegram.org/file/bot" . "{$this->token}/{$file}";
    }

    /**
     * Send the request asynchronously.
     *
     * @param Request $request
     * @param array $options
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function sendAsync(Request $request, array $options = [])
    {
        // get the request endpoint
        $url = $this->getEndpoint($request->getMethod());

        return $this->client->postAsync($url, $this->createRequestOptions($request, $options))->then(
            //
            function (\Psr\Http\Message\ResponseInterface $response) use (&$options) {
                $contents = json_decode($response->getBody(), true);

                // if $contents is null or ok is not set the response is not a valid telegram response
                if (! isset($contents['ok'])) {
                    throw new RequestException();
                }

                // we have a valid response
                if ($contents['ok'] === true) {
                    // check if we want to cast the response to a given type
                    if (isset($options['type'])) {
                        return $this->parseResponse($contents['result'], $options['type']);
                    }

                    // do not handle the result
                    return $contents['result'];
                }

                // here we can have an error that can be caused by
                // invalid token
                // method that not exists
                // missing parameters

                if ($contents['ok'] === false) {
                    // $contents['parameters'] is a ResponseParameters::class
                    throw new RequestException($contents['description']);
                }

                // here we have a case that should never happen
                // telegram api will always return $contents['ok'] true or false
                throw new RequestException();
            }
        );
    }

    /**
     * Send the request.
     *
     * @param Request $request
     * @param array $options
     * @return mixed
     */
    public function send(Request $request, array $options = [])
    {
        $response = $this->sendAsync($request, $options)->wait();

        return $response;
    }

    protected function createRequestOptions($request, $options)
    {
        $options = [
            \GuzzleHttp\RequestOptions::HTTP_ERRORS => false,
            \GuzzleHttp\RequestOptions::SYNCHRONOUS => true,
        ];

        if ($request->isMultipart()) {
            $options[\GuzzleHttp\RequestOptions::MULTIPART] = $request->multipartData();
        } else {
            $options[\GuzzleHttp\RequestOptions::JSON] = $request->data();
        }

        return $options;
    }

    protected function parseResponse($data, $type)
    {
        // special value
        if (is_bool($data) || is_numeric($data) || is_string($data)) {
            return $data;
        }

        // we have an array of objects
        // this will check if we have an array of array
        if (is_array($data) && key($data) === 0) {
            return array_map(function ($data) use($type) {
                return $this->parseResponse($data, $type);
            }, $data);
        }

        return new $type($data, $this);
    }
}
