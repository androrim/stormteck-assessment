<?php

namespace Stormtech\BooksBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Stormtech\BooksBundle\Entity\Book;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 *
 * @Route("/books")
 */
class BooksController extends Controller
{
    protected $container;
    private $authorRepository;

    public function setContainer(ContainerInterface $container = null)
     {
         $this->container = $container;
         $this->authorRepository = $this->getDoctrine()
            ->getRepository('AuthorsBundle:Author');
     }

    /**
     * @Route("/", name="books_list")
     */
    public function indexAction()
    {
        $books = $this->getDoctrine()
            ->getRepository('BooksBundle:Book')
            ->findAll();

        return $this->render('BooksBundle:Books:index.html.twig', [
            'books' => $books
        ]);
    }

    /**
     * @Route("/add", name="books_add")
     */
    public function addAction(Request $request)
    {
        $book    = new Book();

        if ($request->getMethod() === 'POST') {
            $this->persistHelper($request, $book);
            
            return $this->redirectToRoute('books_edit', [
                'id' => $book->getId()
            ]);
        }

        return $this->render('BooksBundle:Books:addedit.html.twig',[
                'book' => $book,
                'selecteds' => [],
                'authors' => $this->authorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="books_edit")
     * @param Request $request
     * @param Book $book
     */
    public function editAction(Request $request, Book $book)
    {
        if ($request->getMethod() === 'POST') {
            $this->persistHelper($request, $book);
        }

        return $this->render('BooksBundle:Books:addedit.html.twig',[
                'book' => $book,
                'selecteds' => $book->getAuthors(),
                'authors' => $this->authorRepository->findAll(),
        ]);
    }

    private function persistHelper(Request $request, Book $book)
    {
        $authors = $this->authorRepository
            ->findByIds((array) $request->get('authors'));

        $book->setTitle($request->get('title'));
        $book->setEditionYear($request->get('edition_year'));
        $book->setAuthors(new ArrayCollection($authors));

        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();

        return $book;
    }
}