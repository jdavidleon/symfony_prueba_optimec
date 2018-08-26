<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\CategoryType;
use AppBundle\Form\ProductType;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;


/**
 * @Route("/products")
 */
class AdminProductsController extends Controller
{	
    /**
     * @Route("/list", name="product")
     */
    public function productsAction(Request $request1)
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $products = $repository->findAll();
        return $this->render('products/list.html.twig',['products'=>$products]);

    }

    /**
     * @Route("/newProduct", name="newProduct")
     */
    public function newProductAction(Request $request)
    {   
        $product = new Product();
        // Form Constructor
        $form = $this->createForm(ProductType::class, $product);

        // Recoje la info
        $form->handleRequest($request);

        $message = '';
        if ($form->isSubmitted() && $form->isValid()) {
            // Fill Entity Product
            $product = $form->getData();
            // Save new product
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            $message = 'ok';
        }

        return $this->render('products/new.html.twig',[
            'form'=>$form->createView(),
            'message' => $message
        ]);
    }

}
