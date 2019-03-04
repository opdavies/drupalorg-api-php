<?php

namespace Opdavies\Drupalorg\Query;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Collection;
use Psr\Http\Message\ResponseInterface;

abstract class Query implements QueryInterface
{
    /**
     * The client.
     *
     * @var ClientInterface
     */
    protected $query;

    /**
     * The client response.
     *
     * @var ResponseInterface
     */
    protected $response;

    /**
     * The node data.
     *
     * @var Collection
     */
    protected $contents;

    /**
     * The URI to query.
     *
     * @var string
     */
    private $uri;

    /**
     * An array of options to add to the query.
     *
     * @var array
     */
    private $options = [];

    public function __construct(ClientInterface $client = null)
    {
        $this->query = $client ?? new Client([
          'base_uri' => 'https://www.drupal.org/api-d7/',
        ]);

        $this->uri = $this->setUri();
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setOptions(array $options): QueryInterface
    {
        $this->options = $options;

        return $this;
    }

    public function execute(): self
    {
        $this->response = $this->query->get($this->uri, $this->options);

        if ($this->response->getStatusCode() != 200) {
            throw new Exception();
        }

        $contents = $this->response
            ->getBody()
            ->getContents();

        $this->contents = collect(json_decode($contents))
            ->get('list');

        return $this;
    }

    public function getQuery(): ClientInterface
    {
        return $this->query;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getContents(): Collection
    {
        return collect($this->contents);
    }
}
