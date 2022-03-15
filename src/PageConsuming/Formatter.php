<?php

declare(strict_types=1);

namespace WirelessLogic\PageConsuming;

interface Formatter
{
    public function format(string $url): string;
}
