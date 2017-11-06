<?php

namespace Stormtech\AuthorsBundle\Service;

use Symfony\Component\HttpFoundation\Request;

/**
 * Business Authors app message
 *
 * @author Leandro de Amorim <androrim@gmail.com>
 */
class AuthorsAppMessages
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getMessage()
    {
        
    }

    public function getMessageType()
    {
        
    }
}