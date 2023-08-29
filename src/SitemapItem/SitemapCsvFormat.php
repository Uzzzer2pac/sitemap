<?php

namespace Uzzzer2pac\Sitemap\SitemapItem;

use Uzzzer2pac\Sitemap\Exceptions\FIleSystemAccessException;

class SitemapCsvFormat implements SitemapFormat {

  protected const COLUMNS = [
    'loc',
    'lastmod',
    'priority',
    'changefreq',
  ];

  protected const DEFAULT_DELIMITER = ';';

  public function write(array $data, string $path): void {
    $fp = fopen($path, 'w');

    if (!$fp) {
      throw new FIleSystemAccessException('Не удалось открыть файл для записи');
    }

    if (!fputcsv($fp, array_keys($data[0]))) {
      throw new FIleSystemAccessException('Не удалось записать заголовок CSV в файл');
    }

    foreach ($data as $row) {
      fputcsv($fp, $row, self::DEFAULT_DELIMITER);
    }

    if (!fclose($fp)) {
      throw new FIleSystemAccessException('Не удалось закрыть файл');
    }
  }
}