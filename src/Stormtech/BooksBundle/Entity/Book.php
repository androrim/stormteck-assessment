<?php

namespace Stormtech\BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Stormtech\AuthorsBundle\Entity\Author as Author;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="Stormtech\BooksBundle\Repository\BookRepository")
 */
class Book
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * Many Books have Many Authors.
     * @ORM\ManyToMany(targetEntity="\Stormtech\AuthorsBundle\Entity\Author")
     * @ORM\JoinTable(name="books_authors",
     *      joinColumns={@ORM\JoinColumn(name="book_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="author_id", referencedColumnName="id")}
     * )
     */
    private $authors;

    /**
     * @var string
     *
     * @ORM\Column(name="edition_year", type="string", length=4)
     */
    private $editionYear;

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
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set editionYear
     *
     * @param string $editionYear
     *
     * @return Book
     */
    public function setEditionYear($editionYear)
    {
        $this->editionYear = $editionYear;

        return $this;
    }

    /**
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set authors
     *
     * @param \Doctrine\Common\Collections\ArrayCollection $authors[]
     * @return Book
     */
    public function setAuthors(\Doctrine\Common\Collections\ArrayCollection $authors)
    {
        $this->authors = $authors;

        return $this;
    }

    /**
     * Get editionYear
     *
     * @return string
     */
    public function getEditionYear()
    {
        return $this->editionYear;
    }

    public function __construct()
    {
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
    }
}