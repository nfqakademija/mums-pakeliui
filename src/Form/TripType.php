<?php

namespace App\Form;

use App\Entity\Trip;
use App\Entity\City;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add(
                'travelerType',
                ChoiceType::class,
                array('choices' => array(
                    'Vairuotojas' => '0',
                    'Keleivis' => '1'),
                    'empty_data'=>'1', 'multiple'=>false,'expanded'=>true, 'label'=>false)
            )

            ->add(
                'departFrom',
                TextType::class,
                array('label'=> 'Išvykimo adresas')
            )

            ->add(
                'destination',
                TextType::class,
                array('label'=> 'Atvykimo adresas')
            )

            ->add(
                'departTime',
                DateTimeType::class,
                array('label'=>'Išvykimo data ir laikas')
            )

            ->add(
                'seats',
                IntegerType::class,
                array(
                    'required' => false,
                    'empty_data' => '1',
                    'attr'          => array(
                        '_type'         => "number",
                        'min'           => 1,
                        'step'          => 1),
                    'label'=> 'Vietų skaičius')
            )

            ->add(
                'smoke',
                ChoiceType::class,
                array('choices' => array(
                    'negalima' => '0',
                    'galima' => '1'),
                    'empty_data'=>'0','multiple'=>false,'expanded'=>true, 'label' =>'Rūkyti')
            )

            ->add(
                'pets',
                ChoiceType::class,
                array('choices' => array(
                    'negalima' => '0',
                    'galima' => '1'),
                    'empty_data'=>'0', 'multiple'=>false,'expanded'=>true, 'label'=>'Gyvūnai')
            )

            ->add(
                'information',
                TextareaType::class,
                array('label'=>'Informacija')
            )

            ->add(
                'save',
                SubmitType::class,
                array('label' => 'Išsaugoti')
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Trip::class,
            ]
        );
    }
}
