<?php 

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Category;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('code', TextType::class, array('label' => 'Código'))
          ->add('category', EntityType::class, array('class' => Category::class, 'label' => 'Categoria'))
          ->add('nameProduct', TextType::class, array('label' => 'Nombre'))
          ->add('descriptionProduct', TextareaType::class, array('label' => 'Descripción'))
          ->add('brand', TextType::class, array('label' => 'Marca'))
          ->add('price')
          ->add('Nueva', SubmitType::class, array('label' => 'Crear Producto'));
    }
}