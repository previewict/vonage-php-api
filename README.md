# vonage-php-api
Vonage Business Cloud Phone System Integration API in PHP. Integrate vonage cloud phone system with your PHP application, More ROI, Smart CRM, Grow Sales.

###Installation
**Install via Composer**

```bash
    sudo composer install
```

Copy/paste _config.sample_ & rename it to config.php with your Vonage Username & Password.

###Basic Usage
**To Make a Call**

```php
<?php
require "vendor/autoload.php";
require "config.php";

$vonage = new \Vonage\Vonage('vonageUsername', 'VonagePassword');
$params = array(
    'start' => date('Y-m-d\TH:i:sP')
);
var_dump($vonage->request('callhistory/{VonageExtensionNumber}', $params)); die();
```

See the result as PHP debug format.
