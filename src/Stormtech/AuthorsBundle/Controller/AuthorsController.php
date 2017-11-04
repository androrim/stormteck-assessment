<?php

namespace Stormtech\AuthorsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AuthorsController extends Controller
{
    /**
     * @Route("/authors")
     */
    public function indexAction()
    {
        return $this->render('AuthorsBundle:Authors:index.html.twig');
    }
}
