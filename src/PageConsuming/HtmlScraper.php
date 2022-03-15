<?php

declare(strict_types=1);

namespace WirelessLogic\PageConsuming;

use Symfony\Component\DomCrawler\Crawler;

class HtmlScraper extends WebPageConsumer implements Scraper
{
    public function __construct(private Crawler $crawler)
    {}

    public function scrape(string $url): array
    {

        $html = $this->mediator->fetchPage($url);

        
        

        return [
            [
                "title" => "Standard: 1GB Data - 12 Months",
                "description" => "The standard subscription providing you with enough service time to support the average user to enable your device to be up and running with inclusive Data and SMS services.",
                "price" => "£9.99 (inc. VAT) Per Month",
                "discount" => null
            ], [
                "title" => "Standard: 12GB Data - 1 Year",
                "description" => "The standard subscription providing you with enough service time to support the average user with Data and SMS services to allow access to your device.",
                "price" => "£108.00 (inc. VAT) Per Year",
                "discount" => "£11.90/month"
            ]
        ];
    }
}
