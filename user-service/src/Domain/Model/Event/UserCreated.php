<?php

namespace User\Domain\Model\Event;

use User\Domain\Model\ValueObject\UserName;

readonly final class UserCreated implements DomainEvent
{
    /**
     * @param UserName $name
     */
    public function __construct(private readonly UserName $name)
    {
    }
}