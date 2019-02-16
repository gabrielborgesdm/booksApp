<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Author
 *
 * @ORM\Table(name="author")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AuthorRepository")
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
     * @ORM\Column(name="author_name", type="string", length=255)
     */
    private $AuthorName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date")
     */
    private $birthDate;

     /**
      * @var int
      * @ORM\ManyToOne(targetEntity="Country")
      * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
      */
     private $country;

     /**
      * @ORM\ManyToMany(targetEntity="Book", mappedBy="authors", cascade={"persist"})
      */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
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
     * Get the value of Author Name
     *
     * @return string
     */
    public function getAuthorName()
    {
        return $this->AuthorName;
    }

    /**
     * Set the value of Author Name
     *
     * @param string AuthorName
     *
     * @return self
     */
    public function setAuthorName($AuthorName)
    {
        $this->AuthorName = $AuthorName;

        return $this;
    }

    /**
     * Get the value of Birth Date
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set the value of Birth Date
     *
     * @param \DateTime birthDate
     *
     * @return self
     */
    public function setBirthDate(\DateTime $birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }


    /**
     * Get the value of Country
     *
     * @return int
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of Country
     *
     * @param int country
     *
     * @return self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }


    public function addBook(Book $book): self
    {
        $this->books[] = $book;

        return $this;
    }

    public function removeBook(Book $book): bool
    {
        return $this->books->removeElement($book);
    }

    public function getBooks(): Collection
    {
        return $this->books;
    }

}
