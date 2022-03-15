<?php

declare(strict_types=1);

namespace WirelessLogic;

interface Mediator
{
    public function scrapeHtml(string $url): array;
}
