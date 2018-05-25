<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
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
                    'data' => 0

                ]
            )
            ->add(
                'departFrom',
                TextType::class,
                ['label' => false, 'attr' => ['class' => 'trip_departFrom'],
                    'required' => false]
            )
            ->add('destination',
                TextType::class,
                ['label' => false, 'required' => false]
            )
        ;
        if ($_SERVER["REQUEST_URI"] != '/') {
            $builder
            ->add(
                'departDate',
                DateType::class,
                [   'required' => false,
                    'label'=>'Išvykimo data ir laikas',
                    'widget' => 'single_text',
                    'html5' => false
                ]
            )
            ->add(
                'timeFrom',
                RangeType::class,
                [  'attr' =>[
                    'min' => 0,
                    'max' =>24,
                    'value' => 0,
                    'oninput' => 'this.parentNode.dataset.lbound=this.value',
                    'step' => 1
                ]
                ]
            )
            ->add(
                'timeTo',
                RangeType::class,
                [  'attr' =>[
                    'min' => 1,
                    'max' => 24,
                    'value' => 24,
                    'oninput' => 'this.parentNode.dataset.ubound=this.value',
                    'step' => 1]
                ]
            )
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
            ;
        }
        $builder
            ->add(
                'filter',
                SubmitType::class,
                ['label' => 'Ieškoti']
            );
    }
}
