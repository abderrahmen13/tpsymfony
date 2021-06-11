<?php

namespace App\Entity;

use App\Repository\WhishlistRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Product;

/**
 * @ORM\Entity(repositoryClass=WhishlistRepository::class)
 */
class Whishlist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="whishlist")
     */
    private $products;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducts(): Product
    {
        return $this->products;
    }
}
