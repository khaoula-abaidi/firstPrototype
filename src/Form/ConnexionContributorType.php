<?php

namespace App\Form;

use App\Entity\Contributor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConnexionContributorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login',TextType::class,[
                                                        'label' => 'Login',
                                                        'help' => 'Le login est obligatoire',
                                                        'required' => true
                                                    ])
            ->add('pwd',PasswordType::class,[
                                                        'label' => 'Le Mot de passe est obligatoire',
                                                        'help' => 'Le mot de passe est obligatoire',
                                                        'required' => true

                                                        ])
            ->add('save',SubmitType::class,[
                'label' => 'Se connecter'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contributor::class,
        ]);
    }
}
