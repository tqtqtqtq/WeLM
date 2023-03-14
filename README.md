# WeLM API Http Client (non-official) in PHP

A fully open-source third-partied (non-official) PHP SDK for accessing the WeLM API.

## Installation

To install the package, simply run the following command:

```bash
composer require tqtqtqtq/welm
```

## Usage

Create your sampling `index.php` file with following codes:

```php
<?php
require __DIR__ . '/vendor/autoload.php'; 
use tqtqtqtq\WeLM\WeLM;

$welm_api_key = getenv('YOUR_WELM_API_KEY_IN_ENVIRONMENT_VARS');
$welm = new WeLM($welm_api_key);

$completions = $welm->completion([
   'model' => 'xl',
   'prompt' => '测试',
   'temperature' => 0.95,
   'max_tokens' => 512,
]);

var_dump($completions);
```


## Contributing

Contributions not available yet... 

## Credits

- [WeLM](https://welm.weixin.qq.com/docs/)

## License

This package is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.