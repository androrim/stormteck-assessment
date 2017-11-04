<?php

namespace Stormtech\AuthorsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Stormtech\AuthorsBundle\Entity\Author;

class AuthorsController extends Controller
{

    /**
     * @Route("/authors")
     */
    public function indexAction()
    {
        return $this->render('AuthorsBundle:Authors:index.html.twig');
    }

    /**
     * @Route("/authors/add")
     */
    public function addAction(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $author = new Author();
            $author->setName($request->get('name'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();
        }

        return $this->render('AuthorsBundle:Authors:add.html.twig');
    }
}