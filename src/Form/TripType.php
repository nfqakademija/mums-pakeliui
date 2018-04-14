<?php

namespace App\Form;

use App\Entity\Trip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('type', ChoiceType::class,  array('choices' => array(
                'Vairuotojas' => '1',
                'Keleivis' => '2'
            ),

                'multiple'=>false,'expanded'=>true, 'label'=>false))

            ->add('dateOfTrip', DateTimeType::class, array('label'=>'Data ir laikas'))
                /*->add('dateOfTrip', DateTimeType::class, array(
                    'widget' => 'single_text',
                    'html5' => false
                ))*/
            ->add('seats', IntegerType::class, array(
                'required' => false,
                'empty_data' => '1',
                'attr'          => array(
                    '_type'         => "number",
                    'min'           => 1,
                    'step'          => 1,
                ), 'label'=> 'Vietų skaičius',

            ))
            ->add('smoke', ChoiceType::class,  array('choices' => array(
                'negalima' => '0',
                'galima' => '1',
            ),

            'multiple'=>false,'expanded'=>true, 'label' =>'Rūkyti'))
            ->add('pets', ChoiceType::class,  array('choices' => array(
                'negalima' => '0',
                'galima' => '1',
            ),

                'multiple'=>false,'expanded'=>true, 'label'=>'Gyvūnai'))
            ->add('informacija', TextareaType::class)

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
        ]);
    }
}
