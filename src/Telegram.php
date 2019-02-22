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
        // the first part of the telegram token, its the bot id separated by a colon.
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
            function (\Psr\Http\Message\ResponseInterface $response) use (&$request, &$options) {
                // we want an associative array
                $contents = json_decode($response->getBody(), true);

                // if $contents is null or ok is not set, the response is not a valid telegram response
                if (! isset($contents['ok'])) {
                    throw new RequestException();
                }

                // here we can have an error that can be caused by
                // invalid token
                // method that not exists
                // missing parameters
                if ($contents['ok'] === false) {
                    // $contents['parameters'] is a ResponseParameters::class
                    throw new RequestException($contents['description']);
                }

                // this should never happen, telegram will always return $contents['ok'] true or false
                if ($contents['ok'] !== true) {
                    throw new RequestException();
                }

                // this is a big change in the code as we use the Response class
                // to handle the response, it may seems overkill to create a class that we never use
                // but the idea is that, at some point in the future, we may want to have access to this object
                // and control the flow of the request

                // create the response, the response should have a reference the the request
                // we dont bind the response to the telegram instance
                // this is because the telegram isntance will handle the flow not the individual pieces
                $res = new Response($request, $contents);

                // here we can have a chance to intercept this response for future usage
                // $this->onResponse(function ($response))

                // here we bind the response object to this telegram instance
                // this way the response is independant from the telegram instance
                return $res->createResponseType($this);
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
}
