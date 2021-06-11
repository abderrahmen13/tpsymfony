<?php

namespace App\Controller;

use App\Entity\Bid;
use App\Entity\Comment;
use App\Entity\Category;
use App\Entity\Product;
use App\Form\BidType;
use App\Form\CommentType;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Carbon\Carbon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ProductController extends AbstractController
{

    /**
     * @Route("/my/product/add" , name="addProduct")
     */

    public function addProduct(Request $request): Response
    {
        //$category = $this->getDoctrine()->getRepository(Category::class)->findCategoryById($request->request->get('product')['category']);
        //dump($category[0]);
        $product = new Product();
        //$product->setCategory($category[0]);
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $data = $form->getData(); //get data from form.
            $ended_date = Carbon::now();
            $ended_date->addDays($form->get('days')->getData())->toDateString();
            
            // sets data from form.
            $product->setEndedAt($ended_date);
            $product->setCreatedAt(Carbon::now());
            $product->setStatus(True);
            $product->setUser($this->getUser());
            //$product->setCategory($category);
            $product->setFinalPrice($form->get('initialPrice')->getData());


            // insert into a database. 
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute("home");
        }
        return $this->render('product/add_product.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/product/{id}", name="single_product")
     */
    public function single_product($id, Request $request)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        $bid = new Bid();
        $form = $this->createForm(BidType::class, $bid)->handleRequest($request); //bid form.
        $entityManager = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {
            // get the final price from Product.
            $finalprice = $product->getFinalPrice();
            // dump price data from form.
            $bidprice = $form->get('price')->getData();
            if ($bidprice > $finalprice) { // test if bid a valid. and the bid price geater than final price.
                // set time.now , product , and thisUser and setIt to bid.
                $bid->setBidAt(Carbon::now());
                $bid->setProduct($product);
                $bid->setUser($this->getUser());
                $entityManager->persist($bid);
                $entityManager->flush();
                // update the final price of product.
                $product->setFinalPrice($bidprice);
                $entityManager->persist($product);
                $entityManager->flush();
            }
        }
        // search for bids of this product.
        $bids = $this->getDoctrine()->getRepository(Bid::class)->findByProduct($id);
        //−−−−COMMENTS
        $comments = $this->getDoctrine()->getRepository(Comment::class)->findProductComments($id);
        $comment = new Comment();
        //comment form
        $cform = $this->createForm(CommentType::class, $comment)->handleRequest($request);
        if ($cform->isSubmitted() && $cform->isValid()) {
            $comment->setCreatedAt(Carbon::now());
            $comment->setUser($this->getUser());
            $comment->setProduct($product);
            $entityManager->persist($comment);
            $entityManager->flush();
        }
        // rendering variables to twig template.
        return $this->render('product/single.html.twig', [
            'controller_name' => 'ProductController',
            'product' => $product,
            "form" => $form->createView(),
            'history' => $bids,
            'comments' => $comments,
            'cform' => $cform->createView()
        ]);
    }


    /**
     * @Route("/my/products" , name="MyProducts")
     */
    public function myProducts()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findProductsByUser($this->getUser()->getId());
        return $this->render('my/products.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $products,
            'productLength' => count($products)
        ]);
    }

    /**
     * @Route("/product/location/{location}" , name="LocationProducts")
     */
    public function mapFind($location)
    {
        $em = $this->getDoctrine()->getRepository(Product::class);
        $products = $em->findProductsByLocation($location);
        return $this->render('product/location.html.twig', [
            'products' => $products,
            'productLength' => count($products),
            'location' => $location
        ]);
    }
}
