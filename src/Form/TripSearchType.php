<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TripSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add(
                'travelerType',
                ChoiceType::class,
                [
                    'choices' => [
                        'Vairuotojas' => 0,
                        'Keleivis' => 1,
                    ],
                    'choice_label' => function ($val, $key, $index) {
                        return false;
                    },
                    'multiple'=>false,
                    'expanded'=>true,
                    'label'=>false
                ]
            )
            ->add(
                'departFrom',
                TextType::class,
                ['label' => 'Išvykimo adresas', 'attr' => ['class' => 'trip_departFrom'],
                    'required' => false]
            )
            ->add('destination', TextType::class, ['label' => 'Atvykimo adresas', 'required' => false])
            ->add('departDate', DateType::class, ['label'=>'Išvykimo data',
                'input'  => 'datetime',
                'widget' => 'single_text',
                'years' => range(date('Y'), date('Y') + 2),
                'required' =>false
            ])
            ->add('departTime', TimeType::class, ['input'  => 'datetime',
                'required' => false,
                'label' =>'Išvykimo laikas',
                'widget' => 'single_text'
            ])
            ->add(
                'smoke',
                IconCheckboxType::class,
                [
                    'required' => false,
                    'label'=> false,
                    'label_class' => 'fas fa-smoking']
            )

            ->add(
                'pets',
                IconCheckboxType::class,
                [
                    'required' => false,
                    'label'=> false,
                    'label_class' => 'fas fa-paw']
            )
            ->add(
                'filter',
                SubmitType::class,
                ['label' => 'Ieškoti']
            );
    }
}
