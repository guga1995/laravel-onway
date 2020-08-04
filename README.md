# ONWAY Integration for Laravel

[![Packagist](https://img.shields.io/packagist/v/zgabievi/laravel-onway.svg?v=2)](https://packagist.org/packages/zgabievi/laravel-onway)
[![Packagist](https://img.shields.io/packagist/dt/zgabievi/laravel-onway.svg?v=2)](https://packagist.org/packages/zgabievi/laravel-onway)
[![license](https://img.shields.io/github/license/zgabievi/laravel-onway.svg?v=2)](https://packagist.org/packages/zgabievi/laravel-onway)

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [License](#license)

## Installation

To get started, you need to install package:

```sh
composer require zgabievi/laravel-onway
```

If your laravel version is older than 5.5, then add this to your service providers in *config/app.php*:

```php
'providers' => [
    ...
    Zorb\Onway\OnwayServiceProvider::class,
    ...
];
```

You can publish config file using this command:

```sh
php artisan vendor:publish --provider="Zorb\Onway\OnwayServiceProvider"
```

This command will copy config file and create migrations for you. You should run `php artisan migrate` to get deliveries table.

## Usage

- [Delivery Initialization](#delivery-initialization)
- [Delivery Confirmation](#delivery-confirmation)
- [Additional Methods](#additional-methods)

### Delivery Initialization

```php
use Zorb\Onway\Enums\DeliveryZone;

public function __invoke(Onway $onway)
{
  $from_location = [
      'ContactName' => 'ჯონ დო',
      'CompanyName' => 'შპს აქმე',
      'AddressLine1' => 'რუსთაველის 52ა',
      'Email' => 'john.doe@email.com',
      'Phone' => '995511000000',
      'Zone' => [
          'ID' => DeliveryZone::Tbilisi
      ]
  ];

  $to_location = [
      'ContactName' => 'ჯეინ დო',
      'CompanyName' => '',
      'AddressLine1' => 'ცოტნე დადიანის 1ბ',
      'Email' => 'jane.doe@example.com',
      'Phone' => '995511000001',
      'City' => 'თბილისი'
  ];

  $weight = 1.5;
  $products = ['წიგნი', 'სახატავები', 'ქუდი'];

  $result = $onway->start($from_location, $to_location, $weight, $products); // order_id = 12345
}
```

Successful result will return order_id, otherwise OnwayRequestException will be thrown

### Delivery Confirmation

```php
  $response = $onway->confirm($result->order_id, '1'); // success = 1, TrackingNumber = 54321
```

Successful result will return TrackingNumber, otherwise OnwayRequestException will be thrown

### Additional Methods

```php
  $response = $onway->status($result->order_id, '1'); // success = 1, status = 1
```
Successful result will return status, otherwise OnwayRequestException will be thrown

#### Statuses can be:

1. Submitted
2. In Transit
3. Completed
4. Canceled
5. Canceled Billable

This statuses can be found in `Zorb\Onway\Enums\DeliveryStatus`;

## Configuration

You can configure environment file with following variables:

```
ONWAY_ID=YOUR_CUSTOMER_ID_HERE
ONWAY_DEBUG=true/false
```

## License

laravel-onway is licensed under a [MIT License](https://github.com/zgabievi/laravel-promocodes/blob/master/LICENSE).

