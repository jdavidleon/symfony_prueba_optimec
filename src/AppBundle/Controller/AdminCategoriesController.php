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
