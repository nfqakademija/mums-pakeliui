<?php
/**
 * Created by PhpStorm.
 * User: egliote
 * Date: 18.4.25
 * Time: 11.33
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class IconCheckboxType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['label_class'] = $form->getConfig()->getOption('label_class');

        parent::buildView($view, $form, $options);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
            $resolver->setDefaults(['label_class'=>null, 'label_image_path'=>null]);
    }

    public function getParent()
    {
        return CheckboxType::class;
    }
}
