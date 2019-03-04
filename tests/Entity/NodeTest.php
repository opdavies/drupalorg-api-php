<?php

namespace Opdavies\Drupalorg\Tests\Entity;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Opdavies\Drupalorg\Entity\Node;
use Opdavies\Drupalorg\Query\NodeQuery;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    /** @var \Illuminate\Support\Collection */
    private $nodes;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'list' => [
                    ['nid' => 107871, 'title' => 'Override Node Options'],
                    ['nid' => 3012622, 'title' => 'Simple Smartling'],
                ],
            ])),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $this->nodes = (new NodeQuery($client))
            ->execute()
            ->getContents()
            ->map(function (\stdClass $item) {
                return Node::create($item);
            });
    }

    /** @test */
    public function get_node_id()
    {
        $this->assertEquals(107871, $this->nodes[0]->get('nid'));
        $this->assertEquals(3012622, $this->nodes[1]->get('nid'));
    }

    /** @test */
    public function get_title()
    {
        $this->assertEquals('Override Node Options', $this->nodes[0]->getTitle());
        $this->assertEquals('Simple Smartling', $this->nodes[1]->getTitle());
    }
}
