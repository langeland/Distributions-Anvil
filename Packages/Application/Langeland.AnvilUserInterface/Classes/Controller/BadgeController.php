<?php

namespace Langeland\AnvilUserInterface\Controller;

/*
 * This file is part of the Langeland.AnvilUserInterface package.
 */

use Langeland\AnvilCore\Domain\Model\Badge;
use Langeland\AnvilCore\Domain\Repository\BadgeRepository;
use Langeland\AnvilCore\Domain\Repository\UserRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class BadgeController extends AbstractAnvilController
{

    /**
     * @Flow\Inject
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @Flow\Inject
     * @var BadgeRepository
     */
    protected $badgeRepository;

    /**
     * @return void
     * @throws \Neos\Flow\Mvc\Exception\StopActionException
     * @throws \Neos\Flow\Persistence\Exception\InvalidQueryException
     */
    public function indexAction()
    {
        $user = $this->userRepository->findOneActive();

        if ($user->getBadges()->isEmpty()) {
            $this->redirect('new', 'Badge');
        } else {
            $this->redirect('show', 'Badge');
        }
    }


    /**
     * @param Badge|null $badge
     * @return void
     * @throws \Neos\Flow\Persistence\Exception\InvalidQueryException
     */
    public function showAction(Badge $badge = null)
    {
        $user = $this->userRepository->findOneActive();
        if ($badge === null) {
            $badge = $user->getBadges()->first();
        }


        $this->view->assignMultiple(['user' => $user, 'badge' => $badge]);
    }

    /**
     * @param Badge $badge
     * @return void
     */
    public function editAction(Badge $badge)
    {
        $this->view->assign('foos', array(
            'bar', 'baz'
        ));
    }

    /**
     * @param Badge $badge
     * @return void
     */
    public function updateAction(Badge $badge)
    {
        $this->view->assign('foos', array(
            'bar', 'baz'
        ));
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function newAction()
    {
        $this->view->assign('startedAt', new \DateTime());

    }

    /**
     * @param string $startedAt
     * @return void
     * @throws \Neos\Flow\Mvc\Exception\StopActionException
     * @throws \Neos\Flow\Persistence\Exception\IllegalObjectTypeException
     * @throws \Neos\Flow\Persistence\Exception\InvalidQueryException
     */
    public function createAction(string $startedAt)
    {
        $startedAt = date_create_from_format('d/m/Y', $startedAt);

        $user = $this->userRepository->findOneActive();
        $newBadge = new Badge();
        $newBadge
            ->setStartedAt($startedAt)
            ->setCreatedAt(new \DateTime())
            ->setModifiedAt(new \DateTime())
            ->setUser($user);

        $this->badgeRepository->add($newBadge);

        $this->redirect('show', 'Badge');
    }
}
