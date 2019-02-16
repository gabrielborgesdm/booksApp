<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookRepository")
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
     * @ORM\Column(name="book_name", type="string", length=255)
     */
    private $bookName;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Publisher")
     * @ORM\JoinColumn(name="publisher_id", referencedColumnName="id")
     */
    private $publisher;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishing_date", type="date")
     */
    private $publishingDate;

    /**
     * @var int
     *
     * @ORM\Column(name="pages", type="integer")
     */
    private $pages;

    /**
     * @var int
     *
     * @ORM\Column(name="edition", type="integer")
     */
    private $edition;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Author", inversedBy="books", cascade={"persist"})
     * @ORM\JoinTable(
     *     name="book_author",
     *     joinColumns={
     *          @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     *          @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     *     }
     * )
     */
    private $authors;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    /**
     * Get the value of Id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param int id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Book Name
     *
     * @return string
     */
    public function getBookName()
    {
        return $this->bookName;
    }

    /**
     * Set the value of Book Name
     *
     * @param string bookName
     *
     * @return self
     */
    public function setBookName($bookName)
    {
        $this->bookName = $bookName;

        return $this;
    }

    /**
     * Get the value of Publishing Date
     *
     * @return \DateTime
     */
    public function getPublishingDate()
    {
        return $this->publishingDate;
    }

    /**
     * Set the value of Publishing Date
     *
     * @param \DateTime publishingDate
     *
     * @return self
     */
    public function setPublishingDate(\DateTime $publishingDate)
    {
        $this->publishingDate = $publishingDate;

        return $this;
    }

    /**
     * Get the value of Pages
     *
     * @return int
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set the value of Pages
     *
     * @param int pages
     *
     * @return self
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get the value of Edition
     *
     * @return int
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * Set the value of Edition
     *
     * @param int edition
     *
     * @return self
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * Get the value of Category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of Category
     *
     * @param string category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    public function addAuthor(Author $author): self
    {
        $this->authors[] = $author;

        return $this;
    }

    public function removeAuthor(Author $author): bool
    {
        return $this->authors->removeElement($author);
    }

    public function getAuthors(): Collection
    {
        return $this->authors;
    }


    /**
     * Get the value of Publisher
     *
     * @return int
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set the value of Publisher
     *
     * @param int publisher
     *
     * @return self
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }


}
