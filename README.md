# ISPConfig 3 REST API PHP Client

## Introduction

A simple REST API PHP Client for ispconfig3 remote API.

## Requirements

* PHP >= 5.4.0 (with [json](https://www.php.net/manual/en/json.installation.php) support)

## Getting started

### Composer

```bash
$ composer require freshost/ispconfig-restapi
```

## Usage

The package can be included & used on any PHP application.

## Examples

``` php
$call = new ISPconfigAPI(['user' => 'remote_user', 'pass' => 'changeme', 'url' => 'https://ispconfig.local:8080']);

$client = $call->call("client_get", ["client_id" => 1]);

print_r($client);
```

You can allow the self signed certificate by set verifySSL variable.

``` php
$call = new ISPconfigAPI(['user' => 'remote_user', 'pass' => 'changeme', 'url' => 'https://ispconfig.local:8080', 'verifySSL' => false]);
```

## Feedback and questions

Found a bug or missing a feature? Don't hesitate to create a new issue here on GitHub.