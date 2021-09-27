<?php

namespace App\Form;

use App\Entity\Address;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Quel titre souhaitez-vous donner à votre adresse ?',
                'attr' => [
                    'placeholder' => 'Saisissez votre adresse'
                ]
            ])
            ->add('firstname',  TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Saisissez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Saisissez votre nom'
                ]
            ])
            ->add('company',  TextType::class, [
                'label' => 'Société',
                'required' => false,
                'attr' => [
                    'placeholder' => '(Facultatif) Saisissez le nom de votre société'
                ]
            ])
            ->add('address',  TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'placeholder' => 'Exemple : 24 rue des écoles...'
                ]
            ])
            ->add('postal',  TextType::class, [
                'label' => 'Code Postal',
                'attr' => [
                    'placeholder' => 'Saisissez votre code postal'
                ]
            ])
            ->add('city',  TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Saisissez votre ville'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => 'Pays',
                'attr' => [
                    'placeholder' => 'Saisissez votre pays'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'placeholder' => 'Saisissez votre numéro téléphone'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Confirmer vos informations'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
