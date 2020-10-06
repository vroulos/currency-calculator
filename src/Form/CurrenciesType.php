<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Currencies;

class CurrenciesType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options){
        
        $builder
        ->add('value', NumberType::class, array('label' => 'Amount' ,'attr' => array('class' => 'form-control')))
        ->add('fromCurr', EntityType::class, [
            // looks for choices from this entity
            'class' => Currencies::class,
            // uses the User.username property as the visible option string
            'choice_label' => 'Name',
        
            // used to render a select box, check boxes or radios
             //'multiple' => true,
             //'mapped' => false,
             'attr' => array('class' => 'form-control'),
             'label' => 'From'
            // 'expanded' => true,
        ])
        ->add('toCurr', EntityType::class, [
            // looks for choices from this entity
            'class' => Currencies::class,
        
            // uses the User.username property as the visible option string
            'choice_label' => 'Name',
        
            // used to render a select box, check boxes or radios
             //'multiple' => true,
             'attr' => array('class' => 'form-control'),
             'label' => 'Το'
            // 'expanded' => true,
        ])
       
        ->add('save', SubmitType::class, [
            'label' => 'find currency',
            'attr' => array('class' => 'btn btn-primary mt-3')
            ])
            ->getForm()
        ;
    }

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //         'data_class' => Currencies::class,
    //     ]);
    // }

}

