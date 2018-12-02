<?php

namespace Langeland\AnvilCore\Domain\Model;

/*
 * This file is part of the Langeland.AnvilCore package.
 */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Badge
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
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $modifiedAt;

    /**
     * @var User
     * @ORM\ManyToOne(inversedBy="badges")
     */
    protected $user;

    /**
     * @var \DateTime
     */
    protected $startedAt;

    /**
     * @var int
     */
    protected $addedDays = 0;

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     * @return Badge
     */
    public function setIdentifier(string $identifier): Badge
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Badge
     */
    public function setCreatedAt(\DateTime $createdAt): Badge
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getModifiedAt(): \DateTime
    {
        return $this->modifiedAt;
    }

    /**
     * @param \DateTime $modifiedAt
     * @return Badge
     */
    public function setModifiedAt(\DateTime $modifiedAt): Badge
    {
        $this->modifiedAt = $modifiedAt;
        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Badge
     */
    public function setUser(User $user): Badge
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartedAt(): \DateTime
    {
        return $this->startedAt;
    }

    /**
     * @param \DateTime $startedAt
     * @return Badge
     */
    public function setStartedAt(\DateTime $startedAt): Badge
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getAddedDays(): int
    {
        return $this->addedDays;
    }

    /**
     * @param int $addedDays
     * @return Badge
     */
    public function setAddedDays(int $addedDays): Badge
    {
        $this->addedDays = $addedDays;
        return $this;
    }

    public function getDaysRemaining(): int
    {

        $r = 365 - $this->getDaysElapsed() + $this->getAddedDays();
        return $r;
    }

    public function getDaysElapsed(): int
    {
        $now = new \DateTime();
        $diff = $now->diff($this->getStartedAt());
        return $diff->format("%a");
    }

}
