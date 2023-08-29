<?php

namespace Uzzzer2pac\Sitemap;

use Uzzzer2pac\Sitemap\Exceptions\InvalidDataException;
use Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat;

class IncomingDataValidator {

  protected array $data;

  public function __construct(array $data) {
    $this->data = $data;
  }

  public function validate(): void {
    $this->checkDataSize();

    foreach ($this->data as $dataItem) {
      $this->checkDataItemFormat($dataItem);
    }
  }

  protected function checkDataSize(): void {
    if (count($this->data) > SitemapBaseFormat::MAX_ITEMS_PER_FILE) {
      throw new InvalidDataException('Превышено количество элементов, лимит - ' . SitemapBaseFormat::MAX_ITEMS_PER_FILE);
    }
  }

  protected function checkDataItemFormat(mixed $dataItem): void {
    if (!is_array($dataItem) || empty($dataItem['loc']) || empty($dataItem['lastmod']) || empty($dataItem['priority']) || empty($dataItem['changefreq'])) {
      throw new InvalidDataException('Неправильный формат входных данных');
    }

    $this->checkIsValidLoc($dataItem['loc']);
    $this->checkIsValidLastMod($dataItem['lastmod']);
    $this->checkIsValidPriority($dataItem['priority']);
    $this->checkIsValidChangeFreq($dataItem['changefreq']);
  }

  protected function checkIsValidLoc(string $loc): void {
    if (filter_var($loc, FILTER_VALIDATE_URL) === FALSE) {
      throw new InvalidDataException('Параметр loc должен быть валидным URL');
    }
  }

  protected function checkIsValidLastMod(string $lastmod): void {
    if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $lastmod)) {
      throw new InvalidDataException('Параметр lastmod должен быть датой в формате YYYY-MM-DD');
    }
  }

  protected function checkIsValidPriority(string $priority): void {
    if (!preg_match('/^(1|0[.,]?[0-9]{0,2})/', $priority)) {
      throw new InvalidDataException('Параметр priority должен быть от 0 до 1');
    }
  }

  protected function checkIsValidChangeFreq(string $changeFreq): void {
    if (!in_array($changeFreq, SitemapBaseFormat::SUPPORTED_FREQ)) {
      throw new InvalidDataException('Некорректный формат changefreq, допустимые значения: ' . implode(', ', SitemapBaseFormat::SUPPORTED_FREQ));
    }
  }
}