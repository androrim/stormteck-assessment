<?php

namespace Stormtech\BooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Stormtech\BooksBundle\Entity\Book;
use Doctrine\Common\Collections\ArrayCollection;

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

    /**
     * @Route("/add", name="books_add")
     */
    public function addAction(Request $request)
    {
        $authorRepository = $this->getDoctrine()
            ->getRepository('AuthorsBundle:Author');

        $book    = new Book();
        $authors = $authorRepository->findAll();

        if ($request->getMethod() === 'POST') {
            $_authors = $authorRepository->findByIds((array) $request->get('authors'));

            var_dump($_authors); die;

            $book->setTitle($request->get('title'));
            $book->setEditionYear($request->get('edition_year'));
            $book->setAuthors(new ArrayCollection($_authors));

            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();
        }

        return $this->render('BooksBundle:Books:addedit.html.twig',
                [
                'book' => $book,
                'selecteds' => [],
                'authors' => $authors,
        ]);
    }
}