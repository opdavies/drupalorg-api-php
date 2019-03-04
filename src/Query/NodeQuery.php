<?php

namespace Opdavies\Drupalorg\Query;

class NodeQuery extends Query
{
    /**
     * {@inheritdoc}
     */
    public function setUri(): string
    {
        return 'node.json';
    }
}
