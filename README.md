# 接入其他国密密码机

### 1.配置 `config/sm_cryptor.php`

```php

return [
    // local / telecom / unicom / other
    'driver' => env('SM_CRYPTOR_DRIVER', 'local'),

    // ...

    // 其他密码机
    'other' => [
        'host' => env('OTHER_CRYPTOR_HOST'),
    ],
];

```

### 2.配置 `.env`

```dotenv
SM_CRYPTOR_DRIVER=other
OTHER_CRYPTOR_HOST=http://127.0.0.1:8080

```

