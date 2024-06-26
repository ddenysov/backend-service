<?php

namespace User\Infrastructure\Persistence\Memory;

use User\Application\Outbox\Outbox;
use User\Application\Outbox\OutboxStatus;
use User\Domain\Model\Event\DomainEvent;
use User\Infrastructure\Persistence\Memory\Data\OutboxDataset;

class OutboxRepository implements \User\Application\Outbox\OutboxRepository
{
    public function save(Outbox $outbox): void
    {
        OutboxDataset::$data[] = [
            'id'         => $outbox->id,
            'name'       => $outbox->name,
            'payload'    => $outbox->payload,
            'created_at' => $outbox->createdAt,
            'status'     => OutboxStatus::STARTED,
        ];
    }
}