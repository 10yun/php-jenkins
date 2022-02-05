# App\DevOps\JenkinsAPI\Client\BaseApi

All URIs are relative to http://quantimodo2.asuscomm.com:8082.

Method | HTTP request | Description
------------- | ------------- | -------------
[**getCrumb()**](BaseApi.md#getCrumb) | **GET** /crumbIssuer/api/json | 


## `getCrumb()`

```php
getCrumb(): \App\DevOps\JenkinsAPI\Client\Model\DefaultCrumbIssuer
```



Retrieve CSRF protection token

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure HTTP basic authorization: jenkins_auth
$config = App\DevOps\JenkinsAPI\Client\Configuration::getDefaultConfiguration()
              ->setUsername('YOUR_USERNAME')
              ->setPassword('YOUR_PASSWORD');


$apiInstance = new App\DevOps\JenkinsAPI\Client\Api\BaseApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->getCrumb();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling BaseApi->getCrumb: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\App\DevOps\JenkinsAPI\Client\Model\DefaultCrumbIssuer**](../Model/DefaultCrumbIssuer.md)

### Authorization

[jenkins_auth](../../README.md#jenkins_auth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
