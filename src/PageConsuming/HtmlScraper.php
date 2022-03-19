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

        

        $this->crawler->addContent($html);


        // var_dump($this->crawler->filter('div.pricing-table div.row-subscriptions div.col-xs-4 h3:first-child')->text());

        // $titles = $this->crawler->filter('
        //     div.pricing-table div.row-subscriptions div.col-xs-4 h3:first-child, div.pricing-table div.row-subscriptions div.col-cs-4 h3:first-child
        // ');

        // $descriptions = $this->crawler->filter('
        //     div.pricing-table div.row-subscriptions div.package-features div.package-description
        // ');

        $data = [];

        


        $this->crawler->filter('div.pricing-table div.row-subscriptions')
            ->each(function (Crawler $parentCrawler) use (&$data) {

            $firstAvailableIndex = $i = array_key_last($data) ? array_key_last($data) + 1 : 0;

            // Title
            $parentCrawler->filter('
                h3:first-child, div.pricing-table div.row-subscriptions div.col-cs-4 h3:first-child
            ')->each(function (Crawler $localCrawler) use (&$data, &$i) {
                $data[$i++]['title'] = $localCrawler->text();
            });

            // Reset index
            $i = $firstAvailableIndex;

            // Description
            $parentCrawler->filter('
                div.package-features div.package-description
            ')->each(function (Crawler $localCrawler) use (&$data, &$i) {
                $data[$i++]['description'] = $localCrawler->text();
            });

            $i = $firstAvailableIndex;

            // Price
            $parentCrawler->filter('
                div.package-features div.package-price span.price-big
            ')->each(function (Crawler $localCrawler) use (&$data, &$i) {
                $data[$i++]['price'] = $localCrawler->text();
            });

            $i = $firstAvailableIndex;

            // Discount
            $parentCrawler->filter('
                div.package-features div.package-price p:first-of-type
            ')->each(function (Crawler $localCrawler) use (&$data, &$i) {
                $data[$i++]['discount'] = $localCrawler->text();
            });
        });

        return $data;

        // $prices = $this->crawler->filter('
        //     div.pricing-table div.row-subscriptions div.package-features div.package-price span.price-big
        // ');

        // foreach ($prices as $price) {
        //     var_dump($price);
        // }

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
