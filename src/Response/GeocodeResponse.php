<?php

namespace Jordy\Tomtom\Response;

use Jordy\Http\Response;

class GeocodeResponse extends Response
{
    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->extractFromBody(["type"]);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->extractFromBody(["id"]);
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->extractFromBody(["score"]);
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->extractFromBody([
            "address",
            "streetName"
        ]);
    }

    /**
     * @return mixed
     */
    public function getHouseNumber()
    {
        return $this->extractFromBody([
            "address",
            "streetNumber"
        ]);
    }

    /**
     * @return mixed
     */
    public function getPostalCodeBase()
    {
        return $this->extractFromBody([
            "address",
            "postalCode"
        ]);
    }

    /**
     * @param bool $stripSpaces
     *
     * @return mixed|string|string[]|null
     */
    public function getPostalCode($stripSpaces = true)
    {
        return str_replace(" ", "", $this->extractValue([
            "address",
            "extendedPostalCode"
        ]));
    }

    /**
     * @return mixed|null
     */
    public function getCity()
    {
        return $this->extractFromBody([
            "address",
            "localName"
        ]);
    }

    /**
     * @return mixed|null
     */
    public function getMunicipality()
    {
        return $this->extractValue([
            "address",
            "municipality"
        ]);
    }

    /**
     * @return mixed|null
     */
    public function getMunicipalitySubdivision()
    {
        return $this->extractValue([
            "address",
            "municipalitySubdivision"
        ]);
    }

    /**
     * @return mixed
     */
    public function getCountrySubdivision()
    {
        return $this->extractFromBody([
            "address",
            "countrySubdivision"
        ]);
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->extractFromBody([
            "address",
            "country"
        ]);
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->extractFromBody([
            "address",
            "countryCode"
        ]);
    }

    /**
     * @return mixed
     */
    public function getCountryCodeISO3()
    {
        return $this->extractFromBody([
            "address",
            "countryCodeISO3"
        ]);
    }

    /**
     * @return mixed
     */
    public function getAddressString()
    {
        return $this->extractFromBody([
            "address",
            "freeformAddress"
        ]);
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->extractFromBody([
            "position",
            "lat"
        ]);
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->extractFromBody([
            "position",
            "lon"
        ]);
    }
}
