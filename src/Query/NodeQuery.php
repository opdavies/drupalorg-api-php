<?php

namespace Opdavies\Drupalorg\Query;

class NodeQuery extends AbstractQuery
{
    /**
     * {@inheritdoc}
     */
    public function setUri()
    {
        return 'node.json';
    }
}
