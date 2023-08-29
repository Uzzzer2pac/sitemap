<?php

namespace Uzzzer2pac\Sitemap\SitemapItem;

interface SitemapFormat {
  public function write(array $data, string $path): void;
}