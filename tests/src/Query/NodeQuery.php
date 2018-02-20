<?php

namespace Opdavies\Drupalorg\Tests\Query;

use GuzzleHttp\Psr7\Response;
use Opdavies\Drupalorg\Entity\Node;
use stdClass;

class NodeQuery extends \Opdavies\Drupalorg\Query\NodeQuery
{
    /**
     * @var Node[]
     */
    protected $nodes = [];

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $this->response = new Response();

        $this->contents = collect($this->nodes);

        return $this;
    }

    public function setNodes(array $nodes)
    {
        $this->nodes = $nodes;

        return $this;
    }
}
