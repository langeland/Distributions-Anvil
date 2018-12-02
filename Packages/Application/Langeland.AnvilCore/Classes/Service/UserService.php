<?php

namespace Langeland\AnvilCore\Service;

/*
 * This file is part of the Langeland.AnvilCore package.
 */

use Langeland\AnvilCore\Domain\Model\Unit;
use Langeland\AnvilCore\Domain\Model\User;
use Langeland\AnvilCore\Domain\Repository\UserRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\AccountFactory;

class UserService
{

    /**
     * @Flow\Inject
     * @var accountFactory
     */
    protected $accountFactory;

    /**
     * @Flow\Inject
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param string $userName
     * @param string $password
     * @param string|null $displayName
     * @param Unit|null $unit
     * @throws \Neos\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function createUserWithAccount(string $userName, string $password, Unit $unit = null, string $displayName = null)
    {
        $accountIdentifier = $unit->getCode() . '_' . $userName;
        $roles = array('Langeland.AnvilCore:User');
        $authenticationProviderName = 'DefaultProvider';
        $newAccount = $this->accountFactory->createAccountWithPassword($accountIdentifier, $password, $roles, $authenticationProviderName);

        $newUser = new User();
        $newUser
            ->setDisplayName($displayName ?? $userName)
            ->setUnit($unit)
            ->addAccount($newAccount);

        $this->userRepository->add($newUser);
    }
}