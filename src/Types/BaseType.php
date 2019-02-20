<?php

namespace Telegram\Types;

class BaseType
{
    /**
     * The telegram instance.
     *
     * @var \Telegram\Telegram
     */
    protected $telegram;

    /**
     * The response meta fields.
     *
     * @var array
     */
    protected $meta = [];

    /**
     * The response data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Create a new Telegram Response from a data array.
     *
     * @param  array  $data
     * @param  \Telegram\Telegram  $telegram
     * @return void
     */
    public function __construct(array $data = [], $telegram = null)
    {
        $this->data = $data;
        $this->telegram = $telegram;

        foreach ($data as $property => $data) {
            $this->data[$property] = $this->resolveRelation($property);
        }
    }

    private function resolveRelation($property)
    {
        // check if we have a meta property
        if (! array_key_exists($property, $this->meta)) {
            return $this->data[$property];
        }

        // we have a valid relationship
        $data = $this->data[$property];

        // if this is a standard array
        if (is_array($data) && key($data) === 0) {
            return array_map(function ($data) use($property) {
                // nested array, this is a special case
                if (is_array($data) && key($data) === 0) {
                    return array_map(function ($data) use($property) {
                        return new $this->meta[$property]($data, $this->telegram);
                    }, $data);
                }
                return new $this->meta[$property]($data, $this->telegram);
            }, $data);
        }

        return new $this->meta[$property]($data, $this->telegram);
    }

    public function __get(string $name)
    {
        return array_key_exists($name, $this->data) ? $this->data[$name] : null;
    }
}
