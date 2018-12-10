<?php

namespace Langeland\AnvilUserInterface\Controller;

/*
 * This file is part of the Langeland.AnvilUserInterface package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;

class StandardController extends ActionController
{

    /**
     * @return void
     * @throws \Neos\Flow\Mvc\Exception\StopActionException
     */
    public function indexAction()
    {
        $this->redirect('index', 'Badge');
    }

    /**
     * @return void
     */
    public function aboutAction()
    {

    }

}
