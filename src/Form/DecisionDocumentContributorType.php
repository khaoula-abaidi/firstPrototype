<?php

namespace App\Form;

use App\Entity\Contributor;
use App\Entity\Decision;
use App\Entity\Document;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DecisionDocumentContributorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('isTaken', ChoiceType::class,[
                            'label' => 'Est publié ? ',
                            'choices' => [
                                          'Choisir la décision' => null,
                                          'Je veux dépôser sur HAL' => true,
                                          'Je ne veux pas dépôser sur HAL' => false,
                                          'Ultérieurement' => null
                                         ],
                            'required' => false
            ])
            ->add('save',SubmitType::class,[
                'label' => 'Valider'
            ])
            ->add('reset',ResetType::class,[
                'label' => 'Annuler'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
