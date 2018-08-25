<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/products", name="products")
     */
    public function productsAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/new_product", name="new_product")
     */
    public function new_product_Action(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categoriesAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/new_category", name="new_category")
     */
    public function new_category_Action(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('home/index.html.twig');
    }
}
