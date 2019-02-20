<?php

namespace Telegram;

class Request
{
    /**
     * The method of the request.
     *
     * @var string
     */
    protected $method;

    /**
     * The data of the request.
     *
     * @var array
     */
    protected $data;

    /**
     * Create a new Request instance.
     *
     * @param string $method
     * @param array $data
     */
    public function __construct($method, array $data)
    {
        $this->method = $method;
        $this->data = $data;
    }

    /**
     * Get the request method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Return true if the request should be send as multipart.
     *
     * @return boolean
     */
    public function isMultipart()
    {
        return (bool) count(array_filter($this->data, function ($param) {
            return is_resource($param) || $param instanceof \Psr\Http\Message\StreamInterface || $param instanceof InputFile;
        }));
    }

    /**
     * Create a multipart data request body.
     *
     * @return array
     */
    public function multipart()
    {
        return array_map(function ($name, $contents) {
            if ($contents instanceof InputFile) {
                return [
                    'name' => $name,
                    'contents' => $contents->open(),
                    'filename' => $contents->getFilename()
                ];
            }
            // if is a File instance, we also need to set the filename
            return compact('name', 'contents');
        }, array_keys($this->data), $this->data);
    }

    /**
     * Create a multipart data that can be sent as json.
     *
     * @return void
     */
    public function multipartData()
    {
        return array_map(function ($name, $contents) {
            if ($contents instanceof InputFile) {
                return [
                    'name' => $name,
                    'contents' => $contents->open(),
                    'filename' => $contents->getFilename()
                ];
            }

            // if is a File instance, we also need to set the filename
            return compact('name', 'contents');

        }, array_keys($this->data), $this->data);
    }

    /**
     * Create a data that can be sent as json.
     *
     * @return array
     */
    public function data()
    {
        return $this->data;
    }
}
