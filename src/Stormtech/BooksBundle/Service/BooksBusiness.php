<?php

namespace Stormtech\BooksBundle\Service;

use Stormtech\BooksBundle\Entity\Book;

/**
 * Business rules of Books
 *
 * @author Leandro de Amorim <androrim@gmail.com>
 */
class BooksBusiness
{
    public function isValidDate(Book $book)
    {
        return (int) $book->getEditionYear() <= (int) date('Y');
    }

    public function isValidTitle(Book $book)
    {
        return trim(strlen($book->getTitle())) > 2;
    }
}