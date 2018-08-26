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
     * @Route("/list/{page}", name="product")
     */
    public function productsAction(Request $request, $page=1)
    {   
        $productsNum = 2;
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $products = $repository->pageProducts($productsNum,$page);
        // $maxPages = ceil($products->count() / $limit);

        return $this->render('products/list.html.twig',[
            'products' => $products,
            'actualPage' => $page
        ]);

    }

    /**
     * @Route("/newProduct/{id}", name="newProduct")
     */
    public function newProductAction(Request $request, $id=null)
    {   
        if ($id) {
            $repository = $this->getDoctrine()->getRepository(Product::class);
            $product = $repository->find($id); 
        } else {
            $product = new Product();
        }
        
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

    /**
     * @Route("/deleteProduct/{id}", name="deleteProduct")
     */
    public function deleteProductAction(Request $request, $id=null)
    {   
        if ($id) {
            $repository = $this->getDoctrine()->getRepository(Product::class);
            $product = $repository->find($id); 
        } else {
            $product = new Product();
        }
    
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('product');
        
    }

}
