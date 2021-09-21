<?php

namespace Jordy\Tomtom\Api;

use Jordy\Http\Client;
use Jordy\Http\ClientInterface;
use Jordy\Http\ResponseInterface;
use Jordy\Http\ResponseListInterface;
use Jordy\Tomtom\Response\GeocodeResponse;

/**
 * https://developer.tomtom.com/search-api/search-api-documentation-geocoding/structured-geocode
 */
class StructuredGeocode extends TomtomEndpoint
{
    protected $uri = "https://api.tomtom.com/search/{VERSION}/structuredGeocode.{EXTENSION}";

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

        $this->setCountryCode("NL");
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
            "{EXTENSION}" => $this->getExtension()
        ]);
    }

    /**
     * @param string $countryCode
     *
     * @return $this
     */
    public function setCountryCode(string $countryCode)
    {
        $this->queryParams["countryCode"] = $countryCode;

        return $this;
    }

    /**
     * @param int $limit
     *
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->queryParams["limit"] = $limit;

        return $this;
    }

    /**
     * @param int $offset
     *
     * @return $this
     */
    public function setOffset(int $offset)
    {
        $this->queryParams["ofs"] = $offset;

        return $this;
    }

    /**
     * @param string $streetNumber
     */
    public function setStreetNumber(string $streetNumber)
    {
        $this->queryParams["streetNumber"] = $streetNumber;

        return $this;
    }

    /**
     * @param string $houseNumber
     */
    public function setHouseNumber(string $houseNumber)
    {
        return $this->setStreetNumber($houseNumber);
    }

    /**
     * @param string $streetName
     *
     * @return $this
     */
    public function setStreetName(string $streetName)
    {
        $this->queryParams["streetName"] = $streetName;

        return $this;
    }

    /**
     * @param string $crossStreet
     *
     * @return $this
     */
    public function setCrossStreet(string $crossStreet)
    {
        $this->queryParams["crossStreet"] = $crossStreet;

        return $this;
    }

    /**
     * @param string $postalCode
     *
     * @return $this
     */
    public function setPostalCode(string $postalCode)
    {
        $this->queryParams["postalCode"] = $postalCode;

        return $this;
    }

    /**
     * @param string $municipality
     *
     * @return $this
     */
    public function setMunicipality(string $municipality)
    {
        $this->queryParams["municipality"] = $municipality;

        return $this;
    }

    /**
     * @param string $municipalitySubdivision
     *
     * @return $this
     */
    public function setMunicipalitySubdivision(string $municipalitySubdivision)
    {
        $this->queryParams["municipalitySubdivision"] = $municipalitySubdivision;

        return $this;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity(string $city)
    {
        return $this->setMunicipalitySubdivision($city);
    }

    /**
     * @param string $countryTertiarySubdivision
     *
     * @return $this
     */
    public function setCountryTertiarySubdivision(
        string $countryTertiarySubdivision
    ) {
        $this->queryParams["countryTertiarySubdivision"] = $countryTertiarySubdivision;

        return $this;
    }

    /**
     * @param string $countrySecondarySubdivision
     *
     * @return $this
     */
    public function setCountrySecondarySubdivision(
        string $countrySecondarySubdivision
    ) {
        $this->queryParams["countrySecondarySubdivision"] = $countrySecondarySubdivision;

        return $this;
    }

    /**
     * @param string $countrySubdivision
     *
     * @return $this
     */
    public function setCountrySubdivision(string $countrySubdivision)
    {
        $this->queryParams["countrySubdivision"] = $countrySubdivision;

        return $this;
    }

    /**
     * @param string $language
     *
     * @return $this
     */
    public function setLanguage(string $language)
    {
        $this->queryParams["language"] = $language;

        return $this;
    }

    /**
     * https://developer.tomtom.com/search-api/search-api-documentation/abbreviated-values-index
     *
     * @param array $extendedPostalCodesFor
     *
     * @return $this
     */
    public function setExtendedPostalCodesFor(array $extendedPostalCodesFor)
    {
        $this->queryParams["extendedPostalCodesFor"] = implode(
            ",",
            $extendedPostalCodesFor
        );

        return $this;
    }

    /**
     * https://developer.tomtom.com/search-api/search-api-documentation-geocoding/structured-geocode#defaultViewMapping
     *
     * @param string $view
     *
     * @return $this
     */
    public function setView(string $view)
    {
        $this->queryParams["view"] = $view;

        return $this;
    }

    /**
     * https://developer.tomtom.com/search-api/search-api-documentation-geocoding/structured-geocode
     *
     * @param array $entityTypeSet
     *
     * @return $this
     */
    public function setEntityTypeSet(array $entityTypeSet)
    {
        $this->queryParams["entityTypeSet"] = implode(
            ",",
            $entityTypeSet
        );

        return $this;
    }
}
