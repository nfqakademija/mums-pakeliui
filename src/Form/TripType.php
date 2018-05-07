<?php

namespace App\Form;

use App\Entity\Trip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class TripType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add(
                'travelerType',
                ChoiceType::class,
                array(
                    'choices' => array(
                        'Vairuotojas' => 0,
                        'Keleivis' => 1,
                    ),
                    'choice_label' => function ($val, $key, $index) {
                        return false;
                    },
                    'empty_data'=>'1',
                    'multiple'=>false,
                    'expanded'=>true,
                    'label'=>false,
                )
            )

            ->add(
                'departFrom',
                TextType::class,
                array(
                    'label'=> 'Išvykimo adresas',
                    'attr' => array('class' => 'trip_departFrom'),
                    'constraints' => [
                        new NotBlank(['message' => 'Trūksta išvykimo adreso.'])
                    ]
                )
            )

            ->add(
                'destination',
                TextType::class,
                array(
                    'label'=> 'Atvykimo adresas',
                'constraints' => [
                new NotBlank(['message' => 'Trūksta atvykimo adreso.'])
                ])
            )

            ->add(
                'departTime',
                DateTimeType::class,
                array('label'=>'Išvykimo data ir laikas',
                    'years' => range(date('Y'), date('Y') + 2),
                    'months' => range(date('m'), date('m') + 11)
                )
            )

            ->add(
                'phone',
                TelType::class,
                array(
                    'label'=> 'Tel.nr.',
                    'constraints' => [
                        new NotBlank(['message' => 'Trūksta telefono numerio.']),
                        new Regex([ 'pattern'   => '#^(\+?[0-9 .,()/-]{5,25})?$#',
                                    'message' => 'Neteisingai surinktas telefono numeris.'
                        ])
                    ])
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
                IconCheckboxType::class,
                array(
                    'required' => false,
                    'label'=> false,
                    'label_class' => 'fas fa-smoking')
            )

            ->add(
                'pets',
                IconCheckboxType::class,
                array(
                    'required' => false,
                    'label'=> false,
                    'label_class' => 'fas fa-paw')
            )

            ->add(
                'information',
                TextareaType::class,
                array('label'=>'Informacija',
                    'required' => false)
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
                'attr' => [
                    'novalidate' => true,
                ]
            ]
        );
    }
}
