<?php

namespace App\Form;

use App\Entity\Social;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class SocialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class)
            ->add('urlSocial', UrlType::class, array('label'=>'Url du reseau social'))
            ->add('logo', ChoiceType::class, array(
                'label'=> 'Reseau Social',
                'attr' => array(
                    'class'=>'social'),
                'choices' => array(
                    'FaceBook' => 'Facebook',
                    'Twitter' => 'Twitter',
                    'Linkedin' => 'Linkedin',
                    'Google+' => 'Google+'

                ),
                'multiple' => 'false',
                'placeholder' => 'Choisir un reseau social',
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Social::class,
        ]);
    }
}
