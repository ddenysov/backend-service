<?php

namespace Common\Domain\Entity\Port\Primary;

use Common\Domain\ValueObject\Uuid;

interface Entity
{
    public function toArray(): array;

    /**
     * @return Uuid
     */
    public function getId();
}