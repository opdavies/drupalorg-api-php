<?php

namespace Opdavies\Drupalorg\Query;

class UserQuery extends Query
{
    /**
     * {@inheritdoc}
     */
    public function setUri()
    {
        return 'user.json';
    }
}
