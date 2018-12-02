<?php

namespace Langeland\AnvilCore\Domain\Model;

/*
 * This file is part of the Langeland.AnvilCore package.
 */

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Security\Account;


/**
 * @Flow\Entity
 */
class User
{

    /**
     * @var string
     *
     * @Flow\Identity
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $displayName;

    /**
     * @var Unit
     * @ORM\ManyToOne()
     */
    protected $unit;

    /**
     * A unidirectional OneToMany association (done with ManyToMany and a unique constraint) to accounts. This is
     * required to not have any dependencies from Account to AbstractParty (the other way round).
     *
     * @var Collection<\Neos\Flow\Security\Account>
     * @ORM\ManyToMany(cascade={"persist", "remove"})
     * @ORM\JoinTable(inverseJoinColumns={@ORM\JoinColumn(unique=true, onDelete="CASCADE")})
     */
    protected $accounts;

    /**
     * @var Collection<\Langeland\AnvilCore\Domain\Model\Badge>
     * @ORM\OneToMany(cascade={"persist", "remove"}, mappedBy="user")
     */
    protected $badges;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->accounts = new ArrayCollection();
        $this->badges = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     * @return User
     */
    public function setDisplayName(string $displayName): User
    {
        $this->displayName = $displayName;
        return $this;
    }

    /**
     * @return Unit
     */
    public function getUnit(): Unit
    {
        return $this->unit;
    }

    /**
     * @param Unit $unit
     * @return User
     */
    public function setUnit(Unit $unit): User
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * Returns the accounts of this party
     *
     * @return Collection<Account>|Account[] All assigned Neos\Flow\Security\Account objects
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Assigns the given account to this party.
     *
     * @param Account $account The account
     * @return void
     */
    public function addAccount(Account $account)
    {
        $this->accounts->add($account);
    }

    /**
     * Remove an account from this party
     *
     * @param Account $account The account to remove
     * @return void
     */
    public function removeAccount(Account $account)
    {
        $this->accounts->removeElement($account);
    }

    /**
     * @return Collection
     */
    public function getBadges(): Collection
    {
        return $this->badges;
    }

    /**
     * @param Collection $badges
     * @return User
     */
    public function setBadges(Collection $badges): User
    {
        $this->badges = $badges;
        return $this;
    }

}
