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
        $this->container        = $container;
        $this->authorRepository = $this->getDoctrine()
            ->getRepository('AuthorsBundle:Author');
    }

    /**
     * @Route("/", name="books_list")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()
            ->getRepository('BooksBundle:Book');
        $books = [];

        $fields = $request->get('orderby');
        $orders = $request->get('order');

        if ($request->get('books-filter')) {

            if ($fields) {
                $books = $repository->findAllOrderBy($fields, $orders);
            }
        }
        else {
            $books = $repository->findAll();
        }

        return $this->render('BooksBundle:Books:index.html.twig',
                ['books' => $books, 'fields' => $fields, 'orders' => $orders]);
    }

    /**
     * @Route("/add", name="books_add")
     */
    public function addAction(Request $request)
    {
        $book = new Book();

        if ($request->getMethod() === 'POST') {
            if ($this->persistHelper($request, $book)) {
                $this->addFlash('success', 'Livro adicionado com sucesso!');

                return $this->redirectToRoute('books_edit',
                        ['id' => $book->getId()]);
            }
        }

        return $this->render('BooksBundle:Books:addedit.html.twig',
                ['book' => $book, 'selecteds' => [],
                'authors' => $this->authorRepository->findAll(),]);
    }

    /**
     * @Route("/{id}/edit", name="books_edit")
     * @param Request $request
     * @param Book $book
     */
    public function editAction(Request $request, Book $book)
    {
        if ($request->getMethod() === 'POST') {
            if ($this->persistHelper($request, $book)) {
                $this->addFlash('success', 'Livro editado com sucesso!');
            }
        }

        return $this->render('BooksBundle:Books:addedit.html.twig',
                ['book' => $book, 'selecteds' => $book->getAuthors(),
                'authors' => $this->authorRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="books_delete")
     * @param Request $request
     * @param Book $book
     */
    public function deleteAction(Request $request, Book $book)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();

        $this->addFlash('success', 'Livro excluído com sucesso!');

        return $this->redirectToRoute('books_list');
    }

    private function persistHelper(Request $request, Book $book)
    {
        $persist = true;
        $authors = $this->authorRepository
            ->findByIds((array) $request->get('authors'));

        $book->setTitle($request->get('title'));
        $book->setEditionYear($request->get('edition_year'));
        $book->setAuthors(new ArrayCollection($authors));

        $business = $this->get('books.business');

        if (!$business->isValidDate($book)) {
            $this->addFlash('danger',
                'O ano de edição do livro não pode ser maior que o ano atual.');
            $persist = false;
        }

        if (!$business->isValidTitle($book)) {
            $this->addFlash('danger',
                'O título do livro tem que mais do que 3 caracteres.');
            $persist = false;
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();

        return $persist;
    }
}