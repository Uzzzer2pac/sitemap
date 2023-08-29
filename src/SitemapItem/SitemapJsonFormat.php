<?php

namespace Uzzzer2pac\Sitemap\SitemapItem;

use Uzzzer2pac\Sitemap\Exceptions\FIleSystemAccessException;
use Uzzzer2pac\Sitemap\Exceptions\InvalidDataException;
use Uzzzer2pac\Sitemap\SitemapItem\SitemapFormat;

class SitemapJsonFormat implements SitemapFormat {
  public function write(array $data, string $path): void {
    try {
      $json = json_encode($data, JSON_THROW_ON_ERROR + JSON_PRETTY_PRINT + JSON_UNESCAPED_SLASHES);
    } catch (\Throwable $e) {
      throw new InvalidDataException('Не удалось преобразовать входные данные в JSON, ошибка: ' . $e->getMessage());
    }

    if (!file_put_contents($path, $json)) {
      throw new FIleSystemAccessException('Не удалось записать данные JSON в файл');
    }
  }
}