<?php

namespace AppBundle\Entity;

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
     * @ORM\Column(name="book_name", type="string", length=400)
     */
    private $bookName;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string", length=255)
     */
    private $publisher;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishing_date", type="datetime")
     */
    private $publishingDate;

    /**
     * @var int
     *
     * @ORM\Column(name="pages", type="integer")
     */
    private $pages;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;


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
     * Set bookName
     *
     * @param string $bookName
     *
     * @return Book
     */
    public function setBookName($bookName)
    {
        $this->bookName = $bookName;

        return $this;
    }

    /**
     * Get bookName
     *
     * @return string
     */
    public function getBookName()
    {
        return $this->bookName;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     *
     * @return Book
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Book
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set publishingDate
     *
     * @param \DateTime $publishingDate
     *
     * @return Book
     */
    public function setPublishingDate($publishingDate)
    {
        $this->publishingDate = $publishingDate;

        return $this;
    }

    /**
     * Get publishingDate
     *
     * @return \DateTime
     */
    public function getPublishingDate()
    {
        return $this->publishingDate;
    }

    /**
     * Set pages
     *
     * @param integer $pages
     *
     * @return Book
     */
    public function setPages($pages)
    {
        $this->pages = $pages;

        return $this;
    }

    /**
     * Get pages
     *
     * @return int
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Book
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }
}

