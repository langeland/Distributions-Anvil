<?php

namespace Langeland\AnvilUserInterface\Controller;

/*
 * This file is part of the Langeland.AnvilUserInterface package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\ActionRequest;
use Neos\Flow\Security\Authentication\Controller\AbstractAuthenticationController;


class AuthenticationController extends AbstractAuthenticationController
{

    /**
     * Will be triggered upon successful authentication
     *
     * @param ActionRequest $originalRequest The request that was intercepted by the security framework, NULL if there was none
     * @return string
     * @throws \Neos\Flow\Mvc\Exception\StopActionException
     */
    protected function onAuthenticationSuccess(ActionRequest $originalRequest = NULL)
    {
        if ($originalRequest !== NULL) {
            $this->redirectToRequest($originalRequest);
        }
        $this->redirect('index', 'Standard');
    }

    /**
     * Logs all active tokens out and redirects the user to the login form
     *
     * @return void
     * @throws \Neos\Flow\Mvc\Exception\StopActionException
     */
    public function logoutAction()
    {
        parent::logoutAction();
        $this->addFlashMessage('Logout successful');
        $this->redirect('index', 'Standard');
    }

}
