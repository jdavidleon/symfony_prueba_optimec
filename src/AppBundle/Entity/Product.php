<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\Column(name="code", type="string", length=10, unique=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name_product", type="string", length=255, unique=true)
     */
    private $nameProduct;

    /**
     * @var string
     *
     * @ORM\Column(name="description_product", type="string", length=255)
     */
    private $descriptionProduct;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255)
     */
    private $brand;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
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
     * Set code
     *
     * @param string $code
     *
     * @return Product
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
     * Set nameProduct
     *
     * @param string $nameProduct
     *
     * @return Product
     */
    public function setNameProduct($nameProduct)
    {
        $this->nameProduct = $nameProduct;

        return $this;
    }

    /**
     * Get nameProduct
     *
     * @return string
     */
    public function getNameProduct()
    {
        return $this->nameProduct;
    }

    /**
     * Set descriptionProduct
     *
     * @param string $descriptionProduct
     *
     * @return Product
     */
    public function setDescriptionProduct($descriptionProduct)
    {
        $this->descriptionProduct = $descriptionProduct;

        return $this;
    }

    /**
     * Get descriptionProduct
     *
     * @return string
     */
    public function getDescriptionProduct()
    {
        return $this->descriptionProduct;
    }

    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Product
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
