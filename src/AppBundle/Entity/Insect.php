<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Insect
 *
 * @ORM\Table(name="insect")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InsectRepository")
 */
class Insect
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="latin", type="string", length=255, nullable=true)
     */
    private $latin;


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
     * @return Insect
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
     * Set latin
     *
     * @param string $latin
     *
     * @return Insect
     */
    public function setLatin($latin)
    {
        $this->latin = $latin;

        return $this;
    }

    /**
     * Get latin
     *
     * @return string
     */
    public function getLatin()
    {
        return $this->latin;
    }
}

