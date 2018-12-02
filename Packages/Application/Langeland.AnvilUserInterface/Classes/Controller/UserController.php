<?php

namespace Langeland\AnvilUserInterface\Controller;

/*
 * This file is part of the Langeland.AnvilUserInterface package.
 */

use Langeland\AnvilCore\Service\UserService;
use Langeland\AnvilCore\Domain\Model\Unit;
use Langeland\AnvilCore\Domain\Repository\UnitRepository;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class UserController extends AbstractAnvilController
{


    /**
     * @Flow\Inject
     * @var UnitRepository
     */
    protected $unitRepository;

    /**
     * @Flow\Inject
     * @var UserService
     */
    protected $userService;


    /**
     * @return void
     */
    public function newAction()
    {
        $this->view->assign('units', $this->unitRepository->findAll());
    }

    /**
     * @param string $username
     * @param Unit $unit
     * @param string $password
     * @return void
     * @throws \Neos\Flow\Mvc\Exception\StopActionException
     * @throws \Neos\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function createAction(string $username, Unit $unit, string $password)
    {
        $this->userService->createUserWithAccount($username, $password, $unit);

        $this->addFlashMessage('Created a new team member.');
        $this->redirect('login', 'User');
    }

    /**
     * @return void
     */
    public function loginAction()
    {
        $this->view->assign('units', $this->unitRepository->findAll());
    }
}
