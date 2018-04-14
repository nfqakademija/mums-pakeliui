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
                'Car' => '1',
                'Human' => '2',
            ),

                'multiple'=>false,'expanded'=>true))

            ->add('dateOfTrip', DateTimeType::class)
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
                ),

            ))
            ->add('smoke', ChoiceType::class,  array('choices' => array(
                'noSmoke' => '0',
                'Smoke' => '1',
            ),

            'multiple'=>false,'expanded'=>true))
            ->add('pets', ChoiceType::class,  array('choices' => array(
                'no Pets' => '0',
                'Pets' => '1',
            ),

                'multiple'=>false,'expanded'=>true))
            ->add('info', TextareaType::class)

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trip::class,
        ]);
    }
}
