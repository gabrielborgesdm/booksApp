<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publisher
 *
 * @ORM\Table(name="publisher")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublisherRepository")
 */
class Publisher
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
     * @ORM\Column(name="publisher_name", type="string", length=255)
     */
    private $publisherName;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

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
     * Get the value of Publisher Name
     *
     * @return string
     */
    public function getPublisherName()
    {
        return $this->publisherName;
    }

    /**
     * Set the value of Publisher Name
     *
     * @param string publisherName
     *
     * @return self
     */
    public function setPublisherName($publisherName)
    {
        $this->publisherName = $publisherName;

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

}
