<?php

namespace App\Controller;

use App\Entity\Bid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        
        $profileItem = $this->getDoctrine()->getRepository(Bid::class)->findBidsItemsByUser(1);
        //dd($profileItem[0]);
        $products = $this->getDoctrine()->getRepository(Product::class)->findLatest();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Acceuil',
            'products' => $products
        ]);
    }
}
