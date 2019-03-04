<?php

namespace Opdavies\Drupalorg\Query;

interface QueryInterface
{
    /**
     * Set the URI for the query.
     *
     * @return string
     */
    public function setUri(): string;

    /**
     * Set any additional options for the query.
     *
     * @param array $options
     * @return self
     */
    public function setOptions(array $options): self;
}
