<?php

namespace Opdavies\Drupalorg\Tests\Entity;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use Opdavies\Drupalorg\Entity\Project;
use Opdavies\Drupalorg\Query\NodeQuery;
use PHPUnit\Framework\TestCase;

class ProjectTest extends TestCase
{
    /** @var Collection */
    private $projects;

    /**
     * Test that the correct download count is returned.
     */
    public function testGetDownloadCount()
    {
        $this->assertSame(1234, $this->projects[0]->getDownloads());
        $this->assertSame(0, $this->projects[1]->getDownloads());
        $this->assertSame(99, $this->projects[2]->getDownloads());
    }

    /**
     * Test that the correct star count is returned.
     */
    public function testGetStarCount()
    {
        $this->assertSame(1, $this->projects[0]->getStars());
        $this->assertSame(0, $this->projects[1]->getStars());
        $this->assertSame(5, $this->projects[2]->getStars());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'list' => [
                    [Project::FIELD_DOWNLOADS => 1234, Project::FIELD_STARS => [1]],
                    [Project::FIELD_DOWNLOADS => 0, Project::FIELD_STARS => []],
                    [Project::FIELD_DOWNLOADS => 99, Project::FIELD_STARS => [1, 2, 3, 4, 5]],
                ],
            ])),
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $this->projects = (new NodeQuery($client))
            ->execute()
            ->getContents()
            ->map(function (\stdClass $item) {
                return Project::create($item);
            });
    }
}
