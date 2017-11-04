<?php

namespace Stormtech\BooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BooksController extends Controller
{
    /**
     * @Route("/books")
     */
    public function indexAction()
    {
        return $this->render('BooksBundle:Books:index.html.twig');
    }
}