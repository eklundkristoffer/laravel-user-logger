# laravel-user-logger

### Publish config

```shell
php artisan vendor:publish --tag="laravel-user-logger:config"
```

### Usage

```php
use App\User;
use \Facades\Eklundkristoffer\Logger\Logger;

Logger::watch(User::class);
```
