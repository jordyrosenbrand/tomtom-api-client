<?php

namespace Jordy\Tomtom;

use Jordy\Http\Client;
use Jordy\Tomtom\Api\Geocode;
use Jordy\Tomtom\Api\GeocodeEndpoint;
use Jordy\Tomtom\Api\StructuredGeocode;

class Tomtom extends Client
{
    private $apikey;
    private $version;

    private $geocode;
    private $structuredGeocode;

    /**
     * Tomtom constructor.
     *
     * @param string $apiKey
     * @param int    $version
     */
    public function __construct(string $apiKey, $version = 2)
    {
        parent::__construct();

        $this->apikey = $apiKey;
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apikey;
    }

    /**
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return Geocode
     */
    public function geocode()
    {
        if (! $this->geocode) {
            $this->geocode = new Geocode($this);
        }

        return $this->geocode;
    }

    /**
     * @return StructuredGeocode
     */
    public function structuredGeocode()
    {
        if (! $this->structuredGeocode) {
            $this->structuredGeocode = new StructuredGeocode($this);
        }

        return $this->structuredGeocode;
    }
}
