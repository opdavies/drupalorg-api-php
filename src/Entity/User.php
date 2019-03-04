<?php

namespace Opdavies\Drupalorg\Entity;

class User extends Entity
{
    /**
     * Get the user's username.
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->data['name'];
    }
}
