<?php

namespace AppBundle\Entity;

use Symfony\Component\Form\AbstractType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 * @UniqueEntity("code")
 * @UniqueEntity("nameCategory")
 */
class Category extends AbstractType
{   
    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="category")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }
    
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
     * @ORM\Column(name="code", type="string", length=10, unique=true)
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\W/",
     *     match=false,
     *     message="El codigo solo permite letras, numeros y _"
     * )
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "El Código debe tener mínimo {{ limit }} caracteres",
     * )
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name_category", type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $nameCategory;

    /**
     * @var string
     *
     * @ORM\Column(name="description_category", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $descriptionCategory;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;


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
     * Set code
     *
     * @param string $code
     *
     * @return Category
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nameCategory
     *
     * @param string $nameCategory
     *
     * @return Category
     */
    public function setNameCategory($nameCategory)
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }

    /**
     * Get nameCategory
     *
     * @return string
     */
    public function getNameCategory()
    {
        return $this->nameCategory;
    }

    /**
     * Set descriptionCategory
     *
     * @param string $descriptionCategory
     *
     * @return Category
     */
    public function setDescriptionCategory($descriptionCategory)
    {
        $this->descriptionCategory = $descriptionCategory;

        return $this;
    }

    /**
     * Get descriptionCategory
     *
     * @return string
     */
    public function getDescriptionCategory()
    {
        return $this->descriptionCategory;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Category
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Add product
     *
     * @param \AppBundle\Entity\Product $product
     *
     * @return Category
     */
    public function addProduct(\AppBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \AppBundle\Entity\Product $product
     */
    public function removeProduct(\AppBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    // convert to string
    public function __toString()
    {
        return $this->nameCategory;
    }
}
