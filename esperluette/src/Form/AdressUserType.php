<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class AdressUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameLivraison', TextType::class, [
                'label' => 'Nom',
                'required'   => false,
            ])
            ->add('firstNameLivraison', TextType::class, [
            'label' => 'Prénom',
            'required'   => false,
        ])
            ->add('adressFirst', TextType::class, [
            'label' => 'Adresse',
            'required'   => false,
        ])
            ->add('adressSecond', TextType::class, [
            'label' => 'Adresse suite',
            'required'   => false,
        ])
            ->add('city', TextType::class, [
            'label' => 'Ville',
            'required'   => false,
        ])
            ->add('codeCity', IntegerType::class, [
            'label' => 'Code Postal',
            'required'   => false,
        ])
            ->add('country', TextType::class, [
            'label' => 'Pays',
            'required'   => false,
        ])
            ->add('phone', TelType::class, [
            'label' => 'Numéro de téléphone',
            'required'   => false,
        ])
            ->add('moreInfo', TextareaType::class, [
            'label' => 'Informations aux livreurs',
            'required'   => false,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
