<?php

declare(strict_types=1);

namespace WirelessLogic\PageConsuming;

class JsonFormatter extends WebPageConsumer implements Formatter
{
    public function format(string $url): string
    {
        $arrayData = $this->mediator->scrapeHtml($url);

        return json_encode($arrayData, JSON_PRETTY_PRINT);
    }
}
