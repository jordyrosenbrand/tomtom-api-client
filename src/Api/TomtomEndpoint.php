<?php

namespace Jordy\Tomtom\Api;

use Jordy\Http\Api\AbstractEndpoint;
use Jordy\Http\ClientInterface;
use Jordy\Http\Parser\JsonParser;
use Jordy\Http\ResponseInterface;
use Jordy\Http\ResponseListInterface;

abstract class TomtomEndpoint extends AbstractEndpoint
{
    const EXT_JSON = "json";
    const EXT_XML = "xml";

    private $extension = self::EXT_JSON;

    private $allowedExtensions = [
        self::EXT_JSON => JsonParser::class,
    ];

    /**
     * TomtomEndpoint constructor.
     *
     * @param ClientInterface            $client
     * @param ResponseInterface|null     $response
     * @param ResponseListInterface|null $responseList
     */
    public function __construct(
        ClientInterface $client,
        ResponseInterface $response = null,
        ResponseListInterface $responseList = null
    ) {
        parent::__construct($client, $response, $responseList);

        $this->queryParams["key"] = $this->getApiKey();
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->client->getApiKey();
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->client->getVersion();
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param $extension
     *
     * @return AbstractEndpoint|TomtomEndpoint
     */
    public function setExtension($extension)
    {
        $static = $this;

        if(isset($this->allowedExtensions[$extension])) {
            $this->extension = $extension;
            $static = $this->withParser(
                new $this->allowedExtensions[$extension]()
            );
        }

        return $static;
    }

    /**
     * @param string $uri
     * @param array  $array
     *
     * @return string|string[]
     */
    public function buildUri(string $uri, array $array)
    {
        $searchArray = array_keys($array);
        $replaceArray = array_values($array);

        return str_replace(
            $searchArray, $replaceArray, $uri
        );
    }
}
