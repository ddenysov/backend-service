<?php

namespace Common\Application\Handlers\Command\Port;
interface Command
{
    /**
     * @return array
     */
    public function toArray(): array;
}