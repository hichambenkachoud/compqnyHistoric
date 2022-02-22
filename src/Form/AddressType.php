<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', NumberType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
                'attr' => [
                    'class' => 'col-4 form-control'
                ],
                'required' => true
            ])
            ->add('channelType', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
                'attr' => [
                    'class' => 'col-4 form-control'
                ],
                'required' => true
            ])
            ->add('channelName', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
                'attr' => [
                    'class' => 'col-4 form-control'
                ],
                'required' => true
            ])
            ->add('city', TextType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => true
            ])
            ->add('postalCode', NumberType::class, [
                'row_attr' => [
                    'class' => 'form-group'
                ],
                'attr' => [
                    'class' => 'col-4 form-control'
                ],
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
