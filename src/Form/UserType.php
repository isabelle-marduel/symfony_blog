<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'lastname',
                TextType::class,
                [
                    'label' => 'Nom'
                ]
            )
            ->add(
                'firstname',
                TextType::class,
                [
                    'label' => 'Prénom'
                ]
            )
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'Email'
                ]
            )
            ->add(
                'plainPassword',
//                2 champs qui doivent avoir la même valeur
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
//                    options du premier champ
                    'first_options' => [
                        'label' => 'Mot de passe'
                    ],
//                    options du deuxième champ
                    'second_options' => [
                        'label' => 'Confirmation du mot de passe'
                    ],
//                    message si les deux champs n'ont pas la même valeur
                    'invalid_message' => 'La confirmation ne correspond pas au mot de passe.'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
