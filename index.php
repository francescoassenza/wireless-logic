<?php

declare(strict_types=1);

use WirelessLogic\HtmlToJsonMediator;
use WirelessLogic\PageConsuming\HtmlScraper;
use WirelessLogic\PageConsuming\JsonFormatter;
use WirelessLogic\PageConsuming\PageDownloader;
use Symfony\Component\DomCrawler\Crawler;

require_once __DIR__.'/vendor/autoload.php';

$mediator = new HtmlToJsonMediator(
	new HtmlScraper(new Crawler()),
	new JsonFormatter(),
	new PageDownloader(),
);

echo $mediator->getJsonData('https://wltest.dns-systems.net/');