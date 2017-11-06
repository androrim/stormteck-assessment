<?php

namespace Stormtech\AuthorBundle\Tests\Business;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Stormtech\AuthorsBundle\Entity\Author;
use Stormtech\AuthorsBundle\Service\AuthorsBusiness;

/**
 * Unit Tests for AuthorsBusiness
 *
 * @author Leandro de Amorim <androrim@gmai.com>
 */
class AuthorsBusinessTest extends TestCase
{

    private $business;
    
    public function __construct()
    {
        $this->business = new AuthorsBusiness();
    }

    public function testIsValidName()
    {
        $author = new Author();

        $author->setName('Leandro');

        $this->assertFalse($this->business->isValidName($author),
            'Should be return false to name: ' . $author->getName());

        $author->setName('Leandro de');

        $this->assertFalse($this->business->isValidName($author),
            'Should be return false to name: ' . $author->getName());

        $author->setName('Leandro de Am');

        $this->assertFalse($this->business->isValidName($author),
            'Should be return false to name: ' . $author->getName());

        $author->setName('Leandro de Amorim');

        $this->assertTrue($this->business->isValidName($author),
            'Should be return true to name: ' . $author->getName());
    }
}