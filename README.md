# Adobe Sign PHP

Unofficial PHP SDK for the [Adobe Sign REST API Version 5 Methods](https://secure.na1.adobesign.com/public/docs/restapi/v5)

https://acrobat.adobe.com/us/en/sign.html

[![Source Code](https://img.shields.io/badge/source-mettle/adobe--sign--php-blue.svg?style=flat-square)](https://github.com/mettle/adobe-sign-php)
[![Latest Version](https://img.shields.io/github/release/mettle/adobe-sign-php.svg?style=flat-square)](https://github.com/mettle/adobe-sign-php/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/mettle/adobe-sign-php/blob/master/LICENSE)
[![Build Status](https://img.shields.io/github/workflow/status/mettle/adobe-sign-php/CI?label=CI&logo=github&style=flat-square)](https://github.com/mettle/adobe-sign-php/actions?query=workflow%3ACI)

## Requirements

The following versions of PHP are supported:

* PHP 8.0
* PHP 7.4
* PHP 7.3

## Installation

To install, use composer:

```
composer require mettle/adobe-sign-php
```

## Documentation

https://secure.na1.adobesign.com/public/docs/restapi/v5

### Example Usage

```php
session_start();

$provider = new Mettle\OAuth2\Client\AdobeSign([
    'clientId'          => 'your_client_id',
    'clientSecret'      => 'your_client_secret',
    'redirectUri'       => 'your_callback',
    'scope'             => [
          'scope1:type',
          'scope2:type'
    ]
]);

$adobeSign = new AdobeSign($provider);

if (!isset($_GET['code'])) {
    $authorizationUrl = $adobeSign->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authorizationUrl);
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
} else {
    $accessToken = $adobeSign->getAccessToken($_GET['code']);
    $adobeSign->setAccessToken($accessToken->getToken());
    $adobeSign->createAgreement([
        'documentCreationInfo' => [
            'fileInfos'         => [
                'libraryDocumentId' => 'your_library_document_id'
            ],
            'name'              => 'My Document',
            'signatureType'     => 'ESIGN',
            'recipientSetInfos' => [
                'recipientSetMemberInfos' => [
                    'email' => 'test@gmail.com'
                ],
                'recipientSetRole'        => [
                    'SIGNER'
                ]
            ],
            'mergeFieldInfo'    => [
                [
                    'fieldName'    => 'Name',
                    'defaultValue' => 'John Doe'
                ]
            ],
            'signatureFlow'     => 'SENDER_SIGNATURE_NOT_REQUIRED'
        ]
    ]);
}
```

### Generate Multipart Stream for transient document upload

Thanks to @trip-somers for the [solution](https://github.com/kevinem/adobe-sign-php/issues/1).

```php
$file_path = '/path/to/local/document';

$file_stream = Psr7\FnStream::decorate(Psr7\stream_for(file_get_contents($file_path)), [
    'getMetadata' => function() use ($file_path) {
        return $file_path;
    }
]);

$multipart_stream   = new Psr7\MultipartStream([
    [
        'name'     => 'File',
        'contents' => $file_stream
    ]
]);

$transient_document = $adobeSign->uploadTransientDocument($multipart_stream);
```

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.