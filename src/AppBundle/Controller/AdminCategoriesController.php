<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\CategoryType;
use AppBundle\Entity\Category;
use AppBundle\Entity\Product;


/**
 * @Route("/categories")
 */
class AdminCategoriesController extends Controller
{	
	 /**
     * @Route("/list/{order}/{insert}", name="categories")
     */
    public function categoriesAction(Request $request, $insert=null, $order='id')
    {   
        // Gewt the repository of table 
        $repository = $this->getDoctrine()->getRepository(Category::class);

        $categoriesQ = $repository->createQueryBuilder('c')
            ->orderBy('c.'.$order)
            ->getQuery();

        $categories = $categoriesQ->execute();

        return $this->render('categories/list.html.twig',['categories'=>$categories, 'insert'=>$insert]);
    }

    /**
     * @Route("/products/{currentPage}/{order}/{categoryId}", name="categoriesFilter")
    */
    public function productsByCatAction(Request $request, $currentPage=1, $categoryId=null, $order="id")
    {   
        if(!$categoryId){
            return new Response('Error: Ninguna categoria seleccionada');
        }
        $em = $this->getDoctrine()->getManager();
        $limit = 5;
        $repository = $em->getRepository(Product::class);
        $productsConsult = $repository->getAllProducts($currentPage,$limit,$order,$categoryId);
        $productsResult = $productsConsult['paginator'];
        $productQuery = $productsConsult['query'];

        $products = $productQuery->execute();

        $maxPages = ceil($productsConsult['paginator']->count() / $limit);

        return $this->render('categories/filterList.html.twig',[
            'productResult' => $productsResult,
            'products' => $products,
            'actualPage' => $currentPage,
            'maxPages'=>$maxPages,
            'categoryId'=>$categoryId,
            'order'=>$order,
            'insert'=>null
        ]);
    }

    /**
     * @Route("/newCategory/{id}", name="newCategory")
     */
    public function newCategoryAction(Request $request, $id=null)
    {   
        if ($id) {
            $repository = $this->getDoctrine()->getRepository(Category::class);
            $category = $repository->find($id);   
        }else{
            $category = new Category();
        }
        // Form Constructor
        $form = $this->createForm(CategoryType::class, $category);

        // Recive info
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Fill Entity Category
            $category = $form->getData();
            // $category->setActive(1);

            // Save new category
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('categories', ['insert' => 'ok']);
        }

        return $this->render('categories/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }

}
