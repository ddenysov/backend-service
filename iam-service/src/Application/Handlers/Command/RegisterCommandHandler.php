<?php

namespace Iam\Application\Handlers\Command;

use Common\Application\Container\Port\ServiceContainer;
use Common\Application\Handlers\Command\Attributes\Transaction;
use Common\Application\Handlers\Command\CommandHandler;
use Common\Domain\ValueObject\Exception\InvalidUuidException;
use Common\Domain\ValueObject\Exception\String\InvalidStringLengthException;
use Iam\Domain\Entity\User;
use Iam\Domain\Repository\Port\ReadModel\UserRepository as ReadUserRepository;
use Iam\Domain\Repository\Port\UserRepositoryPersistence;
use Iam\Domain\Repository\Port\WriteModel\UserRepository as WriteUserRepository;
use Iam\Domain\ValueObject\UserEmail;
use Iam\Domain\ValueObject\UserPassword;
use Psr\Log\LoggerInterface;

final class RegisterCommandHandler extends CommandHandler
{
    /**
     * @param ServiceContainer $container
     * @param LoggerInterface $logger
     * @param ReadUserRepository $readUserRepository
     * @param UserRepositoryPersistence $userRepositoryPersistence
     */
    public function __construct(
        ServiceContainer                  $container,
        LoggerInterface                   $logger,
        private ReadUserRepository        $readUserRepository,
        private UserRepositoryPersistence $userRepositoryPersistence,
    )
    {
        parent::__construct($container, $logger);
    }

    /**
     * Start Transaction
     * Business logic
     * Save Aggregate to Event Store
     * Save event to outbox
     * Commit
     *
     * @param RegisterCommand $command
     * @throws InvalidStringLengthException
     * @throws InvalidUuidException
     */
    #[Transaction]
    protected function handle(RegisterCommand $command): void
    {
        /**
         * $emailRegistered = $this->readUserRepository->isEmailTaken(new UserEmail($command->email));
         *
         * if ($emailRegistered) {
         * $user = $this->readUserRepository->findOneByEmail(new UserEmail($command->email));
         * $user->requestResetPassword();
         * } else {
         * $user = User::register(
         * email: new UserEmail($command->email),
         * password: new UserPassword($command->password)
         * );
         * }
         */
        $user = User::register(
            email: new UserEmail($command->email),
            password: new UserPassword($command->password)
        );
        $this->userRepositoryPersistence->save($user);
    }
}