<?php

namespace Telegram;

class Response
{
    /**
     * The response type.
     *
     * @var string
     */
    protected $type;

    /**
     * The response data.
     *
     * @var array
     */
    protected $response;

    /**
     * The response body.
     *
     * @var mixed
     */
    protected $body;

    /**
     * Create a new Response instance.
     *
     * @param string $type
     * @param array $response
     */
    public function __construct($type, $body)
    {
        $this->type = $type;
        $this->body = $body;
    }

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
     * Cast the response to a given type.
     *
     * @param array $data
     * @return mixed
     */
    protected function castResponse($data)
    {
        // special value
        if (is_bool($data) || is_numeric($data) || is_string($data)) {
            return $data;
        }

        // we have an array of objects
        // this will check if we have an array of array
        if (is_array($data) && key($data) === 0) {
            return array_map(function ($data) use($type) {
                return $this->castResponse($data, $this->type);
            }, $data);
        }

        return new $this->type($data, $this);
    }
}
