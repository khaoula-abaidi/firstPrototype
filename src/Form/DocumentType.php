<?php

namespace App\Form;

use App\Entity\Document;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('doi',TextType::class,[
                                                    'label' => 'DOI (Digital Object Identifier)'
                                                    ])
            ->add('title',TextType::class,[
                                                    'label' => 'Titre du document'
                                                    ])
            ->add('summuray', TextareaType::class,[
                                                    'label' => 'Résumé'
                                                    ])
            ->add('createdAt',DateTimeType::class,[
                                                    'label' => 'Date de publication'
            ])
            ->add('modifiedAt')
            ->add('decision')
            ->add('contributors')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Document::class,
        ]);
    }
}
