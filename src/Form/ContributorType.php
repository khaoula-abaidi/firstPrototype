<?php

namespace App\Form;

use App\Entity\Contributor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContributorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civility')
            ->add('lastname')
            ->add('firstname')
            ->add('complementName')
            ->add('login')
            ->add('pwd')
            ->add('decision')
            ->add('documents')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contributor::class,
        ]);
    }
}
