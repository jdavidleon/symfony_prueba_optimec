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
     * @Route("/list/{currentPage}/{order}/{insert}", name="product")
     */
    public function productsAction(Request $request, $currentPage=1,$insert=null,$order='id')
    {   

        $em = $this->getDoctrine()->getManager();
        $limit = 5;
        $repository = $em->getRepository(Product::class);
        $productsConsult = $repository->getAllProducts($currentPage,$limit,$order);
        $productsResult = $productsConsult['paginator'];
        $productQuery = $productsConsult['query'];

        $products = $productQuery->execute();

        $maxPages = ceil($productsConsult['paginator']->count() / $limit);

        return $this->render('products/list.html.twig',[
            'productResult' => $productsResult,
            'products' => $products,
            'actualPage' => $currentPage,
            'maxPages'=>$maxPages,
            'insert'=>$insert
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

        // Recive info
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Fill Entity Product
            $product = $form->getData();
            // Save new product
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('product', ['insert' => 'ok']);
        }

        return $this->render('products/new.html.twig',[
            'form'=>$form->createView()
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
