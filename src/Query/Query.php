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

    /**
     * AbstractQuery constructor.
     */
    public function __construct()
    {
        $this->query = new Client([
          'base_uri' => 'https://www.drupal.org/api-d7/',
        ]);

        $this->uri = $this->setUri();
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Execute the query.
     *
     * @throws Exception
     * @return $this
     */
    public function execute()
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

    /**
     * @return Client
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return Collection
     */
    public function getContents()
    {
        return collect($this->contents);
    }
}
