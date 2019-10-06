<?php

namespace App\Form;

use App\Entity\ArticlesBlog;
use App\Entity\CategoryBlog;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('categoryBlog', EntityType::class, [
                'class' => CategoryBlog::class,
                'choice_label' => 'title'
            ])
            ->add('content')
            ->add('image')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticlesBlog::class,
        ]);
    }
}
