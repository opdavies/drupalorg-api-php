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
        $projectA->field_download_count = 1234;
        $projectA->flag_project_star_user = [1];
        $projectA->nid = 1;
        $projectA->title = 'Project A';
        $nodes[] = $projectA;

        $projectB = new stdClass();
        $projectB->field_download_count = 0;
        $projectB->flag_project_star_user = [];
        $projectB->nid = 2;
        $projectB->title = 'Project B';
        $nodes[] = $projectB;

        $projectC = new stdClass();
        $projectC->field_download_count = 99;
        $projectC->flag_project_star_user = [1, 2, 3, 4, 5];
        $projectC->nid = 3;
        $projectC->title = 'Project C';
        $nodes[] = $projectC;

        return $nodes;
    }
}
