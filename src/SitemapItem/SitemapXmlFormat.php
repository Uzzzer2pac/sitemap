<?php

namespace Uzzzer2pac\Sitemap\SitemapItem;

use XMLWriter;

class SitemapXmlFormat implements SitemapFormat {

  protected XMLWriter $xmlWriter;
  protected const SCHEMA = 'http://www.sitemaps.org/schemas/sitemap/0.9';
  protected const XMLNS_XSI = 'http://www.w3.org/2001/XMLSchema-instance';

  public function write(array $data, string $path): void {
    $this->xmlWriter = new XMLWriter();
    $this->xmlWriter->openURI($path);
    $this->xmlWriter->startDocument('1.0', 'UTF-8');
    $this->xmlWriter->setIndent(TRUE);

    $this->xmlWriter->startElement('urlset');
    $this->xmlWriter->writeAttribute('xmlns:xsi', self::XMLNS_XSI);
    $this->xmlWriter->writeAttribute('xmlns', self::SCHEMA);
    $this->xmlWriter->writeAttribute('xsi:schemaLocation', self::SCHEMA . ' ' . self::SCHEMA . '/sitemap.xsd');

    foreach ($data as $item) {
      $this->xmlWriter->startElement('url');
      $this->xmlWriter->writeElement('loc', $item['loc']);
      $this->xmlWriter->writeElement('priority', $item['priority']);
      $this->xmlWriter->writeElement('changefreq', $item['changefreq']);
      $this->xmlWriter->writeElement('lastmod', $item['lastmod']);
      $this->xmlWriter->endElement();
    }

    $this->xmlWriter->endElement();
    $this->xmlWriter->endDocument();
  }
}