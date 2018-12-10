<?php
namespace Langeland\AnvilUserInterface\Security;

/*
 * This file is part of the Neos.Flow package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\ActionRequest;
use Neos\Flow\Security\Authentication\Token\AbstractToken;
use Neos\Utility\ObjectAccess;

/**
 * An authentication token used for simple password authentication.
 */
class AnvilKeyToken extends AbstractToken
{
    /**
     * The password credentials
     * @var array
     * @Flow\Transient
     */
    protected $credentials = ['anvilKey' => ''];

    /**
     * @var \Neos\Flow\Utility\Environment
     * @Flow\Inject
     */
    protected $environment;

    /**
     * @param ActionRequest $actionRequest The current action request
     * @return void
     * @throws \Neos\Flow\Security\Exception\InvalidAuthenticationStatusException
     * @throws \Neos\Flow\Mvc\Exception\NoSuchArgumentException
     */
    public function updateCredentials(ActionRequest $actionRequest)
    {

        if($actionRequest->hasArgument('anvilKey') === FALSE){
            return;
        }

        $anvilKey = $actionRequest->getArgument('anvilKey');

        if (!empty($anvilKey)) {
            $this->credentials['anvilKey'] = $anvilKey;
            $this->setAuthenticationStatus(self::AUTHENTICATION_NEEDED);
        }
    }

    /**
     * Returns a string representation of the token for logging purposes.
     *
     * @return string
     */
    public function __toString()
    {
        return 'AnvilKey Token';
    }
}
