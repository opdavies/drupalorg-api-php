<?php

namespace Opdavies\Drupalorg\Entity;

use Illuminate\Support\Collection;
use stdClass;

abstract class Entity
{
    /**
     * The entity data.
     *
     * @var Collection
     */
    protected $data;

    /**
     * Node constructor.
     *
     * @param stdClass $data The node data.
     */
    public function __construct(stdClass $data)
    {
        $this->data = collect($data);
    }

    /**
     * Convert an item into a Node entity.
     *
     * @param  stdClass $item The original data.
     * @return static
     */
    public static function create(stdClass $item)
    {
        return new static($item);
    }

    /**
     * Get a property of the node data.
     *
     * @param  string  $key The property to get.
     * @param  null    $default A default value.
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return $this->data->get($key, $default);
    }
}
