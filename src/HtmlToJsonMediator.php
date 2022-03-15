<?php

declare(strict_types=1);

namespace WirelessLogic;

use WirelessLogic\PageConsuming\HtmlScraper;
use WirelessLogic\PageConsuming\JsonFormatter;
use WirelessLogic\PageConsuming\PageDownloader;

class HtmlToJsonMediator implements Mediator
{
    public function __construct(
        private HtmlScraper $scraper,
        private JsonFormatter $formatter,
        private PageDownloader $downloader,
    ){
        $this->scraper->setMediator($this);
        $this->formatter->setMediator($this);
        $this->downloader->setMediator($this);
    }

    public function getJsonData(string $url): string
    {
        return $this->formatter->format($url);
    }

    public function scrapeHtml(string $url): array
    {
        return $this->scraper->scrape($url);
    }

    public function fetchPage(string $url): string
    {
        return $this->downloader->download($url);
    }
}
