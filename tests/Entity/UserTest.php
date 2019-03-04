<?php

namespace Opdavies\Drupalorg\Tests\Entity;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Opdavies\Drupalorg\Entity\User;
use Opdavies\Drupalorg\Query\UserQuery;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @var Collection
     */
    private $users;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'list' => [
                    ['uid' => 1, 'name' => 'Dries'],
                    ['uid' => 381388, 'name' => 'opdavies'],
                ],
            ])),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $this->users = (new UserQuery($client))
            ->execute()
            ->getContents()
            ->map(function (\stdClass $user) {
                return User::create($user);
            });
    }

    /** @test */
    public function get_username()
    {
        $this->assertEquals('Dries', $this->users[0]->getUsername());
        $this->assertEquals('opdavies', $this->users[1]->getUsername());
    }
}
