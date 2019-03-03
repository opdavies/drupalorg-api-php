<?php

namespace Opdavies\Drupalorg\Tests\Query;

use GuzzleHttp\Psr7\Response;
use Opdavies\Drupalorg\Entity\Node;
use Opdavies\Drupalorg\Query\UserQuery;

/**
 * Queries for Drupal.org users.
 */
class FakeUserQuery extends UserQuery
{
    /**
     * @var Node[]
     */
    protected $users = [];

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->response = new Response();

        $this->contents = collect($this->users);

        return $this;
    }

    /**
     * Allow for setting test nodes to return from the query.
     *
     * @param array $users
     *
     * @return $this
     */
    public function setUsers(array $users)
    {
        $this->users = $users;

        return $this;
    }
}
