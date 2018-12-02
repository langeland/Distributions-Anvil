<?php

namespace Langeland\AnvilCore\Domain\Repository;

/*
 * This file is part of the Langeland.AnvilCore package.
 */

use Langeland\AnvilCore\Domain\Model\User;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Neos\Flow\Security\Account;
use Neos\Flow\Security\Context;

/**
 * @Flow\Scope("singleton")
 */
class UserRepository extends Repository
{

    /**
     * @Flow\Inject
     * @var Context
     */
    protected $securityContext;

    /**
     * Finds a Party instance, if any, which has the given Account attached.
     *
     * @param Account $account
     * @return User
     * @throws \Neos\Flow\Persistence\Exception\InvalidQueryException
     */
    public function findOneHavingAccount(Account $account)
    {
        $query = $this->createQuery();

        return $query
            ->matching(
                $query->contains(
                    'accounts',
                    $account
                )
            )
            ->execute()
            ->getFirst();
    }

    /**
     * Finds a Party instance, if any, which has the given Account attached.
     *
     * @return User
     * @throws \Neos\Flow\Persistence\Exception\InvalidQueryException
     */
    public function findOneActive()
    {
        $account = $this->securityContext->getAccount();
        $query = $this->createQuery();

        return $query->matching($query->contains('accounts', $account))->execute()->getFirst();
    }


}
