<?php

namespace Opdavies\Drupalorg\Query;

class UserQuery extends Query
{
    /**
     * {@inheritdoc}
     */
    public function setUri(): string
    {
        return 'user.json';
    }
}
