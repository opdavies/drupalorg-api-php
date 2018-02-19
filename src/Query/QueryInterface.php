<?php

namespace Opdavies\Drupalorg\Query;

interface QueryInterface
{
    /**
     * Set the URI for the query.
     *
     * @return string
     */
    public function setUri();

    /**
     * Set any additional options for the query.
     *
     * @param array $options
     */
    public function setOptions(array $options);
}
