<?php

namespace Stormtech\BooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 *
 * @Route("/books")
 */
class BooksController extends Controller
{
    /**
     * @Route("/", name="books_list")
     */
    public function indexAction()
    {
        return $this->render('BooksBundle:Books:index.html.twig');
    }
}