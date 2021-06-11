<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('initialPrice', NumberType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('days', ChoiceType::class, [
                'choices'  => [
                    '1 Day' => 1,
                    '2 Day' => 2,
                    '3 Day' => 3,
                    '4 Day' => 4,
                    '5 Day' => 5,
                ],
                "attr" => [
                    "class" => "form-control"
                ]
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            // ->add('category', ChoiceType::class, [
            //     'choices'  => [
            //         'Mobile Phones' => 1,
            //         'Cases &amp; Protection' => 2,
            //         'Power Banks' => 3,
            //         'Mobile Chargers' => 4,
            //         'Tablets' => 5,
            //     ],
            //     "attr" => [
            //         "class" => "form-control"
            //     ]
            // ])
            ->add('Add', SubmitType::class, [
                'attr' => [
                    'class' => 'mt-4 btn btn-primary'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
