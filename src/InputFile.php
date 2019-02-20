<?php

namespace Telegram;

use Psr\Http\Message\StreamInterface;

class InputFile
{
    /**
     * The file.
     *
     * @var mixed
     */
    protected $file;

    /**
     * The filename.
     *
     * @var mixed
     */
    protected $filename;

    /**
     * The file handle.
     *
     * @var resource
     */
    protected $handle;

    /**
     * Create a new InputFile instance.
     *
     * @param string|resource $file
     * @param string $filename
     */
    function __construct($file, $filename = null)
    {
        $this->file = $file;
        $this->filename = $filename;
    }

    /**
     * Get the filename.
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    public function open()
    {
        return $this->file;

        // if its a rerouce its already open
        if (is_resource($this->file) && get_resource_type($this->file) === 'stream') {
            return;
        }

        // we have a valid handle
        if (! is_null($this->handle)) {
            return $this->handle;
        }

        // we have a string that point to a file
        if (is_string($this->file) && is_file($this->file) && is_readable($this->file)) {
            return $this->handle = fopen($this->file, 'r');
        }
    }

    /**
     * Create a new InputFile intance.
     *
     * @param mixed $file
     * @param string $filename
     * @return InputFile
     */
    public static function create($file, $filename = null): InputFile
    {
        return new static($file, $filename);
    }
}
