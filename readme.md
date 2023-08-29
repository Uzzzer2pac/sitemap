# Библиотека генерации sitemap  в форматах xml,csv,json

## Установка

Библиотека использует PHP 8.0+, имеет зависимость ext-xmlwriter.

Установка.

```sh
composer require uzzzer2pac/sitemap
```

Для работы необходимо подключить автозагрузчик классов

```php
<?php
require('./vendor/autoload.php');

use Uzzzer2pac\Sitemap\SitemapGenerator;

try {
  (new SitemapGenerator($data, $path, $format))->createSitemap();
} catch (\Throwable $e) {
  print($e->getMessage());
}
```
### $data
```php
[
    [
        'loc' => 'http://avito.ru',
        'lastmod' => '2020-12-14',
        'priority' => '1',
        'changefreq' => 'hourly',
    ],
    [
        'loc' => 'http://avito.ru/b',
        'lastmod' => '2020-12-15',
        'priority' => '1',
        'changefreq' => 'hourly',
    ],
    [
        'loc' => 'http://avito.ru/a',
        'lastmod' => '2020-12-11',
        'priority' => '1',
        'changefreq' => 'hourly',
    ],
];
```
Максимальное количество элементов в массиве 50 000

```php
[
        'loc' => Валидный URL,
        'lastmod' => DDDD-M-Y,
        'priority' => 0 - 1,
        'changefreq' => always|hourly|daily|weekly|monthly|yearly|never,
    ],
```

Для параметра changefreq определены константы:

```php
Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat::CHANGE_FREQ_ALWAYS,
Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat::CHANGE_FREQ_HOURLY,
Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat::CHANGE_FREQ_DAILY,
Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat::CHANGE_FREQ_WEEKLY,
Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat::CHANGE_FREQ_MONTHLY,
Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat::CHANGE_FREQ_YEARLY,
Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat::CHANGE_FREQ_NEVER,
```

### $path
```php
/absolute/path/to/file.extension
```
Расширение выходного файла должно совпадать с форматом формируемого файла

### $format
```php
Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat::FORMAT_JSON,
Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat::FORMAT_XML,
Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat::FORMAT_CSV,
```

**MIT Licnce**
