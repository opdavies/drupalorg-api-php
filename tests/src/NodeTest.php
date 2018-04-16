<?php

namespace Opdavies\Drupalorg\Tests;

use Opdavies\Drupalorg\Entity\Node;
use Opdavies\Drupalorg\Tests\Query\FakeNodeQuery;
use PHPUnit\Framework\TestCase;
use stdClass;

class NodeTest extends TestCase
{
    /**
     * @var Node[]
     */
    private $nodes;

    /**
     * Test that the correct node ID is returned.
     */
    public function testGetNid()
    {
        $this->assertEquals(5, $this->nodes[0]->get('nid'));
    }

    /**
     * Test that the correct node title is returned.
     */
    public function testGetTitle()
    {
        $this->assertEquals('Foo', $this->nodes[0]->getTitle());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->nodes = (new FakeNodeQuery())
            ->setNodes($this->getNodes())
            ->execute()
            ->getContents()
            ->map(function (stdClass $item) {
                return Node::create($item);
            });
    }

    /**
     * @return array
     */
    private function getNodes()
    {
        $nodes = [];

        $nodeA = new stdClass();
        $nodeA->title = 'Foo';
        $nodeA->nid = 5;
        $nodes[] = $nodeA;

        $nodeB = new stdClass();
        $nodeB->title = 'Bar';
        $nodeB->nid = 10;
        $nodes[] = $nodeB;

        return $nodes;
    }
}
