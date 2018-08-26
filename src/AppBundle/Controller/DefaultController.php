<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/products/{category}", name="products")
     */
    public function productsAction(Request $request, $category="all")
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $products = $repository->findAll();
        return $this->render('products/list.html.twig',['products'=>$products]);

    }

    /**
     * @Route("/new_product", name="new_product")
     */
    public function new_product_Action(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home/index.html.twig');
    }

   
}
