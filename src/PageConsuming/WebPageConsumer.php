<?php

declare(strict_types=1);

namespace WirelessLogic\PageConsuming;

use WirelessLogic\Mediator;

abstract class WebPageConsumer
{
    protected Mediator $mediator;

    public function setMediator(Mediator $mediator)
    {
        $this->mediator = $mediator;
    }
}
