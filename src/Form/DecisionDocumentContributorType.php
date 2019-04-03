<?php

namespace App\Form;

use App\Entity\Contributor;
use App\Entity\Decision;
use App\Entity\Document;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DecisionDocumentContributorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           /*
            ->add('contributor',EntityType::class,[
                                                    'class' => Contributor::class,
                                                    'choice_label' => 'id',
            ])
            ->add('document',EntityType::class,[
                                                    'class' => Document::class,
                                                    'choice_label' => 'id'
            ])
            ->add('decision',EntityType::class,[
                                                    'class' => Decision::class,
                                                    'choice_label' =>'id'
            ])
            ->add('save',SubmitType::class,[
                'label' => 'Déposer dans HAL'
            ])
           */
            ->add('documents', CollectionType::class, [
                // each entry in the array will be an "isTaken" field
                                'entry_type' => DocumentType::class,
                // these options are passed to each "email" type
                                'by_reference' => false,
                                'allow_add' => true,
                                'allow_delete' => true
                                             ])
            ->add('save',SubmitType::class,[
                                'label' => 'Valider les décisions',
                                'attr' => [
                                            'class' => 'btn btn-success'
                                         ]
                                            ])
            ->add('reset',ResetType::class,[
                'label' => 'Annuler'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contributor::class
        ]);
    }
}
