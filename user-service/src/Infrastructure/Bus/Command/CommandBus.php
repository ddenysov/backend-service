<?php

namespace User\Infrastructure\Bus\Command;

use Common\Application\Handlers\Command\Port\Command;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus implements \User\Application\Ports\Output\Bus\CommandBus
{
    /**
     * @param MessageBusInterface $bus
     */
    public function __construct(private MessageBusInterface $bus)
    {
    }

    /**
     * @param Command $command
     * @return void
     * @throws ExceptionInterface
     * @TODO Add exception handling
     */
    public function execute(Command $command): void
    {
        $this->bus->dispatch($command);
    }
}