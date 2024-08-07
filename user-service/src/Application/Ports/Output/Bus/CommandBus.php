<?php

namespace User\Application\Ports\Output\Bus;

use Common\Application\Handlers\Command\Port\Command;

interface CommandBus
{
    public function execute(Command $command): void;
}