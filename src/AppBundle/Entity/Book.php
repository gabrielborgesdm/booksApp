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
     * @var int
     *
     * @ORM\Column(name="publisher_id", type="integer")
     */
    private $publisherId;

    /**
     * @var string
     *
     * @ORM\Column(name="book_name", type="string", length=255)
     */
    private $bookName;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set publisherId
     *
     * @param integer $publisherId
     *
     * @return Book
     */
    public function setPublisherId($publisherId)
    {
        $this->publisherId = $publisherId;

        return $this;
    }

    /**
     * Get publisherId
     *
     * @return int
     */
    public function getPublisherId()
    {
        return $this->publisherId;
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
     * Set edition
     *
     * @param integer $edition
     *
     * @return Book
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * Get edition
     *
     * @return int
     */
    public function getEdition()
    {
        return $this->edition;
    }
}

