<?php

namespace AppBundle\Form {

    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;

    class CategoryType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('code', TextType::class, array('label' => 'Código'))
                ->add('nameCategory', TextType::class, array('label' => 'Nombre'))
                ->add('descriptionCategory', TextareaType::class, array('label' => 'Descripción'))
                ->add('active')
                ->add('Nueva', SubmitType::class, array('label' => 'Crear Categoria'));
        }
    }
}