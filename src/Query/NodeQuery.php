<?php

namespace Opdavies\Drupalorg\Query;

class NodeQuery extends Query
{
    /**
     * {@inheritdoc}
     */
    public function setUri()
    {
        return 'node.json';
    }
}
