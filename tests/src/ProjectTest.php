<?php

namespace Opdavies\Drupalorg\Tests;

use Opdavies\Drupalorg\Entity\Project;
use Opdavies\Drupalorg\Tests\Query\NodeQuery;
use Opdavies\Drupalorg\Tests\Query\ProjectQuery;
use PHPUnit\Framework\TestCase;
use stdClass;

class ProjectTest extends TestCase
{
    /**
     * @var Project[]
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
            return Project::create($item);
        })->all();
    }

    public function testGetDownloadCount()
    {
        $this->assertSame(1234, $this->nodes[0]->getDownloads());
        $this->assertSame(0, $this->nodes[1]->getDownloads());
        $this->assertSame(99, $this->nodes[2]->getDownloads());
    }

    public function testGetStarCount()
    {
        $this->assertSame(1, $this->nodes[0]->getStars());
        $this->assertSame(0, $this->nodes[1]->getStars());
        $this->assertSame(5, $this->nodes[2]->getStars());
    }

    /**
     * @return array
     */
    private function getNodes()
    {
        $nodes = [];

        $projectA = new stdClass();
        $projectA->nid = 1;
        $projectA->title = 'Project A';
        $projectA->{Project::FIELD_DOWNLOADS} = 1234;
        $projectA->{Project::FIELD_STARS} = [1];
        $nodes[] = $projectA;

        $projectB = new stdClass();
        $projectB->nid = 2;
        $projectB->title = 'Project B';
        $projectB->{Project::FIELD_DOWNLOADS} = 0;
        $projectB->{Project::FIELD_STARS} = [];
        $nodes[] = $projectB;

        $projectC = new stdClass();
        $projectC->nid = 3;
        $projectC->title = 'Project C';
        $projectC->{Project::FIELD_DOWNLOADS} = 99;
        $projectC->{Project::FIELD_STARS} = [1, 2, 3, 4, 5];
        $nodes[] = $projectC;

        return $nodes;
    }
}
