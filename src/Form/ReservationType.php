<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->setMethod('POST')
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
                'save',
                SubmitType::class,
                array('label' => 'Rezervuoti')
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Reservation::class,
                'attr' => [
                    'novalidate' => true,
                ]
            ]
        );
    }
}
