<?php

namespace Uzzzer2pac\Sitemap;

use Uzzzer2pac\Sitemap\SitemapItem\SitemapBaseFormat;

class SitemapGenerator {

  protected array $data;
  protected string $path;
  protected string $format;

  public function __construct(array $data, string $path, string $format) {
    (new IncomingParamsValidator($path, $format))->validate();
    (new IncomingDataValidator($data))->validate();

    $this->data = $data;
    $this->format = $format;
    $this->path = $path;
  }

  public function createSitemap(): void {
    (new SitemapBaseFormat($this->format))->write($this->data, $this->path);
  }
}