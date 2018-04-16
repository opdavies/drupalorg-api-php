<?php

namespace Opdavies\Drupalorg\Tests\Entity;

use Opdavies\Drupalorg\Entity\User;
use Opdavies\Drupalorg\Tests\Query\FakeUserQuery;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @var User[]
     */
    private $users;

  /**
   * {@inheritdoc}
   */
    protected function setUp()
    {
        $this->users = (new FakeUserQuery())
            ->setUsers($this->getUsers())
            ->execute()
            ->getContents()
            ->map(function (\stdClass $item) {
                return User::create($item);
            });
    }

    public function testGetUsername() {
      $this->assertEquals('Dries', $this->users[0]->getUsername());
      $this->assertEquals('opdavies', $this->users[1]->getUsername());
    }

    /**
     * @return array
     */
    private function getUsers()
    {
        $users = [];

        $user1 = new \stdClass();
        $user1->uid = 1;
        $user1->username = 'Dries';
        $users[] = $user1;

        $user2 = new \stdClass();
        $user2->uid = 381388;
        $user2->username = 'opdavies';
        $users[] = $user2;

        return $users;
    }
}
