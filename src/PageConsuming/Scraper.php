<?php

declare(strict_types=1);

namespace WirelessLogic\PageConsuming;

interface Scraper
{
    public function scrape(string $url): array;
}
