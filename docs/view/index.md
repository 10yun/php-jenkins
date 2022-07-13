## 视图view相关

[返回查看更多](../../README.md)

#### 获取视图的作业
-----------------------------

```php
$view = $jenkins->getView('madb_deploy');
foreach ($view->getJobs() as $job) {
    var_dump($job->getName());
}
//string(13) "altlinux-pull"
//string(8) "dev-pull"
//string(9) "dev2-pull"
//string(11) "fedora-pull"
```
