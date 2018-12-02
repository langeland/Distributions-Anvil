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
     */
    public function indexAction()
    {
        $this->view->assign('foos', array(
            'bar', 'baz'
        ));
    }


}
