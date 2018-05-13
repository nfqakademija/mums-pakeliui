<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('POST')
            ->add('offer',
               IntegerType::class,
                    ['required' => true, 'label'=> 'Siūlomos kelionės id']
           )
            ->add(
                'save',
                SubmitType::class,
                ['label' => 'Pasiūlyti rezervuoti']
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
