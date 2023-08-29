<?php

namespace Uzzzer2pac\Sitemap\SitemapItem;

use Uzzzer2pac\Sitemap\Exceptions\InvalidFormatException;
use Uzzzer2pac\Sitemap\SitemapItem\SitemapFormat;

class SitemapBaseFormat implements SitemapFormat {

  public const FORMAT_JSON = 'json';
  public const FORMAT_XML = 'xml';
  public const FORMAT_CSV = 'csv';
  public const SUPPORTED_FORMATS = [
    self::FORMAT_JSON,
    self::FORMAT_XML,
    self::FORMAT_CSV,
  ];

  public const CHANGE_FREQ_ALWAYS = 'always';
  public const CHANGE_FREQ_HOURLY = 'hourly';
  public const CHANGE_FREQ_DAILY = 'daily';
  public const CHANGE_FREQ_WEEKLY = 'weekly';
  public const CHANGE_FREQ_MONTHLY = 'monthly';
  public const CHANGE_FREQ_YEARLY = 'yearly';
  public const CHANGE_FREQ_NEVER = 'never';

  public const SUPPORTED_FREQ = [
    self::CHANGE_FREQ_ALWAYS,
    self::CHANGE_FREQ_HOURLY,
    self::CHANGE_FREQ_DAILY,
    self::CHANGE_FREQ_WEEKLY,
    self::CHANGE_FREQ_MONTHLY,
    self::CHANGE_FREQ_YEARLY,
    self::CHANGE_FREQ_NEVER,
  ];
  public const MAX_ITEMS_PER_FILE = 50000;

  protected SitemapFormat $targetClass;

  public function __construct(string $format) {
    $this->targetClass = match ($format) {
      self::FORMAT_JSON => new SitemapJsonFormat(),
      self::FORMAT_XML => new SitemapXmlFormat(),
      self::FORMAT_CSV => new SitemapCsvFormat(),
      default => throw new InvalidFormatException('Передан неизвестный формат выходного файла'),
    };
  }

  public function createFormattedData(array $data): string {
    return $this->targetClass->createFormattedData($data);
  }

  public function write(array $data, string $path): void {
    $this->targetClass->write($data, $path);
  }
}