<?php

namespace Stormtech\AuthorsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Stormtech\BooksBundle\Entity\Book;

/**
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity(repositoryClass="Stormtech\AuthorsBundle\Repository\AuthorRepository")
 */
class Author
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * Many Authors have Many Books.
     * @ORM\ManyToMany(targetEntity="\Stormtech\BooksBundle\Entity\Book", mappedBy="authors")
     */
    private $books;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Author
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return \Author[]
     */
    public function getAuthors()
    {
        return $this->books->toArray();
    }

    /**
     * Set books
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $books[]
     * @return Book
     */
    public function setAuthors(\Doctrine\Common\Collections\ArrayCollection $books)
    {
        $this->books = $books;

        return $this;
    }

    public function __construct()
    {
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
    }
}

