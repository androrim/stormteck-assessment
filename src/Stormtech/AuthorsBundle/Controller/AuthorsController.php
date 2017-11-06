<?php

namespace Stormtech\AuthorsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Stormtech\AuthorsBundle\Entity\Author;
use Stormtech\AuthorsBundle\Business\AuthorsBusiness;

/**
 * @Route("authors")
 */
class AuthorsController extends Controller
{

    /**
     * @Route("/", name="authors_list")
     */
    public function indexAction()
    {
        $authors = $this->getDoctrine()
            ->getRepository('AuthorsBundle:Author')
            ->findAll();

        return $this->render('AuthorsBundle:Authors:index.html.twig', [
                'authors' => $authors
        ]);
    }

    /**
     * @Route("/add")
     */
    public function addAction(Request $request)
    {
        $author = new Author();

        if ($request->getMethod() === 'POST') {
            $author->setName($request->get('name'));

            $business = $this->get('authors.business');

            if ($business->isValid($author)) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($author);
                $em->flush();

                return $this->redirectToRoute('authors_edit', [
                        'id' => $author->getId()
                ]);
            }
        }

        return $this->render('AuthorsBundle:Authors:addedit.html.twig', [
                'author' => $author
        ]);
    }

    /**
     * @Route("/{id}/edit", name="authors_edit")
     * @param Request $request
     * @param Author $author
     */
    public function editAction(Request $request, Author $author)
    {
        if ($request->getMethod() === 'POST') {
            $author->setName($request->get('name'));

            $business = $this->get('authors.business');

            if ($business->isValid($author)) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($author);
                $em->flush();
            }
        }

        return $this->render('AuthorsBundle:Authors:addedit.html.twig', [
                'author' => $author
        ]);
    }

    /**
     * @Route("/{id}/delete", name="authors_delete")
     * @param Request $request
     * @param Book $author
     */
    public function deleteAction(Request $request, Author $author)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($author);
        $em->flush();

        return $this->redirectToRoute('authors_list');
    }
}