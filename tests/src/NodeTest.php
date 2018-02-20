<?php

namespace Opdavies\Drupalorg\Tests;

use Opdavies\Drupalorg\Entity\Node;
use Opdavies\Drupalorg\Tests\Query\NodeQuery;
use PHPUnit\Framework\TestCase;
use stdClass;

class NodeTest extends TestCase
{
    /**
     * @var Node[]
     */
    private $nodes;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $items = (new NodeQuery())
          ->setNodes($this->getNodes())
          ->execute()
          ->getContents();

        $this->nodes = collect($items)->map(function (stdClass $item) {
            return Node::create($item);
        });
    }

    public function testGetNid()
    {
        $this->assertEquals(5, $this->nodes[0]->get('nid'));
    }

    public function testGetTitle()
    {
        $this->assertEquals('Foo', $this->nodes[0]->getTitle());
    }

    /**
     * @return array
     */
    private function getNodes() {
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
