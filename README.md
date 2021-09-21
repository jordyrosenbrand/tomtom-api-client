# TomTom PHP Api Client

## Installation
```
composer require jordyrosenbrand/tomtom-api-client
```

## Usage
#### Geocode
```php
use Jordy\Tomtom\Tomtom;

$tomtom = new Tomtom("apikey");
$response = $tomtom->geocode()
    ->setQuery("5171KW 1")
    ->setCountrySet(["NL"])
    ->setLimit(1)
    ->fetch()
    ->first();

$address = $response->getAddressString(); // Europalaan 1, 5171 KW Kaatsheuvel
$lat = $response->getLat(); // 51.64921
$lng = $response->getLng(); //5.04381
```
#### Structured Geocode
```php
use Jordy\Tomtom\Tomtom;

$tomtom = new Tomtom("apikey");
$response = $tomtom->structuredGeocode()
    ->setPostalCode("5171KW")
    ->setHouseNumber(1)
    ->setCountryCode("NL")
    ->setLimit(1)
    ->fetch()
    ->first();
```

#### XML
```php
use Jordy\Tomtom\Tomtom;

$tomtom = new Tomtom("apikey");
$response = $tomtom->structuredGeocode()
    ->setExtension($tomtom->structuredGeocode()::EXT_XML);
```
