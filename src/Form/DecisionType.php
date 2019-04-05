<?php

namespace App\Form;

use App\Entity\Decision;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DecisionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isTaken', ChoiceType::class,[
                'label'   => 'Décision à prendre',
                'choices' => [
                    'Choisir la décision' => null,
                    'Je veux dépôser sur HAL' => true,
                    'Je ne veux pas dépôser sur HAL' => false,
                    'Ultérieurement' => null
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Decision::class,
        ]);
    }
}
