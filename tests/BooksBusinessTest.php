<?php

namespace Stormtech\BooksBundle\Tests\Business;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Stormtech\BooksBundle\Entity\Book;
use Stormtech\BooksBundle\Service\BooksBusiness;

/**
 * Unit Tests for AuthorsBusiness
 *
 * @author Leandro de Amorim <androrim@gmai.com>
 */
class BooksBusinessTest extends TestCase
{

    private $business;
    
    public function __construct()
    {
        $this->business = new BooksBusiness();
    }

    public function testIsValidTitle()
    {
        $book = new Book();

        $book->setTitle('A');

        $this->assertFalse($this->business->isValidTitle($book),
            'Should be return false to title: ' . $book->getTitle());

        $book->setTitle('Ab');

        $this->assertTrue($this->business->isValidTitle($book),
            'Should be return true to title: ' . $book->getTitle());
    }
}