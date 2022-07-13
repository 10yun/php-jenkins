## 构建build 相关

[返回查看更多](../../README.md)

### 构建job
```php
// 简单构建
$res = $jenkins->buildJob('job-name');

// 参数化构建
$res = $jenkins->buildJob('job-name', [
    'var1' => 'val1',
    'var2' => 'val2',
    // ...
]);

// 也可以使用token构建
$res = $jenkins->buildJob('job-name', [], 'token');
$res = $jenkins->buildJob('job-name', [
    'var1' => 'val1',
    'var2' => 'val2',
    // ...
], 'token');
```