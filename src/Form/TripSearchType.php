<?php

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TripSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('travelerType', ChoiceType::class,  array('choices' => array(
                    'Vairuotojas' => '0',
                    'Keleivis' => '1'),
                    'multiple'=>false, 'expanded'=>true, 'label'=>false)
            )

            ->add('departFrom', TextType::class, array('label'=> 'Išvykimo adresas', 'attr' => array('class' => 'trip_departFrom'), 'required' => false))

            ->add('destination', TextType::class, array('label'=> 'Atvykimo adresas','required' => false))

            ->add('departTime', DateTimeType::class, array('label'=>'Išvykimo data ir laikas',
                'input'  => 'datetime',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y') + 2),
                'required' =>true
            ))

            ->add('smoke', CheckboxType::class,  array(
                    'required' => false, 'label' =>'Rūkyti')
            )
            ->add('pets', CheckboxType::class,  array(
                    'required' => false, 'label' =>'Gyvūnai')
            )

            ->add('save', SubmitType::class, array('label' => 'Filtruoti'));
    }
    public function getBlockPrefix()
    {
        return null;
    }

}
