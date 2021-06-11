<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\Whishlist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="profile")
     */
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    /**
     * @Route("/my/comment/delete/{id}" , name="commentDelete")
     */
    public function deleteComment($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment = $entityManager->getRepository(Comment::class)->find($id);
        if (!$comment) {
            throw $this->createNotFoundException(
                'No comment found for id ' . $id
            );
        }
        $entityManager->remove($comment);
        $entityManager->flush();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/my/add/whishlist/{id}" , name="addWhishlist")
     */
    public function addwhishlist($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->getRepository(Product::class)->find($id);
        $whishlist = new Whishlist();

        if (!$product) 
        throw $this->createNotFoundException(
            'No Product found for id ' . $id
        );

        return $this->redirectToRoute('whishlist');
    }

}
