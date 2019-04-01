<?php

namespace App\Form;

use App\Entity\Contributor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContributorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('civility',TextType::class,[
                                                'label' => 'Civilité',
                                                'help' => 'Mr,Mme,Mlle'
                                            ])
            ->add('lastname',TextType::class,[
                                                'label' => 'Prénom',
                                                'required' => true
                                            ])
            ->add('firstname',TextType::class,[
                                                'label' => 'Nom',
                                                'required' => true
                                            ])
            ->add('complementName', TextType::class,[
                                                'label' => 'Complément du Nom'
                                            ])
            ->add('email',EmailType::class,[
                                                'label' => 'Courrier Electronique'
                                            ])
            ->add('photo',FileType::class,[
                                                'label' => 'Image du profil'
                                            ])
            ->add('login',TextType::class,[
                                                'label' => 'Login',
                                                'required' => true
                                            ])
            ->add('pwd',PasswordType::class,[
                                                'label' => 'Mot de passe',
                                                'required' => true

                                            ])
            ->add('decision')
            ->add('documents')
            ->add('save',SubmitType::class,[
                                                'label' => 'Créer le compte'
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