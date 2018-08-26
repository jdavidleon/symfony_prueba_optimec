<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\CategoryType;
use AppBundle\Entity\Category;


/**
 * @Route("/categories")
 */
class AdminCategoriesController extends Controller
{	
	 /**
     * @Route("/list", name="categories")
     */
    public function categoriesAction(Request $request)
    {   
        // Capturar el repositorio de la tabla contra la DB
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();
        return $this->render('categories/list.html.twig',['categories'=>$categories]);
    }

    /**
     * @Route("/newCategory", name="newCategory")
     */
    public function newCategoryAction(Request $request)
    {   
        $category = new Category();
        // Form Constructor
        $form = $this->createForm(CategoryType::class, $category);

        // Recoje la info
        $form->handleRequest($request);

        $message = '';
        if ($form->isSubmitted() && $form->isValid()) {
            // Fill Entity Category
            $category = $form->getData();
            // $category->setActive(1);


            // Save new category
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            $message = 'ok';
        }

        return $this->render('categories/new.html.twig',[
            'form'=>$form->createView(),
            'message' => $message
        ]);
    }

}
