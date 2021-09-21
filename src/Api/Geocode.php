<?php

namespace Jordy\Tomtom\Api;

use Jordy\Http\Client;
use Jordy\Http\ClientInterface;
use Jordy\Http\ResponseInterface;
use Jordy\Http\ResponseListInterface;
use Jordy\Tomtom\Response\GeocodeResponse;

/**
 * https://developer.tomtom.com/search-api/search-api-documentation-geocoding/geocode
 */
class Geocode extends TomtomEndpoint
{
    private $query;
    protected $uri = "https://api.tomtom.com/search/{VERSION}/geocode/{QUERY}.{EXTENSION}";

    /**
     * @param ClientInterface            $client
     * @param ResponseInterface|null     $response
     * @param ResponseListInterface|null $responseList
     */
    public function __construct(
        ClientInterface $client,
        ResponseInterface $response = null,
        ResponseListInterface $responseList = null
    ) {
        parent::__construct(
            $client,
            $response ?? new GeocodeResponse(),
            $responseList
        );
    }

    /**
     * @return ResponseListInterface
     */
    public function fetch()
    {
        return $this->transfer(Client::HTTP_GET)
            ->setResultMapping([
                "results"
            ]);
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->buildUri(parent::getUri(), [
            "{VERSION}" => $this->getVersion(),
            "{QUERY}" => $this->getQuery(),
            "{EXTENSION}" => $this->getExtension()
        ]);
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return urlencode($this->query);
    }

    /**
     * @param string $query
     *
     * @return $this
     */
    public function setQuery(string $query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Maximum number of search results that will be returned.
     *
     * @param int $limit
     *
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->queryParams['limit'] = $limit;

        return $this;
    }

    /**
     * Starting offset of the returned results within the full result set.
     *
     * @param int $offset
     *
     * @return $this
     */
    public function setOffset(int $offset)
    {
        $this->queryParams['ofs'] = $offset;

        return $this;
    }

    /**
     * Comma separated string of country codes. This will limit the search to
     * the specified countries.
     *
     * @param array $countrySet
     *
     * @return $this
     */
    public function setCountrySet(array $countrySet)
    {
        $this->queryParams['countrySet'] = implode(',', $countrySet);

        return $this;
    }
}
