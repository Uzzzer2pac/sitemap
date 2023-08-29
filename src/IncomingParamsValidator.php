<?php

namespace Uzzzer2pac\Sitemap;

use Uzzzer2pac\Sitemap\Exceptions\InvalidArgumentExeption;
use Uzzzer2pac\Sitemap\Exceptions\InvalidDataException;
use Uzzzer2pac\Sitemap\Exceptions\InvalidFormatException;
use Uzzzer2pac\Sitemap\Exceptions\InvalidPathException;
use Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat;

class IncomingParamsValidator {

  protected string $path;
  protected string $format;

  public function __construct(string $path, string $format) {
    $this->format = $format;
    $this->path = $path;
  }

  public function validate(): void {
    $this->validateFormat();
    $this->validatePath();
    $this->validatePathAndFormat();
  }

  protected function validatePath(): void {
    if (!preg_match('/^\/([A-z0-9-_+]+\/)*([A-z0-9]+\.(' . $this->getSupportedFormats('|') . '))$/', $this->path)) {
      throw new InvalidPathException('Некорректный абсолютный путь выходного файла');
    }
  }

  protected function validateFormat(): void {
    if (!in_array($this->format, SitemapBaseFormat::SUPPORTED_FORMATS)) {
      throw new InvalidFormatException('Некорректный формат для сохранения, допустимые форматы: ' . $this->getSupportedFormats());
    }
  }

  protected function validatePathAndFormat(): void {
    if (!str_ends_with($this->path, $this->format)) {
      throw new InvalidArgumentExeption('Формат файла не соответствует расширению, допустимые форматы: ' . $this->getSupportedFormats());
    }
  }

  protected function getSupportedFormats(string $delimiter = ', '): string {
    return implode ($delimiter, SitemapBaseFormat::SUPPORTED_FORMATS);
  }
}