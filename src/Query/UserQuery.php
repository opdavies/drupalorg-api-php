<?php

namespace Opdavies\Drupalorg\Query;

class UserQuery extends AbstractQuery
{
    /**
     * {@inheritdoc}
     */
    public function setUri()
    {
        return 'user.json';
    }
}
