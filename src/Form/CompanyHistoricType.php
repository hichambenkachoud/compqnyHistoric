<?php

namespace App\Form;

use App\DTO\CompanyDto;
use App\Entity\LegalStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyHistoricType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name', TextType::class)
            ->add('siren', TextType::class, [
                'disabled' => $options['is_edit']
            ])
            ->add('registrationCity',TextType::class)
            ->add('registrationDate', DateTimeType::class)
            ->add('capital', NumberType::class)
            ->add('legalStatus', EntityType::class, [
                'class' => LegalStatus::class,
                'choice_label' => 'name',
                'required' => true
            ])
            ->add('address', CollectionType::class, [
                'entry_type' => AddressType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'required' => true,
                'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompanyDto::class,
            'is_edit' => false,
            'empty_data' => null
        ]);
    }
}
