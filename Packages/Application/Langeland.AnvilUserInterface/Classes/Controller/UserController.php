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
     * @Flow\InjectConfiguration(path="Authentication.passwords")
     * @var array
     */
    protected $passwords;

    /**
     * @return void
     */
    public function newAction()
    {
        $this->view->assign('units', $this->unitRepository->findAll());
        $this->view->assign('passwords', $this->passwords);
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

    public function generateAnvilTokenAction($regenerate = false)
    {

        $user = $this->userRepository->findOneActive();


        $anvilKey = $user->getUnit()->getCode() . '_' . $user->getDisplayName();

        $loginUrl = $this
            ->uriBuilder
            ->reset()
            ->setCreateAbsoluteUri(true)
            ->uriFor(
                'index',
                ['anvilKey' => $anvilKey],
                'Standard'
            );

        $this->view->assign('directLoginUrl', $loginUrl);


    }

    /**
     * @return void
     */
    public function loginAction()
    {
        $this->view->assign('units', $this->unitRepository->findAll());
        $this->view->assign('passwords', $this->passwords);
    }
}
