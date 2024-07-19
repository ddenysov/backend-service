<?php

namespace Iam\Infrastructure\Persistence\Doctrine\WriteModel;

use Common\Domain\ValueObject\Exception\InvalidUuidException;
use Iam\Domain\Entity\User;
use Iam\Domain\Repository\Port\WriteModel\UserRepository as UserRepositoryPort;
use Iam\Infrastructure\Persistence\Doctrine\Entity;
use Iam\Infrastructure\Persistence\Doctrine\Repository;
use Symfony\Component\Uid\Uuid;

class UserRepository extends Repository implements UserRepositoryPort
{
    /**
     * @param User $user
     * @return void
     * @throws InvalidUuidException
     */
    public function save(User $user): void
    {
        $dUser = new Entity\User();
        $dUser->setId(Uuid::fromString($user->getId()->toString()));
        $dUser->setEmail($user->getEmail()->toString());
        $dUser->setPassword($user->getPassword()->toString());
        $this->getEntityManager()->persist($dUser);
        $this->getEntityManager()->flush();
    }
}