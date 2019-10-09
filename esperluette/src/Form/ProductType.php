<?php

namespace App\Form;

use App\Form\ImageType;
use App\Entity\ProductShop;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProductType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getConfiguration("Titre"))
            ->add('slug', TextType::class, $this->getConfiguration("Adresse web automatique", ['required' => false]))
            ->add('introduction', TextType::class, $this->getConfiguration("Introduction du produit"))
            ->add('content', TextareaType::class, $this->getConfiguration("Description complète du produit"))
            ->add('coverImage', UrlType::class, $this->getConfiguration("Url image principale"))
            ->add('caption', TextType::class, $this->getConfiguration("Alt de l'image"))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix"))
            ->add('imagesShop', CollectionType::class, 
            [
                'entry_type' => ImageType::class,
                'allow_add' => true, 
                'allow_delete' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductShop::class,
        ]);
    }
}
